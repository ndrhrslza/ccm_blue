<?php
session_start();
include '../db.php';
include '../csp.php';
include '../sop_validation.php';
require_once '../csrf.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

//check if the CSRF token is valid 
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo $_POST['csrf_token'];
    echo $_SESSION['csrf_token'];
    // header("Location: contactus.php?error=invalid_csrf_token");
    exit();
}

// Get and sanitize form data
$name = sanitize_input($_POST['name']);
$email = sanitize_input($_POST['email']);
$subject = sanitize_input($_POST['subject']);
$message = sanitize_input($_POST['message']);

// Server-side validation
$errors = [];

if (empty($name)) {
    $errors[] = "Name is required.";
} elseif (!preg_match("/^[a-zA-Z0-9_]{3,16}$/", $name)) {
    $errors[] = "Name must be 3-16 characters long and can contain letters, digits, and underscores.";
}

if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (empty($subject)) {
    $errors[] = "Subject is required.";
} elseif (!preg_match("/^[a-zA-Z0-9\s,.'-]{3,100}$/", $subject)) {
    $errors[] = "Subject must be 3-100 characters long and can contain letters, digits, spaces, commas, periods, apostrophes, and hyphens.";
}

if (empty($message)) {
    $errors[] = "Message is required.";
} elseif (!preg_match("/^[a-zA-Z0-9\s,.!?\"'()@#$%^&*-_+=]{10,100}$/", $message)) {
    $errors[] = "Message must be 10-100 characters long and can contain letters, digits, spaces, and common punctuation marks.";
}

// Check for validation errors
if (count($errors) > 0) {
    // If there are errors, display them
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contactus (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the statement
if ($stmt->execute()) {
    header("Location: ../homepage/index.html");
    exit(); // Ensure script termination after redirection
} else {
    echo "Error: " . $stmt->error;
}
?>
