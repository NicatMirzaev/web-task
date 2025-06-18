<?php
// Include configuration
require_once 'config.php';

// Database connection class
class Database {
    private $connection;
    private static $instance = null;
    
    private function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
        
        // Set charset to utf8mb4
        $this->connection->set_charset("utf8mb4");
    }
    

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    

    public function getConnection() {
        return $this->connection;
    }
    

    public function query($sql, $params = []) {
        if (!empty($params)) {
            $stmt = $this->connection->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $this->connection->error);
            }
            
            // Bind parameters
            $types = '';
            $bindParams = [];
            
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
                $bindParams[] = $param;
            }
            
            if (!empty($bindParams)) {
                $stmt->bind_param($types, ...$bindParams);
            }
            
            $stmt->execute();
            return $stmt;
        } else {
            $result = $this->connection->query($sql);
            if (!$result) {
                die("Query failed: " . $this->connection->error);
            }
            return $result;
        }
    }
    
    public function fetchAll($sql, $params = []) {
        $result = $this->query($sql, $params);
        
        if ($result instanceof mysqli_stmt) {
            $result = $result->get_result();
        }
        
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        if ($result instanceof mysqli_result) {
            $result->free();
        }
        
        return $rows;
    }
    
    // Fetch single row
    public function fetch($sql, $params = []) {
        $result = $this->query($sql, $params);
        
        if ($result instanceof mysqli_stmt) {
            $result = $result->get_result();
        }
        
        $row = $result->fetch_assoc();
        
        if ($result instanceof mysqli_result) {
            $result->free();
        }
        
        return $row;
    }
    
    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->connection->insert_id;
    }
    

    // Escape string to prevent SQL injection
    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }
    
    // Close connection
    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

// Create a global database instance
$db = Database::getInstance();

// Register shutdown function to close connection
register_shutdown_function(function() use ($db) {
    $db->close();
});
?> 