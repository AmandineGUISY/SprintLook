<?php
require_once 'Protected/database.php';
require_once 'Protected/class_retro.php';
session_start();


// verify if the user is connected
if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
    header('Location: login.php');
    exit();
}

$room_id = $_GET['room_id'];
$room_name = $_GET['room_name'];
$user_id = NULL;
$nameless_id = NULL;

if (!isset($_SESSION['user_id'])) {$user_id = $_SESSION['user_id'];}
if (!isset($_SESSION['nameless_id'])) {$nameless_id = $_SESSION['nameless_id'];}

$db = Database::getConnection();
$retro = new Retro($db);

$room = $retro->getRoom($room_name, $room_id);

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