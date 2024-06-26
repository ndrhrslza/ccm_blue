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

2. **Encoding**:
   - Encoding is used to ensure data is securely transmitted and displayed, preventing injection attacks and XSS vulnerabilities by encoding output data.
   - ![image](https://github.com/ndrhrslza/ccm_blue/assets/85787305/772c1eec-d5ff-4d9a-a19c-c222a174816b) (form.php)

3. **Comparison Login with Hashed Password**:
   - User login credentials are verified by comparing the entered password with the stored hashed password, ensuring secure authentication processes.

4. **Using Strong Hashing Algorithms**:
   - Strong hashing algorithms such as bcrypt are used to hash passwords, making it computationally difficult for attackers to reverse-engineer passwords.

5. **SSL (Secure Sockets Layer)**:
   - SSL is implemented to encrypt data transmitted between the server and client, ensuring the confidentiality and integrity of sensitive information.

6. **Account Lockout After Three Failed Attempts**:
   - To prevent brute force attacks, user accounts are temporarily locked after three consecutive failed login attempts.

7. **Encrypted Password During Submission**:
   - Passwords are encrypted during form submission to prevent interception by malicious actors during transmission.

8. **Unique Account Identification**:
   - The application enforces unique usernames and email addresses to prevent duplicate accounts and ensure each account is uniquely identifiable.

9. **Prepared Statements**:
   - Prepared statements are used for database queries to protect against SQL injection attacks, ensuring safe handling of user inputs.

10. **Authorization on Every Request**:
    - Authorization checks are performed on every request to ensure users only access resources and functionalities they are permitted to use.

11. **Authentication**:
    - Robust authentication mechanisms are in place to verify user identities before granting access to restricted areas of the application.

12. **Hashing, Salting, and Sanitizing Input**:
    - User inputs are hashed and salted to enhance password security, and sanitized to prevent injection attacks.

13. **CSRF Token Implementation**:
    - Cross-Site Request Forgery (CSRF) tokens are used to protect against CSRF attacks by ensuring that requests are legitimate and originate from authenticated users.

14. **Manipulation in Booking System**:
    - Measures are taken to prevent unauthorized manipulation of the booking system, ensuring the integrity of bookings and related transactions.

15. **Same-Origin Policy**:
    - The same-origin policy is enforced to prevent unauthorized scripts on other sites from accessing data on my application.

16. **HttpOnly Cookies**:
    - Cookies are set with the HttpOnly attribute to prevent client-side scripts from accessing them, mitigating the risk of XSS attacks.

17. **Content Security Policy (CSP)**:
    - A CSP is implemented to control the resources the browser is allowed to load, reducing the risk of XSS and data injection attacks.

18. **Idle Timeout**:
    - Sessions are configured to expire after a period of inactivity to reduce the risk of unauthorized access from unattended sessions.

19. **Hide Indexes**:
    - Directory listings are disabled to prevent attackers from viewing the structure of directories and files on the server.

20. **Hide Detailed Errors**:
    - Detailed error messages are hidden from users to prevent leaking information about the application's structure or vulnerabilities.

These security measures collectively enhance the robustness and resilience of the web application, safeguarding user data and maintaining a secure environment for users to interact with the system.

## References
- OWASP Cheat Sheet Series. Retrieved on 24 June 2024 from https://cheatsheetseries.owasp.org/
