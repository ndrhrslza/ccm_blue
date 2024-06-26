//Prepared by: Nadirah
// This file is for the register page. 
// It contains the password strength checker and the password match checker. 
// The password strength checker will display a message below the password input field to indicate whether the password is strong or not. 
// The password match checker will display an error message if the passwords do not match. 

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const message = document.createElement('div');
    passwordInput.parentNode.insertBefore(message, passwordInput.nextSibling);

    passwordInput.addEventListener('input', function() {
        const pattern = new RegExp(passwordInput.pattern);
        if (pattern.test(passwordInput.value)) {
            message.textContent = "Strong password!";
            message.style.color = "green";
        } else {
            message.textContent = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            message.style.color = "red";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const errorMessage = document.getElementById("errorMessage");

    form.addEventListener("submit", function(event) {
        // Clear any previous error message
        errorMessage.textContent = "";

        // Check if passwords match
        if (password.value !== confirmPassword.value) {
            event.preventDefault(); // Prevent form submission
            errorMessage.textContent = "Passwords do not match!";
        }
    });

    // Optional: You can add real-time validation feedback
    confirmPassword.addEventListener("input", function() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords do not match!");
        } else {
            confirmPassword.setCustomValidity("");
        }
    });
});
