<?php

namespace App\Model;

use Nette;

class BasepageModel extends Nette\Object {

    private $db = null;

    public function __construct(\Nette\Database\Connection $dbconn) {
        $this->db = $dbconn;
    }

    function getAllRooms() {
        return $this->db->query("SELECT * FROM rooms ORDER BY last_active")->fetchAll();
    }

    function createRoom($userID, $values) {

        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s');

        return $this->db->query("INSERT INTO rooms (id_users, created, last_active, title, description, locked) "
                        . "VALUES (?, ?, ?, ?, ?, ?)", $userID, $date, $date, $values['title'], $values['description'], 'f');
    }

    function getRoom($id) {
        return $this->db->query("SELECT * FROM rooms "
                        . "WHERE id_rooms = ?", $id)->fetch();
    }

    function updateRoom($values) {
        return $this->db->query("UPDATE rooms SET ? WHERE id_rooms = ?", $values, $values['id_rooms']);
    }

    function deleteRoom($id) {
        return $this->db->query("DELETE FROM rooms "
                        . "WHERE id_rooms = ?", $id);
    }
    
    function findOutIfIsMember($id) {
        return $this->db->query("SELECT * FROM in_room WHERE id_users = ?", $id)->fetch();
    }
    
    function todaysDate() {
        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s');
        return $date;
    }
    
    function getWasPersonInRoomBefore($idRoom, $idUser) {
        return $this->db->query("SELECT * FROM in_room WHERE id_users = ? AND id_rooms = ?", $idUser, $idRoom)->fetch();
    }
    
    function playerEnteredGame($idRoom, $idUser) {

        $wasHe = $this->getWasPersonInRoomBefore($idRoom, $idUser);

        if ($wasHe == NULL) {
            return $this->db->query("INSERT INTO in_room (entered, id_rooms, id_users) VALUES (?, ?, ?)", $this->todaysDate(), $idRoom, $idUser);
        } else {
            return $this->db->query("UPDATE in_room SET entered = ? WHERE id_users = ? AND id_rooms = ?", $this->todaysDate(), $idUser, $idRoom);
        }
    }
    
    function getIfBanned($idUserLocked) {
       return $this->db->query('SELECT * FROM in_room WHERE (kicked IS NOT NULL AND kicked > NOW()) AND id_users = ?', $idUserLocked)->fetch(); 
    }
}
