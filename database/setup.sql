-- TaskNest Database Schema
-- Create database and tables for TaskNest application

CREATE DATABASE IF NOT EXISTS tasknest_db;
USE tasknest_db;

-- Create tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
);

-- Insert sample data (optional)
INSERT INTO tasks (title, description) VALUES 
('Welcome to TaskNest', 'This is your first task! Click Done to complete it.'),
('Learn PHP Backend', 'Explore how the PHP backend handles your tasks with MySQL database.'),
('Test Database Connection', 'Verify that your MySQL database is working correctly.');
