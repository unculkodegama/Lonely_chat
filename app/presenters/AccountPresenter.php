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

    /*
      function actionUpdatePerson() {
      $this->personData = $this->model->getPerson($this->getUser()->id);
      if ($this->personData->id_users != $this->getUser()->id) {
      $this->flashMessage("Ups...Snažís sa dostať tam, kam nemáš! Preč s tebou!");
      $this->redirect("Basepage:default");
      }
      }
     */

    public function createComponentUpdatePersonForm() {
        $form = new Form();

        $form->addText('registered')
                ->setHtmlId('input')
                ->setDisabled(TRUE)
                ->setAttribute('class', 'form-controla');
        
        $form->addText('login')
                ->setHtmlId('input')
                ->setDisabled(TRUE)
                ->setAttribute('class', 'form-controla');

        $form->addEmail('email')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'email')
                ->setRequired('Prosím, zadajte e-mailovú adresu.')
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Prosím, zadajte e-mailovú adresu.')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná e-mailová adresa.');

        $form->addText('name')
                ->setRequired(FALSE)
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Vyplnte meno')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 25 znakov.', 15)
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->setHtmlId('input');

        $form->addText('surname')
                ->setRequired(FALSE)
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Vyplnte priezvisko')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 25 znakov.', 15)
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->setHtmlId('input');

        $sex = [
            'm' => 'Muž',
            'f' => 'Žena',
        ];

        $form->addRadioList('gender', NULL, $sex)
                        ->setRequired(FALSE)
                        ->getSeparatorPrototype()->setName(Null)
                        ->getLabelPrototype()->class[] = 'radiolabel';

        $form->addSubmit('send', 'Uložiť')
                ->setHtmlId('Button')
                ->setAttribute('style', 'width:100%');

        $form->onSuccess[] = function (Form $form, $values) {

            $this->model->updatePerson($values, $this->getUser()->id);
        };
        $this->personData = $this->model->getPerson($this->getUser()->id);
        $form->setDefaults($this->personData);
        return $form;
    }

    function createComponentUpdatePasswordForm() {
        $form = new Form();

        $form->addPassword('passwordFirst')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Nové heslo')
                ->setRequired('Prosím, zadajte nové heslo.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20);
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordVerify')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Nové heslo znova')
                ->setRequired('Prosím, zadajte nové heslo znovu.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addConditionOn($form['passwordFirst'], Form::VALID)
                ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['passwordFirst']);
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addSubmit('send', 'Uložiť')
                ->setHtmlId('Button')
                ->setAttribute('style', 'width:100%');

        $form->onSuccess[] = function (Form $form, $values) {

            $this->model->insertPassword($values->passwordVerify, $this->getUser()->id);
        };

        return $form;
    }

    function actionDeletePerson() {
        $this->personData = $this->model->getPerson($this->getUser()->id);
        if ($this->personData->id_users != $this->getUser()->id) {
            $this->flashMessage("Ups...Snažís sa dostať tam, kam nemáš! Preč s tebou!");
            $this->redirect("Basepage:default");
        }

        $this->model->deletePerson($this->personData->id_users);
        //$this->flashMessage('Miestnosť bola vymazaná.');
        $this->redirect('Sign:default');
    }

}
