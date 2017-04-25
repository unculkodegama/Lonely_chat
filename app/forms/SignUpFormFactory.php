<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Model;

class SignUpFormFactory {

    use Nette\SmartObject;

    const PASSWORD_MIN_LENGTH = 6;

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

        $form->addText('login')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Prihlasovacie meno')
                ->setRequired('Prosím, zadajte prihlasovacie meno.')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 15)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordFirst')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Heslo')
                ->setRequired('Prosím, zadajte heslo.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 6)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

        $form->addPassword('passwordVerify')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Heslo znova')
                ->setRequired('Prosím, zadajte heslo znovu.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 6)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addConditionOn($form['passwordFirst'], Form::VALID)
                ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['passwordFirst'])
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

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
                ->setAttribute('placeholder', 'Meno')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 25 znakov.', 15)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->setHtmlId('input');

        $form->addText('surname')
                ->setRequired(FALSE)
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder', 'Priezvisko')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako 2 znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako 25 znakov.', 15)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$')
                ->setHtmlId('input');

        $sex = [
            'm' => 'Muž',
            'f' => 'Žena',
        ];

        $form->addRadioList('gender', NULL, $sex)
                        ->setRequired(FALSE)
                        ->getSeparatorPrototype()->setName(Null)
                        ->getLabelPrototype()->class[] = 'radiolabel';

        $form->addSubmit('send', 'Zaregistrovať sa')
                ->setHtmlId('Button');

        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            try {

                $this->userManager->add($values->login, $values->email, $values->passwordVerify, $values->name, $values->surname, $values->gender);
            } catch (Model\DuplicateNameException $e) {
                $form['login']->addError('Prihlasovacie meno je obsadené.');
                return;
            }
            $onSuccess();
        };

        return $form;
    }

}
