<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "bimbel_db";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape_string($string) {
        return $this->conn->real_escape_string($string);
    }

    public function insert_id() {
        return $this->conn->insert_id;
    }
}
?>