<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé']);
    exit();
}

if (!isset($_POST['id']) || !isset($_POST['content']) || !isset($_POST['category'])) {
    echo json_encode(['success' => false, 'error' => 'Données manquantes']);
    exit();
}

try {
    $db = Database::getConnection();
    $retro = new Retro($db);

    // verify if the id is the owner of the post it
    $stmt = $db->prepare("SELECT id FROM messages WHERE id = ? AND user_id = ?");
    $stmt->execute([$_POST['id'], $_SESSION['user_id']]);
    
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'Action non autorisée']);
        exit();
    }
    
    // update the post it
    $success = $retro->updatePostit(
        $_POST['id'],
        $_POST['content'],
        $_POST['category']
    );
    
    echo json_encode(['success' => $success]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}