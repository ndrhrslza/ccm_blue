
<?php
require_once 'db.php';

// Get user input from the registration form
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmPassword']; // Correct the name to match HTML form

// Check if the passwords are not empty
if (empty($password) || empty($confirm_password)) {
    header("Location: register.html?error=empty_passwords");
    exit();
}

// Check if the passwords match
if ($password != $confirm_password) {
    header("Location: register.html?error=passwords_do_not_match");
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the statement
$stmt = $conn->prepare("INSERT INTO bookingsystem.users (id, username, email, phone, password) VALUES ((FLOOR(RAND() * 100000) + UNIX_TIMESTAMP()), ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Prepare failed: ". $conn->error);
    header("Location: register.html?error=prepare_failed");
    exit();
}


// Bind parameters and execute the statement
$stmt->bind_param("ssss",  $username, $email, $phone, $hashed_password);
if (!$stmt->execute()) {
    error_log("Execute failed: ". $stmt->error);
    header("Location: register.html?error=execute_failed");
    exit();
}

// Registration successful
header('Location: login.php');
exit();

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
