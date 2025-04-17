<?php
require_once '../Protected/class_user.php';
require_once '../Protected/database.php';
require_once 'validator.php';

if (session_status() === PHP_SESSION_NONE) {session_start();}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) { // if it's empty it's an error
        $errors[] = "Tous les champs sont obligatoires.";
    }

    if (!Validator::validateEmail($email)) { // error : if the email is not valid
        $errors[] = "Veuillez entrer une adresse email valide.";
    }

    $passwordErrors = Validator::getPasswordErrors($password); // error: if the password doesn't respect the password 8 char 1 maj 1 num 1 special char
    if (!empty($passwordErrors)) {
        $errors = array_merge($errors, $passwordErrors);
    }

    if ($password !== $confirm_password) { // error : password =! confirm pasword
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // if the validator is ok then register the user
    if (empty($errors)) {
        try {
            $pdo = Database::getConnection();
            $user = new User($pdo);

            // Register of the user
            $registerResult = $user->registerUser($email, $password, $username);
            $statusCode = $registerResult[0];
            $message = $registerResult[1];

            // if the login succesed, login and create the session
            if ($statusCode === 200) {

                $loginResult = $user->login($email, $password);
                $loginStatusCode = $loginResult[0];
                $loginMessage = $loginResult[1];
                $userData = $loginResult[2];


                if ($loginStatusCode === 200) {
                    // stocking the information in the session
                    $_SESSION = [];
                    $_SESSION['user_id'] = $userData['id'];

                    http_response_code($statusCode);
                    echo json_encode([
                        'status' => $statusCode,
                        'message' => $message,
                        'redirect' => 'index.php'
                    ]);
                    exit;
                } else {
                    http_response_code($loginStatusCode);
                    echo json_encode(['status' => $loginStatusCode, 'message' => $loginMessage]);
                    exit;
                }
            } else {
                // if the register failed
                http_response_code($statusCode);
                echo json_encode(['status' => $statusCode, 'message' => $message]);
                exit;
            }
        } catch (PDOException $e) {
            // failed to connect at the database
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => "Erreur de base de données : " . $e->getMessage()]);
        }
    } else {
        // Error of validation with the validator
        http_response_code(400);
        echo json_encode(['status' => 400, 'message' => $errors]);
    }
} else {
    // if the hhtp method is not POST
    http_response_code(405);
    echo json_encode(['status' => 405, 'message' => 'Méthode non autorisée.']);
}