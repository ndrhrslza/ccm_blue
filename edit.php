  <!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <script src="index.js"></script>
    <style>

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        /* Reset default margin and padding */
body, h1, h2, h3, p, ul, li, form, input {
    margin: 0;
    padding: 0;
}

body {
    font-family: Roboto, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

main {
    width: 80%;
    margin: auto;
    padding: 20px 0;
}

.edit-profile {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.edit-profile h2 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

form {
    max-width: 600px;
    margin: auto;
}

form label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

form input[type="text"],
form input[type="email"],
form input[type="password"] {
    width: calc(100% - 10px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

.form-error {
    color: red;
    margin-top: 5px;
}

.button-container {
    text-align: center;
    margin-top: 20px;
}

.button-container input[type="button"],
.button-container input[type="submit"] {
    padding: 10px 20px;
    margin-right: 10px;
    cursor: pointer;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
}

.button-container input[type="button"]:hover,
.button-container input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div id="header"></div>
    <main>
        <section class="edit-profile">
            <h2>Edit Profile</h2>
            <?php
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Update user information in database
                session_start();
                include 'db.php';

                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $user_id = $_SESSION['id'];

                // Check if passwords match and are not empty
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                $password_updated = false;

                if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
                    // Validate old password and update new password
                    $sql_check_password = "SELECT password FROM users WHERE id = ?";
                    $stmt_check_password = $conn->prepare($sql_check_password);
                    $stmt_check_password->bind_param("i", $user_id);
                    $stmt_check_password->execute();
                    $result_check_password = $stmt_check_password->get_result();

                    if ($result_check_password->num_rows == 1) {
                        $row = $result_check_password->fetch_assoc();
                        $stored_password = $row['password'];

                        if (password_verify($old_password, $stored_password)) {
                            // Passwords match, update new password
                            if ($new_password == $confirm_password) {
                                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                                $sql_update_password = "UPDATE users SET password = ? WHERE id = ?";
                                $stmt_update_password = $conn->prepare($sql_update_password);
                                $stmt_update_password->bind_param("si", $hashed_password, $user_id);
                                if ($stmt_update_password->execute()) {
                                    echo "<p>Password updated successfully.</p>";
                                    $password_updated = true;
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
                if ($password_updated || (empty($old_password) && empty($new_password) && empty($confirm_password))) {
                    $sql_update_profile = "UPDATE users SET username=?, email=?, phone=? WHERE id=?";
                    $stmt_update_profile = $conn->prepare($sql_update_profile);
                    $stmt_update_profile->bind_param("sssi", $username, $email, $phone, $user_id);

                    if ($stmt_update_profile->execute()) {
                        echo "<p>Profile updated successfully.</p>";
                    } else {
                        echo "<p>Error updating profile: " . $stmt_update_profile->error . "</p>";
                    }

                    $stmt_update_profile->close();
                }

                $conn->close();
            }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" pattern="[a-zA-Z0-9_]{3,16}" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"  pattern="[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$" required><br><br>

                <label for="phone">Phone Number:</label><br>
                <input type="text" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><br><br>

                <label for="old_password">Old Password:</label><br>
                <input type="password" id="old_password" name="old_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"  required><br><br>

                <label for="new_password">New Password:</label><br>
                <input type="password" id="new_password" name="new_password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required><br><br>

                <label for="confirm_password">Confirm New Password:</label><br>
                <input type="password" id="confirm_password" name="confirm_password"><br><br>

                <input type="submit" value="Update">
            </form>
        </section>
    </main>

    <div id="footer"></div>
</body>
</html>
