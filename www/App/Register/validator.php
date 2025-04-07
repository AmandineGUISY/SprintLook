<?php
class Validator {
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validatePassword($password) {
        return strlen($password) >= 8 &&
               preg_match('/[0-9]/', $password) &&
               preg_match('/[A-Z]/', $password) &&
               preg_match('/[\W_]/', $password);
    }

    public static function getPasswordErrors($password) {
        $errors = [];
        if (strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une majuscule.";
        }
        if (!preg_match('/[\W_]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
        }
        return $errors;
    }
}