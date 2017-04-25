<?php

namespace App\Model;

use Nette;

class BasepageModel extends Nette\Object {

    private $db = null;

    public function __construct(\Nette\Database\Connection $dbconn) {
        $this->db = $dbconn;
    }

    function getAllRooms() {
        return $this->db->query("SELECT * FROM rooms ORDER BY title")->fetchAll();
    }

    function createRoom($userID, $values) {

        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s');

        return $this->db->query("INSERT INTO rooms (id_users, created, title, description, locked) "
                        . "VALUES (?, ?, ?, ?, ?)", $userID, $date, $values['title'], $values['description'], 'f');
    }

    function getRoom($id) {
        return $this->db->query("SELECT * FROM rooms "
                        . "WHERE id_rooms = ?", $id)->fetch();
    }

    function updateRoom($values) {
        return $this->db->query("UPDATE rooms SET ? "
                        . "WHERE id_rooms = ?", $values, $values['id']);
    }

    function deleteRoom($id) {
        return $this->db->query("DELETE FROM rooms "
                        . "WHERE id_rooms = ?", $id);
    }

    function lockRoom($id) {
        return $this->db->query('UPDATE rooms SET locked = ? WHERE id_rooms = ?', 't', $id);
    }

    function unlockRoom($id) {
        return $this->db->query('UPDATE rooms SET locked = ? WHERE id_rooms = ?', 'f', $id);
    }

}
