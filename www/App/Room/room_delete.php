<?php
require_once '../Protected/database.php';
require_once '../Protected/class_room.php';
session_start();

try {

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Accès non autorisé');
    }
    
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        throw new Exception('Méthode non autorisée');
    }

    // getting the room_id from the room.js file
    $data = json_decode(file_get_contents('php://input'), true);
    $roomId = $data['room_id'] ?? null;
    $userId = $_SESSION['user_id'];

    if (!$roomId) {
        throw new Exception('ID salon manquant');
    }

    $roomManager = new Room(Database::getConnection());
    $success = $roomManager->deleteRoom($roomId, $userId);

    echo json_encode(['success' => $success]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    Database::closeConnection();
}