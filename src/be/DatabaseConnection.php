<?php
    class DatabaseConnection {
        private $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=localhost;dbname=dreamride", "root", "");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit;
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }
?>
