<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // register of a new user
    public function registerUser($email, $password, $pseudo) {
        try {
            // Verification if the email is already existing
            $stmt = $this->db->prepare("SELECT 1 FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetchColumn()) {
                return [400, 'Email déjà pris.'];
            }

            // hashed password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            // insertion of the new user
            $stmt = $this->db->prepare("INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)");

            // Execution of the request
            if ($stmt->execute([
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $hashed_password
            ])) {
                return [200, 'Inscription réussie.'];
            } else {
                return [400, "Erreur lors de l'inscription."];
            }
        } catch (PDOException $e) {
            // if an error occured, send the error
            return [500, "Erreur de base de données : " . $e->getMessage()];
        }
    }

    public function login($email, $password) {
        try {
            // verify if the user exist, the mail is unique in the database
            $stmt = $this->db->prepare("SELECT password FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);

            if ($stmt->rowCount() != 1) {
                return [400, 'Mot de passe ou Adresse Mail invalide'];
            }

            $p = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $p['password'])) {
                // if the password is the same as the password found with the mail, then it start a session
                $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                return [200, "Connexion réussie ! Redirection à la page d'accueil en cours ...", $user];
            } else {
                return [400, "Mot de passe ou Adresse Mail invalide"];
            }
        } catch (PDOException $e) {
            return [500, "Erreur de base de données : " . $e->getMessage()];
        }
    }

    public function getUserInfo($userID) {
        $stmt = $this->db->prepare("SELECT pseudo, email, image_profile, created_at FROM users WHERE id = ?");
        $stmt->execute([$userID]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function updateProfileImg($imagePath, $userID) {
        $stmt = $this->db->prepare("UPDATE users SET image_profile = ? WHERE id = ?");
        $success = $stmt->execute([$imagePath, $userID]);

        if (!$success) {
            throw new Exception('Échec de la mise à jour du salon');
        }
    
        return true;
    }
}