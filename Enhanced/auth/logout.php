<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="center">
    <h1>Logout</h1>
    <p>You have been successfully logged out.</p>
    <p>Click <a href="index.html">here</a> to return to the homepage.</p>
    
</div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="../auth/styles.css">
</head>
<body>
<div class="center">
    <h1>Logout</h1>
    <center><p>You have been successfully logged out.</p>
    <p>Click <a href="../homepage/index.html">here</a> to return to the homepage.</p></center>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Fetch and insert header
    fetch("header.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("header").innerHTML = data;
            // Check login status and update navigation
            checkLoginStatus(updateAuthLink);
        });

    // Fetch and insert footer
    fetch("footer.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer").innerHTML = data;
        });
});

// Function to check login status via AJAX
function checkLoginStatus(callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'login_status.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            callback(response.isLoggedIn);
        } else {
            console.error('Failed to check login status');
            callback(false);
        }
    };
    xhr.send();
}

// Function to update the auth link in the navigation
function updateAuthLink(isLoggedIn) {
    const authLink = document.querySelector('.navigation .authLink');
    if (authLink) {
        if (isLoggedIn) {
            authLink.innerHTML = '<a href="logout.php">Logout</a>';
        } else {
            authLink.innerHTML = '<a href="login.php">Login</a>';
        }
    }
}
</script>

</body>
</html>

<?php
session_start();
include '../sop_validation.php';
include '../csp.php';

// Clear all session data
session_unset();

// Destroy the session
session_destroy();
?>
