<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use DateTime;

/**
 * Users management.
 */
class UserManager implements Nette\Security\IAuthenticator
{
	use Nette\SmartObject;

	const
		TABLE_NAME = 'users',
		COLUMN_ID_USERS = 'id_users',
                //
                COLUMN_LOGIN = 'login',
                COLUMN_EMAIL = 'email',
                COLUMN_PASSWORD_HASH = 'password',
                COLUMN_ROLE = 'role',
		COLUMN_NAME = 'name',
		COLUMN_SURNAME = 'surname',
                COLUMN_GENDER = 'gender',
                COLUMN_REGISTERED = 'registered';
		


	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($login, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_LOGIN, $login)->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('Prihlasovacie meno je neplatné.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('Heslo je neplatné.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID_USERS], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	public function add($login, $email, $password, $name, $surname, $gender)
	{   
            date_default_timezone_set('Europe/Prague'); 
            $date = date('Y-m-d H:i:s');
            
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_LOGIN => $login,
                                self::COLUMN_EMAIL => $email,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				self::COLUMN_NAME => $name,
                                self::COLUMN_SURNAME => $surname,
                                self::COLUMN_GENDER => $gender,
                    self::COLUMN_ROLE => 'member',
                    self::COLUMN_REGISTERED => $date,             
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}

}

 


class DuplicateNameException extends \Exception
{}
