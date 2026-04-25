<?php
// Database Configuration File
// Update these settings when deploying to live web hosting

// Localhost (XAMPP) Settings - Default
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'student_db';

// LIVE HOSTING SETTINGS - Uncomment and update when deploying to live server
// $host = 'localhost'; // Usually stays localhost on shared hosting
// $username = 'your_hosting_db_username';  // From your hosting control panel
// $password = 'your_hosting_db_password';  // From your hosting control panel
// $database = 'your_hosting_db_name';      // From your hosting control panel

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

