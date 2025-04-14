<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé']);
    exit();
}

$user_id = NULL;
$nameless_id = NULL;

if (isset($_SESSION['user_id'])) {$user_id = $_SESSION['user_id'];}
if (isset($_SESSION['nameless_id'])) {$nameless_id = $_SESSION['nameless_id'];}

$data = [
    'room_id' => $_POST['room_id'],
    'user_id' => $user_id,
    'content' => trim($_POST['content']),
    'category' => $_POST['category'],
    'nameless_id' => $nameless_id
];

if (empty($data['content'])) {
    echo json_encode(['success' => false, 'error' => 'Le message ne peut pas être vide']);
    exit();
}

try {
    $db = Database::getConnection();
    $retro = new Retro($db);
    $message = $retro -> createPostit($data['room_id'], $data['user_id'], $data['nameless_id'], $data['content'], $data['category']);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}