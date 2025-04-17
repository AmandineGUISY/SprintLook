<?php
require_once 'Protected/database.php';
require_once 'Protected/class_user.php';

// verify if the user is connected
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = Database::getConnection();
$userManager = new User($db);

$user = $userManager->getUserInfo($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $uploadDir = '../Resources/Client/';

    // verify if the dir exist, if not it is created
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $fileName = uniqid() . '_' . basename($_FILES['profile_image']['name']);
    $targetPath = $uploadDir . $fileName;
    
    // verify the file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['profile_image']['type'];
    
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            // update in the database
            try {
                if (($user['image_profile']) != NULL) {unlink($user['image_profile']);} // delete the image who is not used anymore

                $userManager->updateProfileImg($targetPath, $_SESSION['user_id']);

                // refresh of the data shown
                $user = $userManager->getUserInfo($_SESSION['user_id']);

                $success = "Photo de profil mise à jour avec succès!";
            } catch (Exception $e) {
                $error = "Erreur lors de la mise à jour de la base de données: " . $e->getMessage();
            }
        } else {
            $error = "Erreur lors de l'upload du fichier.";
        }
    } else {
        $error = "Type de fichier non autorisé. Seuls JPEG, PNG et GIF sont acceptés.";
    }
}