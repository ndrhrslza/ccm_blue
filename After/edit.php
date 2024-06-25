<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <script src="index.js"></script>
    <style>

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        /* Reset default margin and padding */
body, h1, h2, h3, ul, li, form, input {
    margin: 0;
    padding: 0;
}
p{
    font-size: 20px;
    color: blue;
    text-align: center;

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
    font-size: 30px;
    color: #333;
    text-align: center;
}

form {
    max-width: 600px;
    margin: auto;
}

form label {
    font-weight: bold;
    font-size: 20px;
    margin-bottom: 5px;
    display: block;
}

form input[type="text"],
form input[type="email"],
form input[type="tel"],
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
session_start();
include 'sop_validation.php';

// Regenerate session ID after login
if (isset($_SESSION['id'])) {
    session_regenerate_id();
}

// Include database connection
require_once 'db.php';

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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match and are not empty
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

// Display user information in a form
?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" required><br><br>

                <label for="old_password">Current Password:</label>
                <input type="password" id="old_password" name="old_password"><br><br>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password"><br><br>

                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password"><br><br>

                <input type="submit" value="Update Profile">
            </form>
        </section>
    </main>

    <div id="footer"></div>
</body>
</html>
