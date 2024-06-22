<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $adultTraveler = $_POST['adultTraveler'];
    $childTraveler = $_POST['childTraveler'];
    $destination = $_POST['destination'];
    $totalAmount = $_POST['totalAmount'];
    $payMethod = $_POST['payMethod'];
    $bank = null;
    $cardNumber = null;
    $cardName = null;
    $expiryDate = null;
    $cvv = null;

    if ($payMethod == 'internetbanking') {
        $bank = $_POST['bank'];
    } elseif ($payMethod == 'creditcard') {
        $cardNumber = $_POST['cardNumber'];
        $cardName = $_POST['cardName'];
        $expiryDate = $_POST['expiryDate'];
        $cvv = $_POST['cvv'];
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO booking (name, email, phoneno, adultTraveler, childTraveler, destination, totalAmount, payMethod, bank, cardNumber, cardName, expiryDate, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissdssssss", $name, $email, $phoneno, $adultTraveler, $childTraveler, $destination, $totalAmount, $payMethod, $bank, $cardNumber, $cardName, $expiryDate, $cvv);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Booking successfully submitted!']);
        header("homepage.html");
        exit(); // Ensure script termination after redirection
    } else {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>