    <?php
    include '../csp.php';
    require_once '../db.php';
    require_once '../csrf.php';

    // Function to sanitize user input
    function sanitize_input($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    //check if the CSRF token is valid 
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header("Location: register.php?error=invalid_csrf_token");
    }

    // Get and sanitize user input from the registration form
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $hashed_password = sanitize_input($_POST['hashed_password']);
    $hashed_confirm_password = sanitize_input($_POST['hashed_confirm_password']); // Correct the name to match HTML form

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.html?error=invalid_email");
        exit();
    }

    // Check if the passwords are not empty
    if (empty($hashed_password) || empty($hashed_confirm_password)) {
        header("Location: register.html?error=empty_passwords");
        exit();
    }

    // Check if the hashed passwords match
    if ($hashed_password !== $hashed_confirm_password) {
        header("Location: register.html?error=passwords_do_not_match");
        exit();
    }

    // Prepare the statement to check for existing users
    $check_stmt = $conn->prepare("SELECT id FROM bookingsystem.users WHERE username = ? OR email = ?");
    if (!$check_stmt) {
        error_log("Prepare failed: " . $conn->error);
        header("Location: register.html?error=prepare_failed");
        exit();
    }

    $check_stmt->bind_param("ss", $username, $email);
    if (!$check_stmt->execute()) {
        error_log("Execute failed: " . $check_stmt->error);
        header("Location: register.html?error=execute_failed");
        exit();
    }

    $check_stmt->store_result();

    // Check if a row with the same username or email already exists
    if ($check_stmt->num_rows > 0) {
        header("Location: register.html?error=user_exists");
        exit();
    }

    // Close the check statement
    $check_stmt->close();

    // Prepare the statement to insert the new user
    $insert_stmt = $conn->prepare("INSERT INTO bookingsystem.users (id, username, email, phone, password) VALUES (UUID(), ?, ?, ?, ?)");
    if (!$insert_stmt) {
        error_log("Prepare failed: " . $conn->error);
        header("Location: register.html?error=prepare_failed");
        exit();
    }

    // Bind parameters and execute the statement
    $insert_stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);
    if (!$insert_stmt->execute()) {
        error_log("Execute failed: " . $insert_stmt->error);
        header("Location: register.html?error=execute_failed");
        exit();
    }

    // Registration successful
    header('Location: login.php');
    exit();

    // Close the statement and the connection
    $insert_stmt->close();
    $conn->close();
    ?>
