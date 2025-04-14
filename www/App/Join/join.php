<?php 
require_once "../Protected/class_nameless.php";
require_once "../Protected/database.php";

if (session_status() === PHP_SESSION_NONE) {session_start();} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];

    $name_room = trim($_POST['nameRoom']);
    $code = trim($_POST['code']);
    $current_name = $_POST['currentName'];
    $current_image = "Resources/Images/" . $_POST['currentImage'];

    $pdo = Database::getConnection();
    $nameless = new Nameless($pdo);

    $id_room = $nameless->isAValidRoom($code, $name_room);

    if ($id_room != false) {
        // if the room is valid it create the new nameless
        $id_nameless = $nameless->newNameless($current_name, $current_image);
        
        if ($id_nameless) {
            // if the nameless is rightly created it insert it in the room
            if ($nameless->addNamelessToTheRoom($id_room, $id_nameless)) {
                $response['success'] = true;

                unset($_SESSION['user_id']);
                $_SESSION['nameless_id'] = $id_nameless;

                $response['redirect'] = "retrospective.php?room_id=".$id_room."&room_name=".$name_room; // Adaptez cette URL
            } else {
                $response['message'] = "Erreur lors de l'ajout à la salle";
            }
        } else {
            $response['message'] = "Erreur lors de la création du profil";
        }
    } else {
        $response['message'] = "Salon introuvable ou code incorrect";
    }

    echo json_encode($response);
    exit;
}