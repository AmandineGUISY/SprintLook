<?php
require_once '../Protected/database.php';
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
    
    $stmt = $db->prepare("INSERT INTO messages (room_id, user_id, is_author, content, category) 
                          VALUES (:room_id, :user_id, :is_author, :content, :category)");
    $stmt->execute($data);
    
    $messageId = $db->lastInsertId();
    $stmt = $db->prepare("SELECT m.*, u.pseudo as author, u.image_profile as author_image
                          FROM messages m
                          JOIN users u ON m.user_id = u.id
                          WHERE m.id = ?");
    $stmt->execute([$messageId]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'message' => $message]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}