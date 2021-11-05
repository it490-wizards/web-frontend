<?php

require_once "../include/rpc_client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db_client = new DatabaseRpcClient();

    if ($db_client->call("login", $username, $password))
        echo "Welcome {$user->username}!";
    else
        echo "Incorrect username or password";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="emitLogin.php" method="post">
        <label for="input-username">
            Username
            <input type="text" name="username" id="input-username">
        </label>
        <label for="input-password">
            Password
            <input type="password" name="password" id="input-password">
        </label>
        <input type="submit" name="submit" value="Login">
    </form>
</body>

</html>
