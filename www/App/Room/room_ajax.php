<?php
require_once '../Protected/database.php';
require_once '../Protected/class_room.php';
session_start();

try {
    $pdo = Database::getConnection();
    
    $userId = $_SESSION['user_id'];
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
    $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'date-desc';

    if ($userId <= 0) {
        throw new Exception('ID utilisateur invalide');
    }

    $query = "SELECT
            r.id,
            r.name,
            r.code,
            r.created_at,
            (SELECT COUNT(*) FROM room_members rm WHERE rm.room_id = r.id) as member_count 
            FROM rooms r
            WHERE r.user_id = :user_id";

    $params = [':user_id' => $userId];

    if (!empty($searchTerm)) {
        $query .= " AND name LIKE :search";
        $params[':search'] = '%' . $searchTerm . '%';
    }

        $query .= " GROUP BY r.id, r.name, r.code, r.created_at";

    switch ($sortBy) {
        case 'date-asc':
            $query .= " ORDER BY created_at ASC";
            break;
        case 'name-asc':
            $query .= " ORDER BY name ASC";
            break;
        case 'name-desc':
            $query .= " ORDER BY name DESC";
            break;
        default: // 'date-desc'
            $query .= " ORDER BY created_at DESC";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rooms as &$room) {
        $room['created_at'] = date('d/m/Y à H:i', strtotime($room['created_at']));
    }

    echo json_encode([
        'success' => true,
        'data' => $rooms,
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    Database::closeConnection();
}