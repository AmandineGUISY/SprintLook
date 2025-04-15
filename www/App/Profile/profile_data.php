<?php
require_once 'Protected/database.php';
require_once 'Protected/class_user.php';

session_start();


// verify if the user is connected
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = Database::getConnection();
$userManager = new User($db);

$user = $userManager->getUserInfo($_SESSION['user_id']);