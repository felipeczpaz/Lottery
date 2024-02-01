-- Create the database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS your_database_name;

-- Use the created database
USE your_database_name;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    balance DECIMAL(10, 2) DEFAULT 0.00
);

-- Add an index on the email column to ensure uniqueness
CREATE UNIQUE INDEX idx_email ON users (email);
