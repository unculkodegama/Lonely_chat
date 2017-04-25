<?php

namespace App\Model;

use Nette;

class ChatpageModel extends Nette\Object {

    private $db = null;

    public function __construct($dbconn) {
        $this->db = $dbconn;
    }

}
