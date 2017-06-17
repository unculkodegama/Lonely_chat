<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

class BasepagePresenter extends BasePresenter {

    private $model = null;

    function __construct(Model\BasepageModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    function renderDefault() {
        $rooms = $this->model->getAllRooms();
        $member = $this->model->findOutIfIsMember($this->getUser()->id);
        
        $this->template->member = $member;
        $this->template->rooms = $rooms;
    }

    function createComponentNewRoomForm() {
        $form = new Form();
        $form->getElementPrototype()->class('ajax');
        $form->addText('title', 'Názov miestnosti:* ')
                ->setRequired('Musíte zadať názov miestnosti.')
                ->setAttribute('autocomplete', 'off')
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 40);

        $form->addText('description', 'Krátky popis:')
                ->setRequired(FALSE)
                ->setAttribute('autocomplete', 'off')
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 70);

        $form->addSubmit('create', 'Vytvoriť')
                ->setAttribute('id', 'createNewRoom');

        $form->onSuccess[] = function(Form $form, $values) {

            $this->model->createRoom($this->getUser()->id, $values);
            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('newRoom');
                $this->redrawControl('board');
            }
            $form->setValues([], TRUE);
        };
        return $form;
    }

    private $roomData;

    function actionEditRoom($id) {
        $this->roomData = $this->model->getRoom($id);
        if ($this->roomData->id_users != $this->getUser()->id) {
            $this->flashMessage("Ups...Snažís sa dostať tam, kam nemáš! Preč s tebou!");
            $this->redirect("Basepage:default");
        }
    }

    function createComponentEditRoomForm() {
        $form = new Form();
        $form->getElementPrototype()->class('ajax');
        $form->addText('title', 'Názov miestnosti:* ')
                ->setRequired('Musíte zadať názov miestnosti.')
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->setAttribute('autocomplete', 'off')
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 35);

        $form->addText('description', 'Krátky popis: ')
                ->setRequired(FALSE)
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->setAttribute('autocomplete', 'off')
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 35);


        $form->addSubmit('create', 'Upravit');

        $form->addHidden('id_rooms');

        $form->onSuccess[] = function(Form $form, $values) {


            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('editRoom');
            }

            $this->model->updateRoom($values);
            //$this->flashMessage('Miestnosť bola aktualizovaná.');
            //$this->redirect('Basepage:default');
        };
        $form->setDefaults($this->roomData);
        return $form;
    }
    
    function handleEnterRoom($id) {
        
        if($this->model->getRoom($id) != null) {
        $this->model->playerEnteredGame($id, $this->getUser()->id);
        $this->redirect("Chatpage:default", $id);
        } else {
            $this->redirect('Basepage:default');
        }
    }

}
