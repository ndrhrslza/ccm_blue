

document.addEventListener("DOMContentLoaded", function() {

    // Fetch and insert header
    fetch("../homepage/header.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("header").innerHTML = data;
            // Check login status and update navigation
            checkLoginStatus(updateAuthLink);
        });

    // Fetch and insert footer
    fetch("../homepage/footer.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer").innerHTML = data;
        });
});

// Function to check login status via AJAX
function checkLoginStatus(callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../homepage/login_status.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            callback(response.isLoggedIn);
            console.log(response);
        } else {
            console.error('Failed to check login status');
            callback(false);
        }
    };
    xhr.send();
    console.log(xhr);
    console.log(xhr.responseText);
    
}

// Function to update the auth link in the navigation
function updateAuthLink(isLoggedIn) {
    const authLink = document.querySelector('.navigation .authLink');
    if (authLink) {
        if (isLoggedIn) {
            authLink.innerHTML = '<a href="../auth/logout.php">Logout</a>';
        } else {
            authLink.innerHTML = '<a href="../auth/login.php">Login</a>';
        }
    }
}



