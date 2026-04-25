<?php
// Student Registration - Backend Script
// Includes centralized database configuration

require_once 'config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitize and retrieve form data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    $gender = $conn->real_escape_string($_POST['gender']);
    $country = $conn->real_escape_string($_POST['country']);
    $dob = $conn->real_escape_string($_POST['dob']);
    
    // Handle hobbies (checkbox array)
    $hobbies = '';
    if (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) {
        $hobbies = $conn->real_escape_string(implode(', ', $_POST['hobbies']));
    }
    
    // Hash password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Handle file upload
    $picturePath = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $uploadDir = 'uploads/';
        
        // Create uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generate unique filename
        $fileExtension = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
        $fileName = uniqid('student_', true) . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;
        
        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedTypes)) {
            // Move uploaded file
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
                $picturePath = $targetPath;
            } else {
                echo "<script>alert('Error uploading file. Please try again.'); window.location.href='index.html';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.'); window.location.href='index.html';</script>";
            exit;
        }
    }
    
    // Insert data into database
    $sql = "INSERT INTO students (name, email, password, gender, hobbies, country, dob, picture) 
            VALUES ('$name', '$email', '$hashedPassword', '$gender', '$hobbies', '$country', '$dob', '$picturePath')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration Successful! Your data has been saved to the database.');
                window.location.href='display.php';
              </script>";
    } else {
        // Check for duplicate email
        if ($conn->errno === 1062) {
            echo "<script>
                    alert('Error: This email is already registered. Please use a different email.');
                    window.location.href='index.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . addslashes($conn->error) . "');
                    window.location.href='index.html';
                  </script>";
        }
    }
    
} else {
    // If accessed directly without POST data, redirect to form
    header('Location: index.html');
    exit;
}

// Close connection
$conn->close();
?>

