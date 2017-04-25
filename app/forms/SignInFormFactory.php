<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignInFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;


	public function __construct(FormFactory $factory, User $user)
	{
		$this->factory = $factory;
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
                
		 $form->addText('login')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder','Prihlasovacie meno')
                ->setRequired('Prosím, zadajte prihlasovacie meno.')
                ->addRule(Form::MIN_LENGTH, 'Musíte mať viac ako %d znaky.', 2)
                ->addRule(Form::MAX_LENGTH, 'Musíte mať menej ako %d znakov.', 15)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

		$form->addPassword('password')
                ->setHtmlId('input')
                ->setAttribute('class', 'form-controla')
                ->setAttribute('placeholder','Heslo')        
                ->setRequired('Prosím, zadajte heslo.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znakov.', 6)
                ->addRule(Form::MAX_LENGTH, 'Heslo nemôže presiahnuť %d znakov.', 20)
                ->addRule(Form::PATTERN, 'Musí obsahovať normálne znaky.', '^[a-zá-žA-ZÁ-Ž0-9\_\-\.\*]*$');

		$form->addSubmit('send', 'Prihlásiť sa')
                ->setAttribute('style', 'width: 100%')
                ->setHtmlId('Button');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			try {
				$this->user->login($values->login, $values->password);
			} catch (Nette\Security\AuthenticationException $e) {
				$form->addError('The username or password you entered is incorrect.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}

}
