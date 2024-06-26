# Final Assessment: Web Security Application

## Group name: Blue

## Team Members
| Name             | Matric No. |
|------------------|------------|
| Nadirah Binti Ros Liza       | 2027832    |
| Sorfina Alyia Binti Jazrry       | 2017326   |

## Title of the Web Application: Cuti-Cuti Melaka

## Introduction of the Web Application

Welcome to Cuti-Cuti Melaka, the gateway to exploring the rich history and vibrant culture of Melaka, Malaysia! This website is designed to make visitors' Melaka adventures seamless and memorable.

The site introduces an innovative booking system, allowing travelers to easily reserve tickets for some of Melaka's most popular attractions:

1. Taming Sari Tower: Visitors can experience breathtaking 360-degree views of the city.
2. Klebang Beach: Travelers can relax on the picturesque shores of the Malacca Strait.
3. A Famosa Water Park: Guests can enjoy thrilling water rides and family fun.
4. Dutch Square: Tourists can immerse themselves in the heart of Melaka's colonial history.

The user-friendly interface makes it simple for visitors to plan their itinerary and secure their spots at these must-visit locations.

The website also features:

- A stunning gallery showcasing Melaka's most popular destinations, giving visitors a preview of the wonders that await them.
- A convenient "Contact Us" feature, ensuring that help is just a click away if travelers need assistance or have questions about their visit.

Whether one is a history buff, a nature lover, or a thrill-seeker, Cuti-Cuti Melaka has something for everyone. The site helps visitors discover the magic of Melaka and create unforgettable memories in this UNESCO World Heritage city.

Travelers can start planning their Melaka getaway today with Cuti-Cuti Melaka – the one-stop platform for an enchanting Malaysian adventure!

## Objectives of the Enhancements

The primary objectives of this web application are:

- To implement robust security protocols to safeguard the web application from common vulnerabilities such as Cross-Site Scripting (XSS), Cross-Site Request Forgery (CSRF), and SQL Injection
- To strengthen the authentication and authorization mechanisms so only authorized users have access to sensitive data and functionalities like profile and booking features.
- To define and enforce user roles and permissions to restrict access based on the principle of least privilege, ensuring users can only access resources necessary for their role.
- To enforce strong password policies, including complexity requirements, regular password changes, and secure storage practices such as hashing and salting.

## Web Application Security Enhancements

To ensure the security of our web application, we have considered the following for enhancements of this web application:

1. **HTTPS Usage**: All communication between the client and the server is encrypted using HTTPS to prevent eavesdropping and man-in-the-middle attacks.

2. **Input Validation**: Proper input validation is implemented across the application to prevent SQL injection and XSS attacks.

3. **Authentication and Authorization**: Robust authentication mechanisms are in place to verify user identities, and strict authorization rules are enforced to control access to sensitive resources.

4. **Session Management**: Secure session management techniques are used to protect session data from tampering and session hijacking.

5. **Data Encryption**: Sensitive data such as passwords and payment information are encrypted both in transit and at rest to maintain confidentiality.

6. **Cross-Site Scripting (XSS) Prevention**: Output encoding is applied to user-supplied data to prevent XSS vulnerabilities.
   
7. **Cross-Site Request Forgery (CSRF)**: Use anti-CSRF tokens to ensure that requests made on behalf of authenticated users are valid and not initiated by malicious sites.
   
8. **Database Security Principles**: Employ parameterized queries and prepared statements to prevent malicious SQL code from being executed in the database.

9.  **Security Headers**: HTTP security headers are properly configured to enhance overall security posture.

Thus, we have implemented a comprehensive set of security measures to protect user data and ensure a secure browsing experience. Below is a detailed description of the security enhancements integrated into the application:

1. **ID Random Generation in User Table**:
   - Each user is assigned a unique, randomly generated ID upon registration to mitigate risks associated with predictable user IDs.
     <br>**UUID() in `form.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/d95ed734-88c0-457b-8ff3-2e059ad3810b)
     <br>**Result of UUID() in database** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/1704b0d1-838b-447e-ad68-7e7d6fb5dff5)

2. **Encoding**:
   - Encoding is used to ensure data is securely transmitted and displayed, preventing injection attacks and XSS vulnerabilities by encoding output data.<br>
     **Encoding in `form.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/55957636-ca00-47e3-b6a3-4c52bfac52b9)
     <br>
     **Encoding in `login_status.php`**<br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/6d40fa21-e95a-4d3d-8310-545eea959a02)
           

