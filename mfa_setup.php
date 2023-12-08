<?php
session_start();

require_once 'vendor/autoload.php';
$ga = new PHPGangsta_GoogleAuthenticator();

if (!isset($_SESSION['login_user'])) {
    header("location: index.php");
    exit();
}

// Generate a secret key for the user
$secret = $ga->createSecret();
$_SESSION['mfa_secret'] = $secret;

// Display QR code
$qrCodeUrl = $ga->getQRCodeGoogleUrl('YourAppName', $secret);
echo "Scan this QR code with your Google Authenticator app:<br/>";
echo "<img src='".$qrCodeUrl."' />";

// Add a form for the user to enter the code
echo "<form action='mfa_verify.php' method='post'>";
echo "<input type='text' name='code' placeholder='Enter the code'/>";
echo "<input type='submit' value='Verify'/>";
echo "</form>";
?>