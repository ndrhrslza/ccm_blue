<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="../homepage/index.js"></script>
</head>
<body>
    <div id="header"></div>
    <main>
        <section class="profile-info">
            <h2>Account Information</h2>
            <?php
session_start(); 


// Regenerate session ID after login
if (isset($_SESSION['id']) && $_SESSION['role'] == 'user') {
    session_regenerate_id();

// Include database connection securely
require_once '../db.php';
include '../csp.php';
include '../sop_validation.php';

// Validate and sanitize user input
$user_id = isset($_SESSION['id']) ? mysqli_real_escape_string($conn, $_SESSION['id']) : null;
// echo "<h3>Welcome, " . htmlspecialchars($_SESSION['username']) . "</h3>";

// Prepare and execute SQL query securely
$sql = "SELECT username, email, phone FROM users WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output data securely
while ($row = $result->fetch_assoc()) {
    echo "<ul>";
    echo "<li><strong>Username:</strong> ". htmlspecialchars($row["username"]). "</li>";
    echo "<li><strong>Email:</strong> <a href='mailto:". htmlspecialchars($row["email"]). "'>". htmlspecialchars($row["email"]). "</a></li>";
    echo "<li><strong>Phone Number:</strong> ". htmlspecialchars($row["phone"]). "</li>";
    echo "</ul>";
}
}else {
echo "<p>You are not logged in. Please log in to view this page.</p>";
exit();}

?>
    </section>
    </main>
          <div class="button-container">
          <input type="button" value="Order History" onclick="location.href='orderhistory.php';">
          <input type="button" value="Delete Account" onclick="location.href='deleteacc.php';">
          <input type="button" value="Edit Profile" onclick="location.href='edit.php';">
          </div>

    <div id="footer"></div>
</body>
</html>
