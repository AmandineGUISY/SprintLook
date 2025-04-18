<?php
class Room {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getRooms($userId, $searchTerm = '', $sortBy = 'date-desc') {

        if ($userId <= 0) {
            throw new Exception('ID utilisateur invalide');
        }

        $query = "SELECT
                r.code,
                r.id,
                r.name,
                r.created_at,
                (SELECT COUNT(*) FROM room_members rm WHERE rm.room_id = r.id) as member_count 
                FROM rooms r
                WHERE r.user_id = :user_id";

        $params = [':user_id' => $userId];

        // Addition of the search like filter
        if (!empty($searchTerm)) {
            $query .= " AND r.name LIKE :search";
            $params[':search'] = '%' . $searchTerm . '%';
        }

        // Addition of the Order By in function of the filter
        switch ($sortBy) {
            case 'date-asc':
                $query .= " ORDER BY r.created_at ASC";
                break;
            case 'name-asc':
                $query .= " ORDER BY r.name ASC";
                break;
            case 'name-desc':
                $query .= " ORDER BY r.name DESC";
                break;
            default: // 'date-desc'
                $query .= " ORDER BY r.created_at DESC";
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // writing correctly the date data
        foreach ($rooms as &$room) {
            $room['created_at'] = date('d/m/Y à H:i', strtotime($room['created_at']));
        }

        return [
            'success' => true,
            'data' => $rooms,
            'count' => count($rooms)
        ];
    }

    public function deleteRoom($roomId, $userId) {
        // verify if the user is the owner
        $stmt = $this->db->prepare("SELECT user_id FROM rooms WHERE id = :room_id");
        $stmt->execute([':room_id' => $roomId]);
        $ownerId = $stmt->fetchColumn();

        if ($ownerId != $userId) {
            throw new Exception('Action non autorisée');
        }

        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = :room_id");
        return $stmt->execute([':room_id' => $roomId]);
    }

    public function closeRoom($roomId, $userId) {
        // verify if the user is the owner
        $stmt = $this->db->prepare("SELECT user_id FROM rooms WHERE id = :room_id");
        $stmt->execute([':room_id' => $roomId]);
        $ownerId = $stmt->fetchColumn();

        if ($ownerId != $userId) {
            throw new Exception('Action non autorisée');
        }

        $stmt = $this->db->prepare("UPDATE rooms SET closed = 1 WHERE id = :room_id");
        $success = $stmt->execute([':room_id' => $roomId]);

        if (!$success) {
            throw new Exception('Échec de la mise à jour du salon');
        }
    
        return true;
    }

    public function createRoom($userId, $roomName) {

        $code = substr(strtoupper(uniqid()), 0, 8);
        
        $stmt = $this->db->prepare("INSERT INTO rooms (name, code, user_id) VALUES (:name, :code, :user_id)");
        $stmt->execute([
            ':name' => $roomName,
            ':code' => $code,
            ':user_id' => $userId
        ]);
        
        return $this->db->lastInsertId();
    }

    public function updateRoom($roomId, $userId, $newName) {
        // verify if the user_id is the owner of the room
        $stmt = $this->db->prepare("SELECT user_id FROM rooms WHERE id = :room_id");
        $stmt->execute([':room_id' => $roomId]);
        $ownerId = $stmt->fetchColumn();
    
        if ($ownerId != $userId) {
            throw new Exception('Vous n êtes pas autorisé à modifier ce salon');
        }
    
        $stmt = $this->db->prepare("UPDATE rooms SET name = :name WHERE id = :room_id");
        $success = $stmt->execute([
            ':name' => $newName,
            ':room_id' => $roomId
        ]);
    
        if (!$success) {
            throw new Exception('Échec de la mise à jour du salon');
        }
    
        return true;
    }
}