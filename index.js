// document.addEventListener("DOMContentLoaded", function() {
//     fetch("header.html")
//         .then(response => response.text())
//         .then(data => {
//             document.getElementById("header").innerHTML = data;
//         });

//     fetch("footer.html")
//         .then(response => response.text())
//         .then(data => {
//             document.getElementById("footer").innerHTML = data;
//         });
// });

// document.addEventListener("DOMContentLoaded", function() {
//     // Fetch and insert header
//     fetch("header.html")
//         .then(response => response.text())
//         .then(data => {
//             document.getElementById("header").innerHTML = data;
//             // Check login status and update navigation
//             checkLoginStatus(updateAuthLink);
//         });

//     // Fetch and insert footer
//     fetch("footer.html")
//         .then(response => response.text())
//         .then(data => {
//             document.getElementById("footer").innerHTML = data;
//         });
// });

// // Function to check login status via AJAX
// function checkLoginStatus(callback) {
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', 'login_status.php', true);
//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             const response = JSON.parse(xhr.responseText);
//             callback(response.isLoggedIn);
//         } else {
//             console.error('Failed to check login status');
//             callback(false);
//         }
//     };
//     xhr.send();
// }

// // Function to update the auth link in the navigation
// function updateAuthLink(isLoggedIn) {
//     const authLink = document.querySelector('.navigation .authLink');
//     if (authLink) {
//         if (isLoggedIn) {
//             authLink.innerHTML = '<a href="logout.php">Logout</a>';
//         } else {
//             authLink.innerHTML = '<a href="login.php">Login</a>';
//         }
//     }
// }
// sop_check.js

document.addEventListener("DOMContentLoaded", function() {
    // Same Origin Policy check
    const allowedOrigins = ['https://final.com'];
    if (!allowedOrigins.includes(document.origin)) {
        alert('Access Denied: Invalid Origin');
        window.location.href = 'https://final.com/ccm_blue/login.php'; 
        return; // Stop further execution
    }

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
