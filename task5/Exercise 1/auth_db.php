<?php
/**
 * auth_db.php - Database setup for user authentication
 * Creates the 'users' table with columns: id, username, email, password
 */
class AuthDatabase {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'LibraryDB';
    public $conn;

    public function __construct() {
        // Establish database connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->createUsersTable();
    }

    private function createUsersTable() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if (!$this->conn->query($sql)) {
            die("Error creating table: " . $this->conn->error);
        }
    }
}

// Initialize database
$authDB = new AuthDatabase();
?>