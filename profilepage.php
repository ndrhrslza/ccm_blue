<?php
session_start();
include 'db.php';

// // Secure session settings
// ini_set('session.cookie_httponly', 1);
// ini_set('session.cookie_secure', 1); // Make sure this is enabled on HTTPS only
// ini_set('session.use_only_cookies', 1);

// Function to sanitize output data
function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // Fetch user information
    $sql = "SELECT username, email, phone FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $username = sanitize_output($user_data['username']);
        $email = sanitize_output($user_data['email']);
        $phone = sanitize_output($user_data['phone']);
    } else {
        $username = $email = $phone = "N/A";
    }

    $stmt->close();
} else {
    header("Location: login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="index.js"></script>
    <!-- Content Security Policy -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';">
</head>
<body>
    <div id="header"></div>
    <section class="profile-info">
        <h2>Account Information</h2>
        <ul>
            <li><strong>Username:</strong> <?php echo $username; ?></li>
            <li><strong>Email:</strong> <a href='mailto:<?php echo $email; ?>'><?php echo $email; ?></a></li>
            <li><strong>Phone Number:</strong> <?php echo $phone; ?></li>
        </ul>
    </section>
    <div class="button-container">
        <input type="button" value="Order History" onclick="location.href='orderhistory.php';">
        <input type="button" value="Delete Account" onclick="location.href='deleteacc.php';">
        <input type="button" value="Edit Profile" onclick="location.href='edit.php';">
    </div>
    <div id="footer"></div>
</body>
</html>
