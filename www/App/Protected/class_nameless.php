<?php
class Nameless {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function newNameless($name, $profile) {
        try {
            $stmt = $this->db->prepare("INSERT INTO nameless (pseudo, image_profile) VALUES (:name, :profile)");
            $stmt->execute([':name' => $name, ':profile' => $profile]);
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur lors de la création du nameless: " . $e->getMessage());
            return false;
        }
    }

    public function addNamelessToTheRoom($id_room, $id_nameless) {
        try {
            $stmt = $this->db->prepare("INSERT INTO room_members (room_id, nameless_id) VALUES (:room_id, :nameless_id)");
            $stmt->execute([':room_id' => $id_room, ':nameless_id' => $id_nameless]);
            
            return true;
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du nameless à la room: " . $e->getMessage());
            return false;
        }
    }

    public function isAValidRoom($code, $nameRoom) {
        try {
            $stmt = $this->db->prepare("SELECT id FROM rooms WHERE code = :code AND name = :name LIMIT 1");
            $stmt->execute([':code' => $code, ':name' => $nameRoom]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id'] : false;

        } catch (PDOException $e) {
            error_log("Le salon n'est pas valide : " . $e->getMessage());
            return false;
        }
    }
}