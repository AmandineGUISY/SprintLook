<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé']);
    exit();
}

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID manquant']);
    exit();
}

try {
    $db = Database::getConnection();
    $retro = new Retro($db);

    $stmt = $db->prepare("SELECT m.id 
                         FROM messages m
                         LEFT JOIN rooms r ON m.room_id = r.id
                         WHERE m.id = ? AND (m.user_id = ? OR r.user_id = ?)");
    $stmt->execute([$_POST['id'], $_SESSION['user_id'], $_SESSION['user_id']]);
    
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'Action non autorisée']);
        exit();
    }
    
    $success = $retro->deletePostit($_POST['id']);
    
    echo json_encode(['success' => $success]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}