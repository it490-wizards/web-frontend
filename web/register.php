<?php
session_start();

error_reporting(E_ALL);
require_once __DIR__ . "/../include/rpc_client.php";

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $_SESSION['usernameE']=$username;
    $_SESSION['emailE']=$email;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    $db_client = new DatabaseRpcClient();
    $hold =$db_client->call("register", $username, $password, $email);
    
    //if($hold) {
    $messageSubject="Cinema5D - Welcome!";
    $body= "Hi ".$username."!\r\n Welcome to Cinema5D! The best movie review site on the internet. Thank you for making an account with us. \r\n To get started, head on over to fill out your preferences form now!";
    mail($email, $messageSubject, $body);
    //} 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="input-username">
            Username
            <input type="text" name="username" id="input-username">
        </label>
        <label for="input-username">
            Email
            <input type="email" name="email" id="input-username">
        </label>
        <label for="input-password">
            Password
            <input type="password" name="password" id="input-password">
        </label>
        <input type="submit" name ="register" value="Register" >
    </form>
</body>

</html>