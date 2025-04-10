<?php
require_once 'Protected/database.php';
require_once 'Protected/class_retro.php';
session_start();


// verify if the user is connected
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$room_id = 9;
$user_id = $_SESSION['user_id'];

$db = Database::getConnection();
$retro = new Retro($db);

$room = $retro->getRoom($user_id, $room_id);

if (!$room) {
    die("Salle non trouvée ou accès refusé");
}

$messages = $retro->getPostits($room_id);
$positive = $retro->filterByCategory($messages, 'positif');
$negative = $retro->filterByCategory($messages, 'negatif');
$improve = $retro->filterByCategory($messages, 'a_ameliorer');

$postits = $retro->getPostits($roomId, $_SESSION['user_id']);
$isRoomOwner = $retro->getRoom($_SESSION['user_id'], $roomId) !== false;
?>