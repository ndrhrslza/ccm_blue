<!--
Prepared by Nadirah
Edit Profile page for users to update their profile information
Users can update their username, email, phone number, and password
Passwords are hashed before being stored in the database for security
-->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="../homepage/index.js"></script>
    <script>
        // Function to hash the password using SHA-256
        function hashPassword(password) {
            return CryptoJS.SHA256(password).toString();
        }

        // Handle form submission
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");

            form.addEventListener("submit", function(event) {
                const oldPasswordField = document.getElementById("old_password");
                const newPasswordField = document.getElementById("new_password");
                const confirmPasswordField = document.getElementById("confirm_password");

                // Hash passwords before submission
                if (oldPasswordField.value) {
                    oldPasswordField.value = hashPassword(oldPasswordField.value);
                }
                if (newPasswordField.value) {
                    newPasswordField.value = hashPassword(newPasswordField.value);
                }
                if (confirmPasswordField.value) {
                    confirmPasswordField.value = hashPassword(confirmPasswordField.value);
                }
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
    <div id="header"></div>
    <main>
        <section class="edit-profile">
            <h2>Edit Profile</h2>
            <?php
            session_start();
            include '../sop_validation.php';
            require_once '../db.php';
            include '../csp.php';
            require_once '../csrf.php';

            // Regenerate session ID after login
            if (isset($_SESSION['id'])) {
                session_regenerate_id();
            }

            // Function to sanitize user input
            function sanitize_input($data) {
                return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
            }

            // Retrieve user information from database
            $user_id = $_SESSION['id'];
            $sql = "SELECT username, email, phone FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch user information
            $user_data = $result->fetch_assoc();

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] === "POST" && $_SESSION['role'] === 'user') {
                // Validate input
                $username = sanitize_input($_POST['username']);
                $email = sanitize_input($_POST['email']);
                $phone = sanitize_input($_POST['phone']);
       

                // Check if passwords match and are not empty
                if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
                    // Validate old password and update new password
                    $sql_check_password = "SELECT password FROM users WHERE id = ?";
                    $stmt_check_password = $conn->prepare($sql_check_password);
                    $stmt_check_password->bind_param("s", $user_id);
                    $stmt_check_password->execute();
                    $result_check_password = $stmt_check_password->get_result();

                    if ($result_check_password->num_rows == 1) {
                        $row = $result_check_password->fetch_assoc();
                        $stored_password = $row['password'];
                       

                        if ($old_password == $stored_password) {
                            // Passwords match, update new password
                            if ($new_password == $confirm_password) {
                                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                                $sql_update_password = "UPDATE users SET password = ? WHERE id = ?";
                                $stmt_update_password = $conn->prepare($sql_update_password);
                                $stmt_update_password->bind_param("ss", $hashed_password, $user_id);
                                if ($stmt_update_password->execute()) {
                                    echo "<p>Password updated successfully.</p>";
                                } else {
                                    echo "<p>Error updating password: " . $stmt_update_password->error . "</p>";
                                }
                            } else {
                                echo "<p>New passwords do not match.</p>";
                            }
                        } else {
                            echo "<p>Old password is incorrect.</p>";
                        }
                    } else {
                        echo "<p>Error retrieving user information.</p>";
                    }

                    $stmt_check_password->close();
                }

                // Update profile information if password update was successful or not requested
                if (empty($old_password) || $new_password == $confirm_password) {
                    $sql_update_profile = "UPDATE users SET username=?, email=?, phone=? WHERE id=?";
                    $stmt_update_profile = $conn->prepare($sql_update_profile);
                    $stmt_update_profile->bind_param("ssss", $username, $email, $phone, $user_id);

                    if ($stmt_update_profile->execute()) {
                        echo "<p>Profile updated successfully.</p>";
                    } else {
                        echo "<p>Error updating profile: " . $stmt_update_profile->error . "</p>";
                    }

                    $stmt_update_profile->close();
                }

                $conn->close();
            }

            // Display user information in a form
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" pattern="[a-zA-Z0-9_]{3,16}" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" pattern="[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$"  required><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>"  pattern="\d{3}-\d{3}-\d{4}" required><br><br>

        

                <center><input type="submit" value="Update Profile"></center>
                <input type="hidden" name="_token" value="<?php echo $token;?>">
            </form>
        </section>
    </main>

    <div id="footer"></div>
</body>
</html>
