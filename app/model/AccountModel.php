<?php

namespace App\Model;
use Nette\Security\Passwords;

use Nette;

class AccountModel extends Nette\Object {

    private $db = null;

    public function __construct(\Nette\Database\Connection $dbconn) {
        $this->db = $dbconn;
    }

    function updatePerson($values,$id) {
        return $this->db->query('UPDATE users SET ? WHERE id_users = ?', $values, $id);
    }

    function deletePerson($id) {
        return $this->db->query('DELETE FROM users WHERE id_users = ?', $id);
    }

    public function getPerson($id) {
        return $this->db->query("SELECT * FROM users WHERE id_users = ?", $id)->fetch();
    }
    
    public function insertPassword($pass,$id) {
        return $this->db->query("UPDATE users SET password = ? WHERE id_users = ?",Passwords::hash($pass),$id);
    }
}
