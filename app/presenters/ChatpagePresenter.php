<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

class ChatpagePresenter extends BasePresenter {

    private $model = null;
    public $idLocalRoom = null;

    function __construct(\App\Model\ChatpageModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    function renderDefault($id) {

        $this->idLocalRoom = intval($id);


        $this->model->playerEnteredGame($id, $this->getUser()->id);



        $messages = $this->model->getMessagesToRoom($id);
        $user = $this->model->getPerson($this->getUser()->id);
        $room = $this->model->getRoom($id);

        $this->template->room = $room;
        $this->template->person = $user;
        $this->template->messages = $messages;
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
                ->setValue($this->idLocalRoom);

        $form->onSuccess[] = function(Form $form, $values) {

            try {

                if (!$this->isAjax()) {
                    $this->redirect('this');
                } else {
                    $this->redrawControl('list');
                    $this->redrawControl('form');
                    $form->setValues(['id_room' => $values->id_room], TRUE);
                   
                }

                $this->model->createMessage($values['id_room'], $this->getUser()->id, NULL, $values['text']);
            } catch (Model\DuplicateNameException $e) {
                $form['title']->addError('Názov miestnoti je obsadený.');
                return;
            }
        };
        return $form;
    }

}
