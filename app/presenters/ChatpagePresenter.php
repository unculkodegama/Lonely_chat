<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

class ChatpagePresenter extends BasePresenter {

    private $model = null;
    private $idLocalRoom = null;
            
    function __construct(\App\Model\ChatpageModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    function renderDefault($id) {
        $this->idLocalRoom = $id;
        
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
        $form->addText('text', NULL)
                ->setAttribute('class','form-control')
                ->setRequired(TRUE)
                ->setAttribute('id','usermsg')
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');
               
        $form->addSubmit('create', 'Odoslať');

        $form->onSuccess[] = function(Form $form, $values) {
           try {

                $this->model->createMessage(10, $this->getUser()->id, NULL, $values['text']);
                if($this->isAjax()) {
                    $form->setValues(array(),TRUE);
                    $this->redrawControl('sprava');
                } else {
                    $this->redirect('this');
                }
            } catch (Model\DuplicateNameException $e) {
                $form['title']->addError('Názov miestnoti je obsadený.');
                return;
            }
            
            
        };
        return $form;
    }
    
    function handleRefresh() {
        $this->invalidateControl('obsah');
    }
}
