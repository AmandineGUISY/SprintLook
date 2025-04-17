<?php
require_once '../Protected/database.php';
require_once '../Protected/class_room.php';
session_start();

try {

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Accès non autorisé');
    }

    $pdo = Database::getConnection();
    $roomManager = new Room($pdo);

    $userId = $_SESSION['user_id'];
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
    $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'date-desc';

    $result = $roomManager->getRooms($userId, $searchTerm, $sortBy); // get the room by Terme and by sort

    echo json_encode($result); // send of the rooms

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    Database::closeConnection();
}