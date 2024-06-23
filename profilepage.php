<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="index.js"></script>
</head>
<body>
    <div id="header"></div>
        <section class="profile-info">
            <h2>Account Information</h2>
            <?php
            session_start();
            include 'db.php';

            if (isset($_SESSION['id'])) {
                $user_id = $_SESSION['id'];

                // Fetch user information
                $sql = "SELECT username, email, phone FROM users WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<ul>";
                        echo "<li><strong>Username:</strong> " . $row["username"] . "</li>";
                        echo "<li><strong>Email:</strong> <a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a></li>";
                        echo "<li><strong>Phone Number:</strong> " . $row["phone"] . "</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "0 results";
                }
            } else {
                echo "User not logged in";
            }
            ?>
        </section>
          <div class="button-container">
          <input type="button" value="Order History" onclick="location.href='orderhistory.php';">
          <input type="button" value="Delete Account" onclick="location.href='deleteacc.php';">
          <input type="button" value="Edit Profile" onclick="location.href='edit.php';">
          </div>

    <div id="footer"></div>
</body>
</html>
