<?php
//include 'csp.php';
session_start();

$response = array('isLoggedIn' => false);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $response['isLoggedIn'] = true;
}

echo json_encode($response);
?>
