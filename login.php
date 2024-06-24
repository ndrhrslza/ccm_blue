<?php
session_start();
include 'db.php';

$error = '';
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to retrieve user data
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $hashed_password = $user_data["password"];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Login successful, start session and redirect to profile page
            $_SESSION['logged_in'] = true;
            $_SESSION["id"] = $user_data["id"];  // Store user ID in session
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $user_data["username"];
            header("Location: homepage.html");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="center">
        <h1>Welcome</h1>
        <form method="post" action="">
            <div class="txt_field">
                <label>Email Address</label>
                <input type="email" name="email" pattern="[a-z0-9._%+-]+@gmail+\.[a-z]{2,}$" required>
                <span> </span>
            </div>
            <div class="txt_field">
                <label>Password</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required>
                <span> </span>
            </div>
            <!-- <div class="forgot"> <a href='#'>Forgot Password</a></div> -->
            <input type="submit" value="Login">
            <div class="users_signup">
                Don't have an account? <a href="register.html">Register</a>
            </div>

            <div class="error"><?php echo $error; ?></div>

        </form>
    </div>
    <script src="form.js"></script>
</body>
</html>