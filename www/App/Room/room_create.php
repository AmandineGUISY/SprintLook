<?php
require_once '../Protected/database.php';
require_once '../Protected/class_room.php';
session_start();


try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Accès non autorisé');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $roomName = trim($data['name'] ?? '');

    if (empty($roomName)) {
        throw new Exception('Le nom du salon ne peut pas être vide');
    }

    $roomManager = new Room(Database::getConnection());
    $newRoomId = $roomManager->createRoom($_SESSION['user_id'], $roomName);

    echo json_encode([
        'success' => true,
        'room_id' => $newRoomId
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