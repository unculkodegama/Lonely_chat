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
        $this->template->rooms = $rooms;
    }

    function createComponentNewRoomForm() {
        $form = new Form();
        $form->addText('title', 'Názov miestnosti:')
                ->setRequired('Musíte zadať názov miestnosti.')
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 40);

        $form->addText('description', 'Krátky popis:')
                ->setRequired(FALSE)
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 70);

        $form->addSubmit('create', 'Vytvoriť');

        $form->onSuccess[] = function(Form $form, $values) {
            try {

                $this->model->createRoom($this->getUser()->id, $values);
                
            } catch (Model\DuplicateNameException $e) {
                $form['title']->addError('Názov miestnoti je obsadený.');
                return;
            }
           
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
        
        $form->addText('title', 'Názov miestnosti:')
                ->setRequired('Musíte zadať názov miestnosti.')
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 35);

        $form->addText('description', 'Krátky popis:')
                ->setRequired(FALSE)
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 35);


        $form->addSubmit('create', 'Upravit');

        $form->addHidden('id_rooms');

        $form->onSuccess[] = function(Form $form, $values) {

            $this->model->updateRoom($values);
            //$this->flashMessage('Miestnosť bola aktualizovaná.');
            $this->redirect('Basepage:default');
            
        };
        $form->setDefaults($this->roomData);
        return $form;
    }

    function actionDeleteRoom($id) {
        $this->roomData = $this->model->getRoom($id);
        if ($this->roomData->id_users != $this->getUser()->id) {
            $this->flashMessage("Ups...Snažís sa dostať tam, kam nemáš! Preč s tebou!");
            $this->redirect("Basepage:default");
        }

        $this->model->deleteRoom($id);
        $this->flashMessage('Miestnosť bola vymazaná.');
        $this->redirect('Basepage:default');
    }

}
