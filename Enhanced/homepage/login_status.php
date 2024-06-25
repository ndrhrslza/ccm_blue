<?php
session_start();
include '../sop_validation.php';
include '../csp.php';

$response = array('isLoggedIn' => false);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $response['isLoggedIn'] = true;
}

echo json_encode($response);
?>
