//Prepared by: Sorfina
//JavaScript for the homepage. Fetches and inserts the header and footer, and checks the login status to update the navigation.


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
            callback(response);
        } else {
            console.error('Failed to check login status');
            callback({ isLoggedIn: false, role: 'guest' }); // Handle error or default to guest role
        }
    };
    xhr.send();
}

// Function to update the auth link in the navigation
function updateAuthLink(response) {
    const authLink = document.querySelector('.navigation .authLink');
    if (authLink) {
        if (response.isLoggedIn) {
            if (response.role === 'user') {
                authLink.innerHTML = '<a href="../auth/logout.php">Logout</a>';
            } else if (response.role === 'guest') {
                authLink.innerHTML = '<a href="../auth/login.php">Login</a>';
            } else {
                console.warn('Unknown role:', response.role);
                authLink.innerHTML = '<a href="../auth/login.php">Login</a>'; // Default action for unknown role
            }
        } else {
            authLink.innerHTML = '<a href="../auth/login.php">Login</a>';
        }
    }
}
