<?php

namespace App\Model;

use Nette;

class MessageModel extends Nette\Object {

    private $db = null;

    public function __construct($dbconn) {
        $this->db = $dbconn;
    }

}
