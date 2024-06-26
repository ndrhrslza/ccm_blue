<?php 
session_start();
require_once '../csrf.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        function hashPassword(event) {
            event.preventDefault();
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const hashedPasswordField = document.getElementById('hashed_password');
            const hashedConfirmPasswordField = document.getElementById('hashed_confirm_password');

            // Hash the passwords using SHA-256
            const hashedPassword = CryptoJS.SHA256(passwordField.value).toString();
            const hashedConfirmPassword = CryptoJS.SHA256(confirmPasswordField.value).toString();
            
            // Set the hashed passwords to the hidden fields
            hashedPasswordField.value = hashedPassword;
            hashedConfirmPasswordField.value = hashedConfirmPassword;
            
            // Clear the plain text password fields
            passwordField.value = '';
            confirmPasswordField.value = '';
            
            // Submit the form
            document.getElementById('registerForm').submit();
        }
    </script>
</head>
<body>
    <div class="center">
        <h1>Register</h1>
        <form id="registerForm" method="post" action="form.php" onsubmit="hashPassword(event)">
            <div class="txt_field">
                <label>Username</label>
                <input type="text" name="username" pattern="[a-zA-Z0-9_]{3,16}" placeholder="JohnDoe" required>
                <span></span>
            </div>
            <div class="txt_field">
                <label>Email Address</label>
                <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$" placeholder="john@example.com" required>
                <span></span>
            </div>
            <div class="txt_field">
                <label>Phone Number</label>
                <input type="text" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="012-345-6789" required>
                <span></span>
            </div>
            <div class="txt_field">
                <label>Password</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" 
                       title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character." required>
                <span></span>
            </div>
            <div class="txt_field">
                <label>Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span></span>
            </div>
            <input type="hidden" id="hashed_password" name="hashed_password">
            <input type="hidden" id="hashed_confirm_password" name="hashed_confirm_password">
            <div class="forgot">Already have an account? <a href="login.php">Login</a></div>
            <input type="submit" value="Register">
            <input type="hidden" name="_token" value="<?php echo $token;?>">
            <div id="errorMessage" style="color: red;"></div>
        </form>
    </div>

    <script src="register.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorMessage = document.getElementById("errorMessage");
            const params = new URLSearchParams(window.location.search);
            if (params.has('error')) {
                switch (params.get('error')) {
                    case 'empty_passwords':
                        errorMessage.textContent = "Passwords cannot be empty. Please try again.";
                        break;
                    case 'passwords_do_not_match':
                        errorMessage.textContent = "Passwords do not match. Please try again.";
                        break;
                    case 'prepare_failed':
                    case 'execute_failed':
                        errorMessage.textContent = "Registration failed. Please try again.";
                        break;
                    default:
                        errorMessage.textContent = "Username or email exist already. Please try again.";
                }
            }
        });
    </script>
</body>
</html>
