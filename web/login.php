<?php

require_once __DIR__ . "/../include/rpc_client.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db_client = new DatabaseRpcClient();
    $session_token = $db_client->call("login", $username, $password);

    if ($session_token === null) {
        echo "Incorrect username or password";
    } else {
        setcookie("session_token", $session_token);
        header("Location: /");
    }
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
    <form action="login.php" method="post">
        <label for="input-username">
            Username
            <input type="text" name="username" id="input-username">
        </label>
        <label for="input-password">
            Password
            <input type="password" name="password" id="input-password">
        </label>
        <input type="submit" value="Login">
    </form>
</body>

</html>
