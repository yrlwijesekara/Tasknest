<?php
/**
 * Database Setup Script for TaskNest
 * Run this file once to set up your database
 */



echo "<h1>TaskNest Database Setup</h1>";

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "<p>✓ Database '$database' created successfully</p>";
    
    // Use the database
    $pdo->exec("USE $database");
    
    // Create tasks table
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_created_at (created_at)
        )
    ";
    
    $pdo->exec($createTableSQL);
    echo "<p>✓ Tasks table created successfully</p>";
    
    // Insert sample data
    $insertSQL = "
        INSERT INTO tasks (title, description) VALUES 
        ('Welcome to TaskNest', 'This is your first task! Click Done to complete it.'),
        ('Learn PHP Backend', 'Explore how the PHP backend handles your tasks with MySQL database.'),
        ('Test Database Connection', 'Verify that your MySQL database is working correctly.')
    ";
    
    $pdo->exec($insertSQL);
    echo "<p>✓ Sample data inserted successfully</p>";
    
    echo "<h2>Setup Complete!</h2>";
    echo "<p>Your TaskNest database is ready to use.</p>";
    echo "<p><a href='index.php'>Go to TaskNest Application</a></p>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration.</p>";
}
?>
