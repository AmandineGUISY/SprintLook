<?php
require_once 'Protected/database.php';
require_once 'Protected/class_retro.php';
if (session_status() === PHP_SESSION_NONE) {session_start();}


// verify if the user is connected
if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
    header('Location: login.php');
    exit();
}

$room_id = $_GET['room_id'] ?? NULL;
$room_name = $_GET['room_name'] ?? NULL;
$user_id = NULL;
$nameless_id = NULL;
$acces = NULL;

$db = Database::getConnection();
$retro = new Retro($db);

if (isset($_SESSION['user_id'])) { // check the permission of the user
    $user_id = $_SESSION['user_id'];
    $acces = $retro->isOwner($user_id, $room_id);
}
elseif (isset($_SESSION['nameless_id'])) { // check if the nameless have the right to come to the room
    $nameless_id = $_SESSION['nameless_id'];
    $acces = $retro->namelessAcces($nameless_id, $room_id);
}

$room = $retro->getRoom($room_name, $room_id);

if (!$room || !$acces) {
    header('Location: join.php');
    exit();
}

$messages = $retro->getPostits($room_id); // get all the post it of the room

// take only the message for each category

$positive = $retro->filterByCategory($messages, 'positif'); 
$negative = $retro->filterByCategory($messages, 'negatif');
$improve = $retro->filterByCategory($messages, 'a_ameliorer');