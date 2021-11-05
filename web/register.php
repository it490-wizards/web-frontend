<?php

require_once "../include/rpc_client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email=$_POST["email"];
    $password = $_POST["password"];

    $db_client = new DatabaseRpcClient();

    if ($db_client->call("register", $username, $password, $email))
        echo "Success";
    else
        echo "Failure";
}
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
    <form action="emitRegister.php" method="post">
        <label for="input-username">
            Username
            <input type="text" name="username" id="input-username">
        </label>
        <label for="input-password">
            Email
            <input type="email" name="email" id="input-email">
        </label>
        <label for="input-password">
            Password
            <input type="password" name="password" id="input-password">
        </label>
        <input type="submit" name ="submit" value="Login">
    </form>
</body>
</html>