3. **Comparison Login with Hashed Password**:
   - User login credentials are verified by comparing the entered password with the stored hashed password, ensuring secure authentication processes.<br>
    **Comparison in `login.php`** <br>
    ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/df8bfb45-e30b-4056-a3d2-6651d533e681)
     <br>**Comparison in `editpassword.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/05089cf4-7c88-44bb-ae07-5a5d649f853e)
     
4. **Using Strong Hashing Algorithms**:
   - Strong hashing algorithms such as SHA256 are used to hash passwords, making it computationally difficult for attackers to reverse-engineer passwords. <br>
     **Strong hashing algorithm: SHA256** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/34ddd336-2e14-4e97-9c29-a69397758622)

5. **SSL Certificate for Localhost (Secure HTTPS Connection)**:
   - An SSL certificate is essential for creating a secure HTTPS connection on localhost. It encrypts data transmitted between the server and client, ensuring the confidentiality and integrity of sensitive information.<br>
     <br>**Cert files in the local machine** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/204eea3e-d3f2-4335-a7c9-97184400dd09) <br>
     **HTTPS on the browser** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/f165fac5-780b-4964-ab50-ca58d74ec083)

6. **Account Lockout After Three Failed Attempts**:
   - To prevent brute force attacks, user accounts are temporarily locked after three consecutive failed login attempts.
   - As shown in `login.php`
```php
// Check if account is currently locked out
if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
    $seconds_remaining = $_SESSION['lockout_time'] - time();
    $error = "Account locked. Please try again in {$seconds_remaining} seconds.";
    $_SESSION['login_attempts'] = 0;
}

// Increment login attempts
$_SESSION['login_attempts']++;

// Check if login attempts exceed threshold
if ($_SESSION['login_attempts'] >= 3) {
    handle_lockout();
    $error = "Too many failed attempts. Account locked. Please try again in 10 seconds.";
}
```


7. **Encrypted Password During Submission**:
   - Passwords are encrypted during form submission to prevent interception by malicious actors during transmission.
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/b5a6350d-8f0f-4b05-8c04-6be5c48d6a28)

8. **Unique Account Identification**:
   - The application enforces unique usernames and email addresses to prevent duplicate accounts and ensure each account is uniquely identifiable.
     <br>**Error shown during registration** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/66b7435f-b466-46be-aaa4-6c3a4babdb31)
     <br>**Checking the account in the `form.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/3b3d38ea-2377-4a4e-86df-426ae907a7b7)

9. **Prepared Statements**:
   - Prepared statements are used for database queries to protect against SQL injection attacks, ensuring safe handling of user inputs.
     <br>**Prepared statment in `form.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/6c0b3d18-6b16-401b-b3d4-69ba0d72cd58)
     <br>**Prepared statment in `bookingform.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/1ef3b74c-b3c1-4288-9c9e-e209b653a4d8)
     <br>**Prepared statment in `contact.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/00a41914-f7c0-408d-82ae-44f670cb306b)
     <br>**Prepared statment in `editprofile.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/e74fb1bf-29f8-41a5-bff3-3561e11cee29)
     <br>**Prepared statment in `editpassword.php`** <br>
     ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/7782b7c0-a680-46ed-bfcf-aa1c4e81c5a3)

10. **Authorization on Every Request**:
    - Authorization checks are performed on every request to ensure users only access resources and functionalities they are permitted to use.

11. **Authentication**:
    - Robust authentication mechanisms are in place to verify user identities before granting access to restricted areas of the application.
    - Using `login_status.php` to ensure that only `isloggedin=true` has access to do everything
      ``` php
      session_start();
      $response = array('isLoggedIn' => false, 'role' => '');
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
          // User is logged in
          $response['isLoggedIn'] = true;
          $response['role'] = $_SESSION['role']; // Retrieve and set the role
      } else {
          // User is not logged in
          $response['isLoggedIn'] = false;
          $response['role'] = 'guest'; // Set role to 'guest' for non-logged in users
      }
      echo json_encode($response);
      ?>
      ```
      **Usage in `scripts.js`** <br>
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/744a4b9a-b09c-4c1a-a2c7-c5dde76a48f6)
      <br>**Checking authentication in `bookingform.php`** <br>
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/2419fed5-380c-4786-ad6b-e4f0fc9b4974)
      <br>**Checking authentication in `profilepage.php`** <br>
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/a074772e-1270-4bde-ae0b-117ef09c588f)
   

