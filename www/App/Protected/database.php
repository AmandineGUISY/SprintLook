<?php
class Database {    
    private static $instance = null;
    private $conn;

    // private construtor to stop the make of direct instances
    private function __construct() {
        try {

            $envPath = $this->findEnvFile();
            
            if ($envPath === null) {
                throw new RuntimeException("Fichier .env introuvable");
            }

            $this->loadEnv($envPath);

            $host = getenv('DB_HOST');
            $db_name = getenv('DB_NAME');
            $username = getenv('DB_USER');
            $password = getenv('DB_PASS');

            $this->conn = new PDO(
                "mysql:host=" . $host . ";dbname=" . $db_name,
                $username,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }

    public static function closeConnection() {
        self::$instance = null;
    
        if (isset(self::$instance)) {
            self::$instance->conn = null;
        }
    }

    private function loadEnv($path): void
    {
        if (!file_exists(filename: $path)) return;
        $lines = file(filename: $path, flags: FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(haystack: trim(string: $line), needle: '#')) continue;
            list($key, $value) = explode(separator: '=', string: $line, limit: 2);
            putenv(assignment: trim(string: $key) . '=' . trim(string: $value));
        }
    }

    private function findEnvFile(): ?string {

        $possiblePaths = [
            '../../../doc/.env',
            '../../doc/.env',
            '../doc/.env',
            '../../.env'
        ];

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return realpath($path);
            }
        }

        return null;
    }
    
}