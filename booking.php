<?php

// session_start();
// include 'db.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $phoneno = $_POST['phoneno'];
//     $adultTraveler = $_POST['adultTraveler'];
//     $childTraveler = $_POST['childTraveler'];
//     $destination = $_POST['destination'];
//     $totalAmount = $_POST['totalAmount'];
//     $payMethod = $_POST['payMethod'];
//     $bank = null;
//     $cardNumber = null;
//     $cardName = null;
//     $expiryDate = null;
//     $cvv = null;

//     if ($payMethod == 'internetbanking') {
//         $bank = $_POST['bank'];
//     } elseif ($payMethod == 'creditcard') {
//         $cardNumber = $_POST['cardNumber'];
//         $cardName = $_POST['cardName'];
//         $expiryDate = $_POST['expiryDate'];
//         $cvv = $_POST['cvv'];
//     }

//     $stmt = $conn->prepare("INSERT INTO booking (name, email, phoneno, adultTraveler, childTraveler, destination, totalAmount, payMethod, bank, cardNumber, cardName, expiryDate, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("sssissdssssss", $name, $email, $phoneno, $adultTraveler, $childTraveler, $destination, $totalAmount, $payMethod, $bank, $cardNumber, $cardName, $expiryDate, $cvv);

//     if ($stmt->execute()) {
//         echo json_encode(['message' => 'Booking successfully submitted!']);
//         header("Location: homepage.html");
//         exit(); 
//     } else {
//         echo json_encode(['message' => 'Error: ' . $stmt->error]);
//     }

//     $stmt->close();
//     $conn->close();
// }


// session_start();
// include 'db.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Function to sanitize input data
//     function sanitize_input($data) {
//         return htmlspecialchars(stripslashes(trim($data)));
//     }

//     // Get and sanitize form data
//     $name = sanitize_input($_POST['name']);
//     $email = sanitize_input($_POST['email']);
//     $phoneno = sanitize_input($_POST['phoneno']);
//     $adultTraveler = sanitize_input($_POST['adultTraveler']);
//     $childTraveler = sanitize_input($_POST['childTraveler']);
//     $destination = sanitize_input($_POST['destination']);
//     $totalAmount = sanitize_input($_POST['totalAmount']);
//     $payMethod = sanitize_input($_POST['payMethod']);
//     $bank = null;
//     $cardNumber = null;
//     $cardName = null;
//     $expiryDate = null;
//     $cvv = null;

//     // Validate input data
//     $errors = [];

//     if (!preg_match("/^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$/", $name)) {
//         $errors[] = "Invalid name format.";
//     }

//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $errors[] = "Invalid email format.";
//     }

//     if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phoneno)) {
//         $errors[] = "Invalid phone number format.";
//     }

//     if (!filter_var($adultTraveler, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
//         $errors[] = "Number of adult travelers must be at least 1.";
//     }

//     if (!filter_var($childTraveler, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
//         $errors[] = "Number of child travelers cannot be negative.";
//     }

//     if ($payMethod == 'internetbanking') {
//         $bank = sanitize_input($_POST['bank']);
//     } elseif ($payMethod == 'creditcard') {
//         $cardNumber = sanitize_input($_POST['cardNumber']);
//         $cardName = sanitize_input($_POST['cardName']);
//         $expiryDate = sanitize_input($_POST['expiryDate']);
//         $cvv = sanitize_input($_POST['cvv']);

//         if (!preg_match("/^\d{16}$/", $cardNumber)) {
//             $errors[] = "Invalid card number format.";
//         }

//         if (!preg_match("/^[A-Za-z\s]+$/", $cardName)) {
//             $errors[] = "Invalid card holder name format.";
//         }

//         if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $expiryDate)) {
//             $errors[] = "Invalid expiry date format.";
//         }

//         if (!preg_match("/^\d{3,4}$/", $cvv)) {
//             $errors[] = "Invalid CVV format.";
//         }
//     }

//     if (empty($errors)) {
//         // Prepare and bind
//         $stmt = $conn->prepare("INSERT INTO booking (name, email, phoneno, adultTraveler, childTraveler, destination, totalAmount, payMethod, bank, cardNumber, cardName, expiryDate, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//         $stmt->bind_param("sssissdssssss", $name, $email, $phoneno, $adultTraveler, $childTraveler, $destination, $totalAmount, $payMethod, $bank, $cardNumber, $cardName, $expiryDate, $cvv);

//         if ($stmt->execute()) {
//             // echo json_encode(['message' => 'Booking successfully submitted!']);
//             echo "Booking successfully submitted!";
//             // header("Location: homepage.html");
//             //exit(); 
//         } else {
//             echo json_encode(['message' => 'Error: ' . $stmt->error]);
//         }

//         $stmt->close();
//         $conn->close();
//     } else {
//         echo json_encode(['errors' => $errors]);
//     }}

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phoneno = sanitize_input($_POST['phoneno']);
    $adultTraveler = sanitize_input($_POST['adultTraveler']);
    $childTraveler = sanitize_input($_POST['childTraveler']);
    $destination = sanitize_input($_POST['destination']);
    $totalAmount = sanitize_input($_POST['totalAmount']);
    $payMethod = sanitize_input($_POST['payMethod']);
    $bank = null;
    $cardNumber = null;
    $cardName = null;
    $expiryDate = null;
    $cvv = null;

    $errors = [];

    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $errors[] = "Invalid name format.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phoneno)) {
        $errors[] = "Invalid phone number format.";
    }

    if (!filter_var($adultTraveler, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors[] = "Number of adult travelers must be at least 1.";
    }

    if (!is_numeric($childTraveler) || $childTraveler < 0 || filter_var($childTraveler, FILTER_VALIDATE_INT) === false) {
        $errors[] = "Number of child travelers must be a non-negative integer.";
    }

    if ($payMethod == 'internetbanking') {
        $bank = sanitize_input($_POST['bank']);
    } elseif ($payMethod == 'creditcard') {
        $cardNumber = sanitize_input($_POST['cardNumber']);
        $cardName = sanitize_input($_POST['cardName']);
        $expiryDate = sanitize_input($_POST['expiryDate']);
        $cvv = sanitize_input($_POST['cvv']);

        if (!preg_match("/^\d{16}$/", $cardNumber)) {
            $errors[] = "Invalid card number format.";
        }

        if (!preg_match("/^[A-Za-z\s]+$/", $cardName)) {
            $errors[] = "Invalid card holder name format.";
        }

        if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $expiryDate)) {
            $errors[] = "Invalid expiry date format.";
        }

        if (!preg_match("/^\d{3,4}$/", $cvv)) {
            $errors[] = "Invalid CVV format.";
        }
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO booking (name, email, phoneno, adultTraveler, childTraveler, destination, totalAmount, payMethod, bank, cardNumber, cardName, expiryDate, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissdssssss", $name, $email, $phoneno, $adultTraveler, $childTraveler, $destination, $totalAmount, $payMethod, $bank, $cardNumber, $cardName, $expiryDate, $cvv);

        if ($stmt->execute()) {
            // echo "Booking successfully submitted!";
            header("Location: homepage.html");
            exit();
        } else {
            echo json_encode(['message' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['errors' => $errors]);
    }
}




?>