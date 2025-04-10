<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé']);
    exit();
}

$data = [
    'room_id' => $_POST['room_id'],
    'user_id' => $_POST['user_id'],
    'content' => trim($_POST['content']),
    'category' => $_POST['category'],
    'is_author' => 1
];

if (empty($data['content'])) {
    echo json_encode(['success' => false, 'error' => 'Le message ne peut pas être vide']);
    exit();
}

try {
    $db = Database::getConnection();
    $retro = new Retro($db);
    $message = $retro -> createPostit($data['room_id'], $data['user_id'], $data['is_author'], $data['content'], $data['category']);
    
    echo json_encode(['success' => true, 'message' => $message]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}