<?php
/**
 * Task Model for TaskNest
 * Handles all database operations for tasks
 */

require_once __DIR__ . '/../config/database.php';

class Task {
    private $conn;
    private $table_name = "tasks";

    // Task properties
    public $id;
    public $title;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Get all tasks ordered by creation date (newest first)
     */
    public function getAllTasks() {
        $query = "SELECT id, title, description, created_at, updated_at 
                  FROM " . $this->table_name . " 
                  ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    /**
     * Create a new task
     */
    public function createTask() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, description) 
                  VALUES (:title, :description)";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        
        // Bind parameters
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }

    /**
     * Delete a task by ID
     */
    public function deleteTask() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        
        return $stmt->execute();
    }

    /**
     * Get a single task by ID
     */
    public function getTaskById() {
        $query = "SELECT id, title, description, created_at, updated_at 
                  FROM " . $this->table_name . " 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        if($row) {
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        }
        
        return false;
    }

    /**
     * Update a task
     */
    public function updateTask() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, description = :description 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        
        // Bind parameters
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":id", $this->id);
        
        return $stmt->execute();
    }
}
?>
