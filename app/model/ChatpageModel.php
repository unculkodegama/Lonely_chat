<?php

namespace App\Model;

use Nette;

class ChatpageModel extends Nette\Object {

    private $db = null;

    public function __construct(\Nette\Database\Context $dbconn) {
        $this->db = $dbconn;
    }

    function todaysDate() {
        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    function playerEnteredGame($idRoom, $idUser) {

        $wasHe = $this->getWasPersonInRoomBefore($idRoom, $idUser);

        if ($wasHe == NULL) {
            return $this->db->query("INSERT INTO in_room (entered, id_rooms, id_users) VALUES (?, ?, ?)", $this->todaysDate(), $idRoom, $idUser);
        } else {
            return $this->db->query("UPDATE in_room SET entered = ? WHERE id_users = ? AND id_rooms = ?", $this->todaysDate(), $idUser, $idRoom);
        }
    }

    function getWasPersonInRoomBefore($idRoom, $idUser) {
        return $this->db->query("SELECT * FROM in_room WHERE id_users = ? AND id_rooms = ?", $idUser, $idRoom)->fetch();
    }

    function getPerson($id) {
        return $this->db->query('SELECT * FROM users WHERE id_users = ?', $id)->fetch();
    }
    
    function getRoom($id) {
        return $this->db->query('SELECT * FROM rooms WHERE id_rooms = ?', $id)->fetch();
    }
    
    function setLastMessageInRoom($idRoom, $idUser) {
        return $this->db->query("UPDATE in_room SET last_message = ? WHERE id_users = ? AND id_rooms = ?", $this->todaysDate(), $idUser, $idRoom);
    }

    function setKickedInRoom($idRoom, $idUser) {
        return $this->db->query("UPDATE in_room SET kicked = ? WHERE id_users = ? AND id_rooms = ?", $this->todaysDate(), $idUser, $idRoom);
    }
    
    function createMessage($idRoom, $idUserFrom, $idUserTo, $text) {
        return $this->db->query("INSERT INTO messages (id_rooms, id_users_from, id_users_to, text, time) "
                . "VALUES (?, ?, ?, ?, ?)", $idRoom, $idUserFrom, $idUserTo, $text, $this->todaysDate());
    }
    
    function getMessagesToRoom($idRoom) {
        return $this->db->query("SELECT * FROM messages JOIN users WHERE users.id_users = messages.id_users_from AND id_rooms = ? ORDER BY TIME desc", $idRoom)->fetchAll();
    }
            
    
}
