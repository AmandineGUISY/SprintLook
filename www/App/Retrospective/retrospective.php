<?php
require_once 'Protected/database.php';
session_start();

// Vérifier si l'utilisateur est connecté et a accès à la salle
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$room_id = 9;
$user_id = $_SESSION['user_id'];

// Récupérer les informations de la salle
$db = Database::getConnection();
$stmt = $db->prepare("SELECT * FROM rooms WHERE id = ? AND user_id = ?");
$stmt->execute([$room_id, $user_id]);
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) {
    die("Salle non trouvée ou accès refusé");
}

// Récupérer les messages de rétrospective
$stmt = $db->prepare("SELECT m.*, 
                    COALESCE(u.pseudo, n.pseudo) as author,
                    COALESCE(u.image_profile, n.image_profile) as author_image
                    FROM messages m
                    LEFT JOIN users u ON m.user_id = u.id
                    LEFT JOIN nameless n ON m.nameless_id = n.id
                    WHERE m.room_id = ?
                    ORDER BY m.created_at DESC");
$stmt->execute([$room_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Séparer les messages par catégorie
$positive = array_filter($messages, fn($msg) => $msg['category'] === 'positif');
$negative = array_filter($messages, fn($msg) => $msg['category'] === 'negatif');
$improve = array_filter($messages, fn($msg) => $msg['category'] === 'a_ameliorer');
?>