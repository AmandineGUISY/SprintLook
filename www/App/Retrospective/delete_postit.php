<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
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
                     WHERE m.id = ? 
                     AND (m.nameless_id = ?)");

    $stmt->execute([
        $_POST['id'],
        $_SESSION['nameless_id'] ?? null
    ]);

    if (!$stmt->fetch() && !isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'Action non autorisée']);
        exit();
    }
    
    $success = $retro->deletePostit($_POST['id']);
    
    echo json_encode(['success' => $success]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}