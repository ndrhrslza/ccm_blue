<?php
// session_start();
// include '../sop_validation.php';
// include '../csp.php';

// $response = array('isLoggedIn' => false);

// if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['role'] === 'user'){
//     $response['isLoggedIn'] = true;
// } else {
//     $response['isLoggedIn'] = false;
    
// }

// echo json_encode($response);

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
