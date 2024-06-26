<!--This file will check if the user is logged in and return the user role. (Prepared by Sorfina)-->

<?php
session_start();
include '../sop_validation.php';
include '../csp.php';

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
