<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Model;

class SignUpFormFactory {

    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;

    /** @var Model\UserManager */
    private $userManager;

    public function __construct(FormFactory $factory, Model\UserManager $userManager) {
        $this->factory = $factory;
        $this->userManager = $userManager;
    }
    
    /**
     * @return Form
     */
    public function createRegistrationForm(callable $onSuccess) {
        $form = $this->factory->create();

        $form->addProtection([$message = "There is something smelly around here!"], [$timeout = 600]);

        $form->addText('login', 'Login: ')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'Prihlasovacie meno')
                ->setRequired('Prosím, zadajte prihlasovacie meno.')
                ->addRule(Form::MIN_LENGTH, 'Login musí mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Login musí mať menej ako %d znakov.', 15)
                ->getLabelPrototype()->setAttribute('id', 'labed');
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordFirst', 'Heslo: ')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'Heslo')
                ->setRequired('Prosím, zadajte heslo.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->getLabelPrototype()->setAttribute('id', 'labed');
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordVerify', 'Heslo znova: ')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'Heslo znova')
                ->setRequired('Prosím, zadajte heslo znovu.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 4)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['passwordFirst'])
                ->getLabelPrototype()->setAttribute('id', 'labed');
               // ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addEmail('email', 'E-mail: ')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'email')
                ->setRequired('Prosím, zadajte e-mailovú adresu.')
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Prosím, zadajte e-mailovú adresu.')
                ->addRule(Form::EMAIL, 'Neplatná e-mailová adresa.')
                ->getLabelPrototype()->setAttribute('id', 'labed');

        $form->addText('name', 'Meno: ')
                ->setRequired(FALSE)
                ->setAttribute('class', 'form-controla')
                ->setAttribute('autocomplete', 'off')
                ->setAttribute('placeholder', 'Meno')
                ->setAttribute('id', 'input')
                ->addRule(Form::MIN_LENGTH, 'Meno musí mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Meno musí mať menej ako 15 znakov.', 15)
                //->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                
                ->getLabelPrototype()->setAttribute('id', 'labed');

        $form->addText('surname', 'Priezvisko: ')
                ->setRequired(FALSE)
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Priezvisko')
                ->setAttribute('autocomplete', 'off')   
                ->setAttribute('id', 'input')
                ->addRule(Form::MIN_LENGTH, 'Priezvisko musí mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Priezvisko musí mať menej ako 15 znakov.', 15)
              //  ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->getLabelPrototype()->setAttribute('id', 'labed');

        $sex = [
            'm' => 'Muž',
            'f' => 'Žena',
        ];

        $form->addRadioList('gender', NULL, $sex)
                        ->setRequired(FALSE)
                        ->getItemLabelPrototype()->setAttribute('id', 'labelka');

        $form->addSubmit('send', 'Zaregistrovať sa')
                ->setHtmlId('Button')
                ->setAttribute('style', 'width:100%');

        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            try {

                $this->userManager->add($values->login, $values->email, $values->passwordVerify, $values->name, $values->surname, $values->gender);
            } catch (Model\DuplicateNameException $e) {
                $form->addError('Prihlasovacie meno je obsadené.');
                return;
            }
            $onSuccess();
        };

        return $form;
    }
}
