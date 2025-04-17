<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
if (session_status() === PHP_SESSION_NONE) {session_start();}

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
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
    $stmt = $db->prepare("SELECT m.id 
                     FROM messages m
                     WHERE m.id = ? 
                     AND (m.nameless_id = ? OR m.user_id = ?)");

    $stmt->execute([
        $_POST['id'],
        $_SESSION['nameless_id'] ?? null,
        $_SESSION['user_id'] ?? null
    ]);

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