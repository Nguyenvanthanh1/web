<?php
require_once 'config/Database.php';
class Model
{
    public $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO(Database::DB_DSN, Database::DB_NAME, Database::DB_PASSWORD);
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
