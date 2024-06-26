<?php
session_start();
require_once '../csrf.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <script src="../homepage/index.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            font-family: Roboto, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .contact-info, .contact-form {
            width: 40%;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div id="header"></div>
    <main>
        <section class="contact-info">
            <img class="bg" src="../img/photo-1571762305602-5499ef32da3a.jpg" alt="bg" height="100%" width="100%">
        </section>
        <section class="contact-form">
            <h2><center>We'd love to hear from you!</center></h2>
            <form id="contactForm" action="contact.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" pattern="^[a-zA-Z\s]{4,15}$" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$" required><br><br>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" pattern="^[a-zA-Z0-9\s.,!?@#%&*-_+=()]{3,100}$" required><br><br>
                <label for="message">Message:</label>
                <textarea id="message" name="message" pattern="^[a-zA-Z0-9\s.,!?@#%&*-_+=()]{10,100}$" required></textarea><br><br>
                <center><input type="submit" value="Send" class="submitcontact"></center>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            </form>
        </section>
    </main>
    <div id="footer"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var contactForm = document.getElementById("contactForm");

            contactForm.addEventListener("submit", function(event) {
                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var subject = document.getElementById("subject").value;
                var message = document.getElementById("message").value;

                var namePattern = /^[a-zA-Z\s]{4,15}$/;
                var emailPattern = /^[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$/;
                var subjectPattern = /^[a-zA-Z0-9\s.,!?@#%&*-_+=()]{3,100}$/;
                var messagePattern = /^[a-zA-Z0-9\s.,!?@#%&*-_+=()]{10,100}$/;

                if (!namePattern.test(name)) {
                    alert("Please enter a valid name (4-15 letters and spaces only).");
                    event.preventDefault();
                    return;
                }
                if (!emailPattern.test(email)) {
                    alert("Please enter a valid email address.");
                    event.preventDefault();
                    return;
                }
                if (!subjectPattern.test(subject)) {
                    alert("Please enter a valid subject (3-100 characters, letters, numbers, spaces, and selected punctuation).");
                    event.preventDefault();
                    return;
                }
                if (!messagePattern.test(message)) {
                    alert("Please enter a valid message (10-100 characters, letters, numbers, spaces, and selected punctuation).");
                    event.preventDefault();
                    return;
                }

                alert("Your inquiry has been successfully sent. We will get back to you soon.");
            });
        });
    </script>
</body>
</html>