12. **Hashing and Sanitizing Input**:
    - User inputs are hashed to enhance password security, and sanitized to prevent injection attacks.
      <br>**hashing and sanitizing input in  `form.php`** <br>
      ```php
      // Function to sanitize user input
      function sanitize_input($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
      }
      
      // Get and sanitize user input from the registration form
      $username = sanitize_input($_POST['username']);
      $email = sanitize_input($_POST['email']);
      $phone = sanitize_input($_POST['phone']);
      $hashed_password = sanitize_input($_POST['hashed_password']);
      $hashed_confirm_password = sanitize_input($_POST['hashed_confirm_password']);

      // Check if the hashed passwords match
      if ($hashed_password !== $hashed_confirm_password) {
        header("Location: register.php?error=passwords_do_not_match");
        exit();
      }
      ```
      <br>**hashing and sanitizing input in `login.php`**</br>
      ```php
      //Function to sanitize user input
      function sanitize_input($data) {
      return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
      }

       $email = sanitize_input($_POST["email"]);
        $hashed_password = sanitize_input($_POST["hashed_password"]);

      <script>
        function hashPassword(event) {
            event.preventDefault();
            const passwordField = document.getElementById('password');
            const hashedPasswordField = document.getElementById('hashed_password');

            // Hash the password using SHA-256
            const hashedPassword = CryptoJS.SHA256(passwordField.value).toString();
            
            // Set the hashed password to the hidden field
            hashedPasswordField.value = hashedPassword;
            
            // Clear the plain text password field
            passwordField.value = '';
            
            // Submit the form
            document.getElementById('loginForm').submit();
        }
      </script>
      ```
      <br>**hashing input for `register.php`**</br>
      ```php
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
      <script>
        function hashPassword(event) {
      event.preventDefault();
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const hashedPasswordField = document.getElementById('hashed_password');
            const hashedConfirmPasswordField = document.getElementById('hashed_confirm_password');

            // Hash the passwords using SHA-256
            const hashedPassword = CryptoJS.SHA256(passwordField.value).toString();
            const hashedConfirmPassword = CryptoJS.SHA256(confirmPasswordField.value).toString();
            
            // Set the hashed passwords to the hidden fields
            hashedPasswordField.value = hashedPassword;
            hashedConfirmPasswordField.value = hashedConfirmPassword;
            
            // Clear the plain text password fields
            passwordField.value = '';
            confirmPasswordField.value = '';
            
            // Submit the form
            document.getElementById('registerForm').submit();
        }
      </script>
      ```
      <br>**sanitizing input in `bookingfor.php`**</br>
      ```php
      //Get and sanitize user input from the booking form
      $name = sanitize_input($_POST['name']);
      $email = sanitize_input($_POST['email']);
      $phoneno = sanitize_input($_POST['phoneno']);
      $adultTraveler = sanitize_input($_POST['adultTraveler']);
      $childTraveler = sanitize_input($_POST['childTraveler']);
      $destination = sanitize_input($_POST['destination']);
      $totalAmount = sanitize_input($_POST['totalAmount']);
      $payMethod = sanitize_input($_POST['payMethod']);

      if ($payMethod == 'internetbanking') {
        $bank = sanitize_input($_POST['bank']);
      } elseif ($payMethod == 'creditcard') {
        $cardNumber = sanitize_input($_POST['cardNumber']);
        $cardName = sanitize_input($_POST['cardName']);
        $expiryDate = sanitize_input($_POST['expiryDate']);
        $cvv = sanitize_input($_POST['cvv']);
      ```
      <br>**sanitizing input in `contact.php`**</br>
      ```php
      //Get and sanitize form data
      $name = sanitize_input($_POST['name']);
      $email = sanitize_input($_POST['email']);
      $subject = sanitize_input($_POST['subject']);
      $message = sanitize_input($_POST['message']);
      ```
      <br>**sanitizing input in `editpassword.php`**</br>
      ```php
      $old_password = sanitize_input($_POST['old_password']);
      $new_password = sanitize_input($_POST['new_password']);
      $confirm_password = sanitize_input($_POST['confirm_password']);
      ```
      <br>**sanitizing input in `editprofile.php`**</br>
      ```php
      //Validate input
      $username = sanitize_input($_POST['username']);
      $email = sanitize_input($_POST['email']);
      $phone = sanitize_input($_POST['phone']);
      ```
13. **CSRF Token Implementation**:
    - Cross-Site Request Forgery (CSRF) tokens are used to protect against CSRF attacks by ensuring that requests are legitimate and originate from authenticated users.
      

14. **Manipulation in Booking System**:
    - Measures are taken to prevent unauthorized manipulation of the booking system, ensuring the integrity of bookings and related transactions.

15. **Same-Origin Policy**:
    - The same-origin policy is enforced to prevent unauthorized scripts on other sites from accessing data on my application.
      ```php
      // Validate Referer Header
         if (isset($_SERVER['HTTP_REFERER'])) {
             $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
             $allowed_domains = ['final.com']; 
         
             if (!in_array($referer, $allowed_domains)) {
                 header('HTTP/1.1 403 Forbidden');
                 die('Access Denied');
             }
         } else {
             header('HTTP/1.1 403 Forbidden');
             die('Access Denied');
         }
      ```
16. **HttpOnly Cookies**:
    - Cookies are set in the `https.conf` with the HttpOnly attribute to prevent client-side scripts from accessing them, mitigating the risk of XSS attacks.
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/0a278027-8e8c-44e6-af62-df51da9954b3)

17. **Content Security Policy (CSP)**:
    - A CSP is implemented to control the resources the browser is allowed to load, reducing the risk of XSS and data injection attacks.

18. **Idle Timeout**:
    - Sessions are configured to expire after a period of inactivity to reduce the risk of unauthorized access from unattended sessions.
    - 

19. **Hide Indexes**:
    - Directory listings are disabled to prevent attackers from viewing the structure of directories and files on the server. in `httpd.conf`
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/dd77b34f-7e92-42c8-9690-d68656ea1249)
20. **Hide Detailed Errors**:
    - Detailed error messages are hidden from users to prevent leaking information about the application's structure or vulnerabilities. in `php.ini`
      ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/af0819d9-a26e-4d78-868c-e5c069507f8a)

These security measures collectively enhance the robustness and resilience of the web application, safeguarding user data and maintaining a secure environment for users to interact with the system.

## References
- OWASP Cheat Sheet Series. Retrieved on 24 June 2024 from https://cheatsheetseries.owasp.org/
