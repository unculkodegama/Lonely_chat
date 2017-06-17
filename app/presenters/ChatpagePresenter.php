<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

class ChatpagePresenter extends BasePresenter {

    private $model = null;
    private $idLocalRoom = null;
    private $owner = null;
    private $allUsers = null;

    function __construct(\App\Model\ChatpageModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    function renderDefault($id) {

        $this->idLocalRoom = intval($id);

        if ($this->model->getRoom($id) != null) {

            $this->model->clearInRoom();

            $this->allUsers = $this->model->getUsersMessageTo($this->idLocalRoom, $this->getUser()->id);

            $messages = $this->model->getMessagesToRoom($id);
            $user = $this->model->getPerson($this->getUser()->id);
            $room = $this->model->getRoom($id);
            $this->owner = $this->model->getOwnerPerson($id);
            $count = $this->model->getNumberOfChatters($id);

            $this->template->room = $room;
            $this->template->person = $user;
            $this->template->messages = $messages;
            $this->template->owner = $this->owner;
            $this->template->count = $count;
        } else {
            $this->redirect('Basepage:default');
        }
    }

    function createComponentSendMessageForm() {
        $form = new Form();

        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = NULL;
        $renderer->wrappers['control']['container'] = NULL;

        $form->getElementPrototype()->class('ajax');

        $form->addText('text', NULL)
                ->setAttribute('class', 'form-control')
                ->setRequired(TRUE)
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('id', 'usermsg');

        $form->addHidden('id_room')
                ->setValue($this->idLocalRoom);

        $form->onSuccess[] = function(Form $form, $values) {

            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                //$this->redrawControl('list');
                $this->redrawControl('form');
                $form->setValues(['text' => NULL], FALSE);
            }

            $this->model->createMessage($values['id_room'], $this->getUser()->id, NULL, $values['text']);
            $this->model->updateLastActiveRoom($values['id_room']);
            $this->model->setLastMessageInRoom($values['id_room'], $this->getUser()->id);
        };
        return $form;
    }

    function createComponentPersonalMessage() {
        $form = new Form();

        $form->getElementPrototype()->class('ajax');

        $form->addText('text', NULL)
                ->setAttribute('class', 'form-control')
                ->setRequired(TRUE)
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('id', 'usermsg');

        $form->addHidden('id_room')
                ->setValue($this->idLocalRoom);

        $form->addHidden('id_user_to')
                ->setAttribute('id', 'message_to');

        $form->addSubmit('send', 'Poslať')
                ->setAttribute('id', 'submitPrivate');

        $form->onSuccess[] = function(Form $form, $values) {

            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('zprava');
                $form->setValues(['text' => NULL], FALSE);
            }

            $this->model->createMessage($values['id_room'], $this->getUser()->id, $values->id_user_to, $values['text']);
            $this->model->updateLastActiveRoom($values['id_room']);
            $this->model->setLastMessageInRoom($values['id_room'], $this->getUser()->id);
        };
        return $form;
    }

    function handleLockRoom($id) {
        if (!$this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->redrawControl('list');
            $this->redrawControl('form');
            $this->redrawControl('lockedRoom');
        }
        $this->model->lockRoom($id);
        $owner = $this->model->getOwnerPerson($id);
        $this->model->createMessage($id, $owner->id_users, null, 'System message -> Miestnosť bola zamknutá.');
        $this->model->updateLastActiveRoom($id);
    }

    function handleUnlockRoom($id) {
        if (!$this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->redrawControl('list');
            $this->redrawControl('form');
            $this->redrawControl('lockedRoom');
        }

        $this->model->unlockRoom($id);
        $owner = $this->model->getOwnerPerson($id);
        $this->model->createMessage($id, $owner->id_users, null, 'System message -> Miestnosť bola odomknutá.');
        $this->model->updateLastActiveRoom($id);
    }

    function handleRefreshBoard($idRoom, $idOwner) {
        $this->allUsers = $this->model->getUsersMessageTo($this->idLocalRoom, $this->getUser()->id);
        $this->deleteInactiveUsers($idOwner);
        $this->kickUserIfInactive($idRoom);
        $this->deleteInactiveBoard($idRoom);
        $this->redrawControl('lockedRoom');
        $this->redrawControl('leaveRoom');
        $this->redrawControl('list');
    }

    function handleQuitRoom($idRoom, $idUser) {
        $owner = $this->model->getOwnerPerson($idRoom);

        if (!$this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->redrawControl('list');
            $this->redrawControl('leaveRoom');
        }

        if ($idUser == $owner->id_users) {
            $this->russianRoulette($idRoom);
        } else {
            $left = $this->model->getPerson($idUser);
            $this->model->createMessage($idRoom, $idUser, null, 'System message -> ' . $left->login . ' opustil miestnosť.');
            $this->model->updateLastActiveRoom($idRoom);
            $this->model->playerQuitGame($idRoom, $idUser);
        }
    }

    function russianRoulette($idRoom) {
        $owner = $this->model->getOwnerPerson($idRoom);
        $countOfChatters = $this->model->getNumberOfChatters($idRoom);
        $idsOfPeopleInRoom = $this->model->getIdOfPeopleInRoom($idRoom);

        $pole[] = null;
        if ($countOfChatters->count > 1) {

            foreach ($idsOfPeopleInRoom as $ideas) {
                if ($ideas->pokus !== $owner->id_users) {
                    array_push($pole, $ideas->pokus);
                }
            }

            $id = rand(0, (count($pole) - 1));

            $trueID = $pole[$id];

            $this->model->setOwnerRoom($trueID, $idRoom);
            $this->model->updateLastActiveRoom($idRoom);
            $newOwner = $this->model->getPerson($trueID);
            $this->model->createMessage($idRoom, $trueID, null, 'System message -> Bol vylosovaný nový správca! Je ním ' . $newOwner->login);
        } else {
            $this->model->deleteRoom($idRoom);
            $this->redirect('Basepage:default');
        }
    }

    function deleteInactiveBoard($idRooms) {
        $lastMessage = $this->model->getLastActive($idRooms);
        if ($lastMessage != NULL) {
            $this->model->deleteRoom($idRooms);
        }
    }

    function deleteInactiveUsers($idOwner) {
        $this->model->deleteInactiveUsers($idOwner);
    }

    function banUser() {
        
    }

    function kickUserIfInactive($idRoom) {
        $aktivita = $this->model->kickIfInactive($idRoom, $this->getUser()->id);

        if ($aktivita == NULL) {
            $this->redirect('Basepage:default');
        }
    }

    function handleDeleteRoom($idRoom) {
        $countOfChatters = $this->model->getNumberOfChatters($idRoom)->count;
        $owner = $this->model->getOwnerPerson($idRoom)->id_users;
        if (($countOfChatters == 1) && ($owner == $this->getUser()->id)) {
            $this->model->deleteRoom($idRoom);
            $this->redirect("Basepage:default");
        } else {
            $this->flashMessage("Nemôžeš.");
        }
    }

}
