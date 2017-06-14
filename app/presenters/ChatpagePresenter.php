<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

class ChatpagePresenter extends BasePresenter {

    private $model = null;
    private $idLocalRoom = null;
    private $owner = null;

    function __construct(\App\Model\ChatpageModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    function renderDefault($id) {

        $this->idLocalRoom = intval($id);

        if($this->model->getRoom($id) != null) {
        $this->model->playerEnteredGame($id, $this->getUser()->id);
        
        $this->model->clearInRoom();

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
        $form->getElementPrototype()->class('ajax');
        $form->addText('text', NULL)
                ->setAttribute('class', 'form-control')
                ->setRequired(TRUE)
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('style', 'width: 100%')
                ->setAttribute('id', 'usermsg');
        //  ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addSubmit('create', 'Odoslať');

        $form->addHidden('id_room')
                ->setValue($this->idLocalRoom)
                ->setAttribute('id', 'sentButton');

        $form->onSuccess[] = function(Form $form, $values) {

            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('list');
                $this->redrawControl('form');
                $form->setValues(['id_room' => $values->id_room], TRUE);
            }

            $this->model->createMessage($values['id_room'], $this->getUser()->id, NULL, $values['text']);
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

    function handleRefreshBoard() {
        
        $this->deleteInactiveUsers($this->owner);
        $this->kickUserIfInactive($this->idLocalRoom);
        $this->deleteInactiveBoard($this->idLocalRoom);
        $this->redrawControl('list');
        $this->redrawControl('lockedRoom');
    }

    function handleQuitRoom($idRoom, $idUser) {
        $owner = $this->model->getOwnerPerson($idUser);
        
        if (!$this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->redrawControl('list');

            $this->redrawControl('leaveRoom');
        }
           
        if ($owner != $idUser) {
            $left = $this->model->getPerson($idUser);
            $this->model->createMessage($idRoom, $idUser, null, 'System message -> ' . $left->login . ' opustil miestnosť.');
            $this->model->updateLastActiveRoom($idRoom);
            $this->model->playerQuitGame($idRoom, $idUser);
            //$this->redirect('Basepage:default');
            $this->russianRoulette($idRoom);
        } else {
            $this->russianRoulette($idRoom);
        }
    }

    function russianRoulette($idRoom) {
        $countOfChatters = $this->model->getNumberOfChatters($idRoom);
        $idsOfPeopleInRoom = $this->model->getIdOfPeopleInRoom($idRoom);
        $pole[] = null;
        if ($countOfChatters->count > 1) {
            
            foreach ($idsOfPeopleInRoom as $ids) {
                array_push($pole, $ids);
            }

            $id = rand(0, count($pole));

            $this->model->setOwnerRoom($id, $idRoom);
            $this->model->updateLastActiveRoom($idRoom);
            $this->model->createMessage($idRoom, $id, null, 'System message -> Bol vylosovaný nový správca!');
        } else {
            $this->model->deleteRoom($idRoom);
            $this->redirect('Basepage:default');
        }
    }

    function deleteInactiveBoard($idRooms) {
        $lastMessage = $this->model->getLastActive($idRooms);
            if($lastMessage !== null) {
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
        if ($aktivita === null) {
            $this->redirect('Basepage:default');
        }
    }

}
