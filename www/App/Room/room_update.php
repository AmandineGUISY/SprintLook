<?php
require_once '../Protected/database.php';
require_once '../Protected/class_room.php';
session_start();


try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Accès non autorisé');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $roomId = $data['room_id'];
    $newName = $data['name'];

    if (empty($newName)) {
        throw new Exception('Le nom ne peut pas être vide');
    }

    if (empty($roomId)) {
        throw new Exception('Erreur : L Id ne peut pas être vide');
    }

    $pdo = Database::getConnection();
    $roomManager = new Room($pdo);
    $success = $roomManager->updateRoom($roomId, $_SESSION['user_id'], $newName);

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