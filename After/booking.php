<?php


session_start();
include 'csp.php';
include 'db.php';
include 'sop_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Retrieve user_id from session
    $user_id = $_SESSION["id"];

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
        $stmt = $conn->prepare("INSERT INTO booking ( name, email, phoneno, adultTraveler, childTraveler, destination, totalAmount, payMethod, bank, cardNumber, cardName, expiryDate, cvv, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisdssssssi", $name, $email, $phoneno, $adultTraveler, $childTraveler, $destination, $totalAmount, $payMethod, $bank, $cardNumber, $cardName, $expiryDate, $cvv, $user_id);

        if ($stmt->execute()) {
            // echo "Booking successfully submitted!";
            header("Location: orderhistory.php");
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