<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;

class AccountPresenter extends BasePresenter {

    private $model = null;
    private $personData = null;

    function __construct(Model\AccountModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    public function createComponentUpdatePersonForm() {
        $form = new Form();
        $form->getElementPrototype()->class('ajax');
        $form->addText('registered', 'Registrácia: ')
                ->setAttribute('id', 'input')
                ->setDisabled(TRUE)
                ->getLabelPrototype()->setAttribute('id', 'labed')
                ->setAttribute('class', 'form-controla');

        $form->addText('login', 'Login: ')
                ->setAttribute('id', 'input')
                ->getLabelPrototype()->setAttribute('id', 'labed')
                ->setDisabled(TRUE)
                ->setAttribute('class', 'form-controla');

        $form->addEmail('email', 'E-mail: ')
                ->setAttribute('id', 'input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'email')
                ->setAttribute('autocomplete', 'off')
                ->getLabelPrototype()->setAttribute('id', 'labed')
                ->setRequired('Prosím, zadajte e-mailovú adresu.')
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Prosím, zadajte e-mailovú adresu.')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná e-mailová adresa.');

        $form->addText('name', 'Meno: ')
                ->setRequired(FALSE)
                ->setAttribute('id', 'input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Vyplnte meno')
                ->setAttribute('autocomplete', 'off')
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 15 znakov.', 15)
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->getLabelPrototype()->setAttribute('id', 'labed');

        $form->addText('surname', 'Priezvisko: ')
                ->setRequired(FALSE)
                ->setAttribute('id', 'input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'Vyplnte priezvisko')
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 15 znakov.', 15)
                // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->getLabelPrototype()->setAttribute('id', 'labed');

        $sex = [
            'm' => 'Muž',
            'f' => 'Žena',
        ];

        $form->addRadioList('gender', Null, $sex)
                ->getItemLabelPrototype()->setAttribute('id', 'labelka')
                ->setRequired(FALSE);

        $form->addSubmit('send', 'Uložiť')
                ->setHtmlId('Button')
                ->setAttribute('style', 'width:100%');

        $form->onSuccess[] = function (Form $form, $values) {

            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('updade_person');
            }

            $this->model->updatePerson($values, $this->getUser()->id);
        };

        $this->personData = $this->model->getPerson($this->getUser()->id);
        $form->setDefaults($this->personData);

        return $form;
    }

    function createComponentUpdatePasswordForm() {
        $form = new Form();
        $form->getElementPrototype()->class('ajax');
        
        /*
          $form->addPassword('passwordOld')
          ->setHtmlId('input')
          ->setAttribute('class', 'form-controla')
          ->setAttribute('placeholder', 'Staré heslo')
          ->setRequired('Prosím, zadajte staré heslo.')
          ->setAttribute('autocomplete', 'off')
          ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
          ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20);
         */
        
        $form->addPassword('passwordFirst')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Nové heslo')
                ->setAttribute('autocomplete', 'off')
                ->setRequired('Prosím, zadajte nové heslo.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20);
        // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordVerify')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Nové heslo znova')
                ->setAttribute('autocomplete', 'off')
                ->setRequired('Prosím, zadajte nové heslo znovu.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addRule(Form::EQUAL, 'Nové heslo sa nezhoduje', $form['passwordFirst']);
        // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addSubmit('send', 'Uložiť')
                ->setHtmlId('Button')
                ->setAttribute('style', 'width:100%');

        $form->onSuccess[] = function (Form $form, $values) {

            if (!$this->isAjax()) {
                $this->redirect('this');
            } else {
                $this->redrawControl('updade_password');
            }

            $this->model->insertPassword($values->passwordVerify, $this->getUser()->id);
        };

        return $form;
    }

    function actionDeletePerson() {
        $this->personData = $this->model->getPerson($this->getUser()->id);
        if ($this->personData->id_users != $this->getUser()->id) {
            //$this->flashMessage("Ups...Snažís sa dostať tam, kam nemáš! Preč s tebou!");
            $this->redirect("Basepage:default");
        }

        $this->model->deletePerson($this->personData->id_users);
        //$this->flashMessage('Miestnosť bola vymazaná.');
        
        $this->redirect('Sign:default');
    }
}
