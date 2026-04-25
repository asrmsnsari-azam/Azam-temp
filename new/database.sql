-- Student Registration Database Setup
-- Run this in phpMyAdmin to create the database and table

CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    hobbies VARCHAR(255),
    country VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

