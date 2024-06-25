<?php
session_start();
include '../db.php';
include '../sop_validation.php';
include '../csp.php';
require_once '../csrf.php';

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Function to handle account lockout
function handle_lockout() {
    $_SESSION['lockout_time'] = time() + 10; // Lockout for 10 seconds
}

// Initialize error message
$error = '';
$success = false;

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['csrf_token'])) {
    // Check if account is currently locked out
    if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
        $seconds_remaining = $_SESSION['lockout_time'] - time();
        $error = "Account locked. Please try again in {$seconds_remaining} seconds.";
        $_SESSION['login_attempts'] = 0;
    } else  {
        $email = sanitize_input($_POST["email"]);
        $hashed_password = sanitize_input($_POST["hashed_password"]);

        // Check if user has exceeded the number of failed attempts
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
        }

        // Increment login attempts
        $_SESSION['login_attempts']++;

        // Query to retrieve user data
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $stored_hashed_password = $user_data["password"];

            // Compare the hashed passwords
            if ($hashed_password === $stored_hashed_password) {
                // Login successful, reset login attempts
                $_SESSION['login_attempts'] = 0;
                // Start session and redirect to profile page
                $_SESSION['logged_in'] = true;
                $_SESSION['role'] = 'user';
                $_SESSION["id"] = $user_data["id"];  // Store user ID in session
                $_SESSION["email"] = $email;
                $_SESSION["username"] = $user_data["username"];
                header("Location: ../homepage/index.html");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Email not found";
        }

        // Check if login attempts exceed threshold
        if ($_SESSION['login_attempts'] >= 3) {
            handle_lockout();
            $error = "Too many failed attempts. Account locked. Please try again in 10 seconds.";
        }
    }

    if ($success){
        unset($_SESSION['csrf_token']);
        unset($_SESSION['token_expire']);
        echo "<script>alert('Login Successful!')</script>";
        exit();
    }
}


// Check if the lockout period has expired
if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] <= time()) {
    unset($_SESSION['lockout_time']); // Clear lockout time
    $_SESSION['login_attempts'] = 0; // Reset login attempts
    $error = ''; // Reset error message
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        function hashPassword(event) {
            event.preventDefault();
            const passwordField = document.getElementById('password');
            const hashedPasswordField = document.getElementById('hashed_password');

            // Hash the password using SHA-256
            const hashedPassword = CryptoJS.SHA256(passwordField.value).toString();
            
            // Set the hashed password to the hidden field
            hashedPasswordField.value = hashedPassword;
            
            // Clear the plain text password field
            passwordField.value = '';
            
            // Submit the form
            document.getElementById('loginForm').submit();
        }
    </script>
</head>
<body>
<?php 
    if(!empty($csrf_error)){
        echo "<div class='alert alert-danger'><h2>".$csrf_error."</h2></div>";
    }?>

    <div class="center">
        <h1>Welcome</h1>
        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="hashPassword(event)">
            <div class="txt_field">
                <label>Email Address</label>
                <input type="email" name="email" pattern="[a-z0-9._%+-]+@gmail+\.[a-z]{2,}$" required>
                <span></span>
            </div>
            <div class="txt_field">
                <label>Password</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required>
                <span></span>
            </div>
            <input type="hidden" id="hashed_password" name="hashed_password">
            <input type="hidden" name="_token" value="<?php echo $token;?>">
            <input type="submit" value="Login">
            <div class="users_signup">
                Don't have an account? <a href="register.html">Register</a>
            </div>

            <div class="error"><?php echo $error; ?></div>
        </form>
    </div>
</body>
</html>
