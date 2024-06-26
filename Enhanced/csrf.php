<?php
$csrf_error = "";
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	$_SESSION["token_expire"] = time() + 1800; // 30 minutes = 1800 secs
}

$token = $_SESSION['csrf_token'];
$token_expire = $_SESSION["token_expire"];

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	if (isset($_POST["csrf_token"]) && !empty($token) && !empty($token_expire)) {
// 		if (time() >= $token_expire) {
// 			$csrf_error = "Token is expired. Please reload the form.";
// 			unset($_SESSION["csrf_token"]);
// 		}else{
// 			if (!hash_equals($token, $_POST['csrf_token'])) {
// 				$csrf_error = "Invalid Token";
// 			}
// 		}
// 	}else{
// 		$csrf_error = "Invalid Token";
// 	}
// }
?>