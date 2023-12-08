<?php
session_start();

require_once 'vendor/autoload.php';
$ga = new PHPGangsta_GoogleAuthenticator();

if (!isset($_SESSION['login_user']) || !isset($_SESSION['mfa_secret'])) {
    header("location: index.php");
    exit();
}

$secret = $_SESSION['mfa_secret'];
$userCode = $_POST['code'];

// Verify the code
if ($ga->verifyCode($secret, $userCode, 2)) {
    // Save the secret to your database associated with the user
    // Redirect to welcome page
    header("location: welcome.php");
} else {
    echo "Invalid code, try again.";
}
?>
