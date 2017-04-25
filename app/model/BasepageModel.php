<?php

namespace App\Model;

use Nette;

class BasepageModel extends Nette\Object {

    private $db = null;

    public function __construct(\Nette\Database\Connection $dbconn) {
        $this->db = $dbconn;
    }
    
    function getAllRooms() {
        return $this->db->query($sql);
    }
    
}
