<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'look';
    private $username = 'root';
    private $password = '1234';
    private static $instance = null;
    private $conn;

    // private construtor to stop the make of direct instances
    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
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
    
}