<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
    <script src="../homepage/index.js"></script>
    <!-- Content Security Policy -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';">
</head>
<body>
    <div id="header"></div>
    <section class="booking-info">
        <?php
        include '../db.php';
        session_start();
        include '../sop_validation.php';
        include '../csp.php';

        if (isset($_SESSION['id'])) {
            session_regenerate_id();
        }

        // Validate and sanitize user input
        // $user_id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
        $user_id = isset($_SESSION['id']) ? mysqli_real_escape_string($conn, $_SESSION['id']) : null;

        // Prepare and execute SQL query securely for booking info
        $sql_booking = "SELECT * FROM booking WHERE user_id = ?";
        $stmt_booking = $conn->prepare($sql_booking);
        $stmt_booking->bind_param("s", $user_id);
        $stmt_booking->execute();
        $result_booking = $stmt_booking->get_result();

        // Check if there are bookings
        if ($result_booking->num_rows > 0) {
            echo "<div class='receipt-container'>";
            echo "<div class='receipt-header'>";
            echo "</div>";

            echo "<div class='receipt-details'>";
            echo "<h2>Order History</h2>";
            echo "</div>";

            echo "<div class='order-details'>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Product Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total Amount</th>";
            echo "<th>Payment Method</th>";
            echo "<th>Order Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Output booking data securely
            while ($row_booking = $result_booking->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row_booking["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row_booking["destination"]) . "</td>";
                echo "<td>Adults - " . htmlspecialchars($row_booking["adultTraveler"]) . "<br>Children - " . htmlspecialchars($row_booking["childTraveler"]) . "</td>";
                echo "<td>" . htmlspecialchars($row_booking["totalAmount"]) . "</td>";
                echo "<td>" . htmlspecialchars($row_booking["payMethod"]) . "</td>";
                echo "<td>" . htmlspecialchars($row_booking["created_at"]) . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            // echo "<p>No bookings found.</p>";
            echo "<div class='receipt-container'>";
            echo "<div class='receipt-header'>";
            echo "</div>";

            echo "<div class='receipt-details'>";
            echo "<h2>Order History</h2>";
            echo "</div>";

            echo "<div class='order-details'>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Product Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total Amount</th>";
            echo "<th>Payment Method</th>";
            echo "<th>Order Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            echo "<tr>";
                echo "<td>"  ."</td>";
                echo "<td>" . "</td>";
                echo "<td>" . "</td>";
                echo "<td>"  . "</td>";
                echo "<td>" . "</td>";
                echo "<td>" . "</td>";
                echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }
        ?> 
    </section>

  
    <div id="footer"></div>
</body>
</html>


