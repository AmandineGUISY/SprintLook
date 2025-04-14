<?php
if (session_status() === PHP_SESSION_NONE) {session_start();} // if the session is not started yet 

$_SESSION = []; // the session is empty
session_destroy(); // destroy the session
session_regenerate_id(true); // securisation of the regeneration of id
header('Location: ../login.php');