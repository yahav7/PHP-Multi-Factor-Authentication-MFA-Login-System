<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: index.php");
    exit();
}

$username = $_SESSION['login_user'];
$user_ip = $_SERVER['REMOTE_ADDR'];

function get_location($ip) {
    $url = "http://ip-api.com/json/{$ip}";
    $json = @file_get_contents($url); // Suppress errors
    if (!$json) {
        return 'Location not available';
    }
    $data = json_decode($json);
    return $data->country . ", " . $data->city;
}

$location = get_location($user_ip);
?>




<html>
   <head>
      <title>Welcome</title>
   </head>
   
   <body>
      <h1>Welcome to the Dashboard</h1>
      <p>User: <?php echo htmlspecialchars($username); ?></p>
      <p>Your IP Address: <?php echo htmlspecialchars($user_ip); ?></p>
      <p>Location: <?php echo htmlspecialchars($location); ?></p>
   </body>
</html>
