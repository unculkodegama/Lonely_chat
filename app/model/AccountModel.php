<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;


class AccountModel extends Nette\Object {

    private $database = null;

    public function __construct($dbconn) {
        $this->database = $dbconn;
    }

}
