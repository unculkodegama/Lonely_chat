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

    function todaysBannedDate() {
        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s', time() + 3600);
        return $date;
    }

    function playerQuitGame($idRoom, $idUser) {
        return $this->db->query("DELETE FROM in_room WHERE id_users = ? AND id_rooms = ?", $idUser, $idRoom);
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

    function createMessage($idRoom, $idUserFrom, $idUserTo, $text) {
        return $this->db->query("INSERT INTO messages (id_rooms, id_users_from, id_users_to, text, time) "
                        . "VALUES (?, ?, ?, ?, ?)", $idRoom, $idUserFrom, $idUserTo, $text, $this->todaysDate());
    }

    function getMessagesToRoom($idRoom) {
        return $this->db->query("SELECT * FROM messages JOIN users WHERE users.id_users = messages.id_users_from AND id_rooms = ? ORDER BY TIME desc", $idRoom)->fetchAll();
    }

    function getOwnerPerson($id) {
        return $this->db->query("SELECT * FROM rooms JOIN users USING(id_users) WHERE id_rooms = ?", $id)->fetch();
    }

    function getNumberOfChatters($id) {
        return $this->db->query("SELECT COUNT(id_users) as count FROM in_room WHERE id_rooms = ?", $id)->fetch();
    }

    function lockRoom($id) {
        return $this->db->query('UPDATE rooms SET locked = ? WHERE id_rooms = ?', 't', $id);
    }

    function unlockRoom($id) {
        return $this->db->query('UPDATE rooms SET locked = ? WHERE id_rooms = ?', 'f', $id);
    }

    function clearInRoom() {
        return $this->db->query('DELETE FROM in_room WHERE id_users IS NULL OR id_rooms IS NULL');
    }

    function getIdOfPeopleInRoom($id) {
        return $this->db->query("SELECT id_users AS pokus FROM in_room WHERE id_rooms = ?", $id)->fetchAll();
    }

    function setOwnerRoom($id, $idRoom) {
        return $this->db->query("UPDATE rooms SET id_users = ? WHERE id_rooms = ?", $id, $idRoom);
    }

    function deleteRoom($id) {
        return $this->db->query("DELETE FROM rooms "
                        . "WHERE id_rooms = ?", $id);
    }

    function deleteInactiveUsers($idOwner) {
        return $this->db->query('DELETE FROM in_room WHERE '
                        . 'entered < (NOW() - INTERVAL ? HOUR) AND (last_message < (NOW() - INTERVAL ? HOUR) OR last_message IS NULL) AND (id_users != ?) ', 6, 6, $idOwner);
    }

    function kickIfInactive($idRoom, $idUsers) {
        return $this->db->query('SELECT * FROM in_room WHERE (id_users = ? AND id_rooms = ?)', $idUsers, $idRoom)->fetch();
    }

    function getLastActive($idRooms) {
        return $this->db->query("SELECT last_active FROM rooms WHERE id_rooms = ? AND (last_active < (NOW() - INTERVAL ? HOUR))", $idRooms, 12)->fetch();
    }

    function updateLastActiveRoom($idRooms) {
        return $this->db->query("UPDATE rooms SET last_active = ? WHERE id_rooms = ?", $this->todaysDate(), $idRooms);
    }

    function getUsersMessageTo($idRooms, $idActUser) {
        return array($this->db->query('SELECT users.login, users.id_users FROM in_room JOIN users USING(id_users) WHERE '
                    . 'in_room.id_rooms = ? AND in_room.id_users != ?', $idRooms, $idActUser)->fetchPairs('id_users', 'login'));
    }

    function setKickedInRoom($idRoom, $idUser) {
        return $this->db->query("UPDATE in_room SET kicked = ? WHERE id_users = ? AND id_rooms = ?", $this->todaysBannedDate(), $idUser, $idRoom);
    }

    function deleteBannedPerson($idRoom) {
        return $this->db->query("DELETE FROM in_room WHERE kicked IS NOT NULL AND kicked > (NOW()) AND id_rooms = ?", $idRoom);
    }

}
