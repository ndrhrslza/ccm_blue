<!--Session Handler (Prepared by Sorfina)-->

<?php
// session_start();

// // Set timeout duration (e.g., 1800 seconds = 30 minutes)
// $timeout_duration = 20;

// // Check if the last activity timestamp is set
// if (isset($_SESSION['LAST_ACTIVITY'])) {
//     // Calculate the session's lifetime
//     $session_lifetime = time() - $_SESSION['LAST_ACTIVITY'];

//     // If the session has been idle for too long, destroy it
//     if ($session_lifetime > $timeout_duration &&  $_SESSION['logged_in']){
//         session_unset();     // Unset $_SESSION variable for the run-time 
//         session_destroy();   // Destroy session data in storage
//         header("Location: ../idle.php"); // Redirect to logout page or any other page
//         exit();
//     }
// }

// // Update last activity timestamp
// $_SESSION['LAST_ACTIVITY'] = time();
?>
