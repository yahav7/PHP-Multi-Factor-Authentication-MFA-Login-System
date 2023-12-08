<?php
session_start();
$connect = mysqli_connect(
    'db', // service name
    'php_docker', // username
    'password', // password
    'php_docker' // db table
);

$error = ''; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = $_POST['password']; // Don't escape passwords

    // Use prepared statements to prevent SQL injection
    $stmt = $connect->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, now check for MFA setup
        $user_id = $user['id'];
        $_SESSION['user_id'] = $user_id; // Store user ID in session

        $mfa_stmt = $connect->prepare("SELECT secret FROM mfa_table WHERE user_id = ?");
        $mfa_stmt->bind_param("i", $user_id);
        $mfa_stmt->execute();
        $mfa_result = $mfa_stmt->get_result();

        if ($mfa_result->num_rows == 0) {
            header("location: mfa_setup.php");
            exit;
        } else {
            $_SESSION['login_user'] = $username;
            header("location: welcome.php");
            exit;
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<html>
   <head>
      <title>Login Page</title>
   </head>
   
   <body>
      <div>
         <form action="" method="post">
            <label>UserName :</label>
            <input type="text" name="username" /><br /><br />
            <label>Password :</label>
            <input type="password" name="password" /><br/><br />
            <input type="submit" value="Submit"/><br />
         </form>
         
         <div>
            <?php if (!empty($error)) { echo $error; } ?>
         </div>			
      </div>
   </body>
</html>
