<?php

require_once __DIR__ . "/../include/rpc_client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    $db_client = new DatabaseRpcClient();

    if ($db_client->call("register", $username, $password, $email)) {
        echo "Success";
    } else {
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
        <input type="submit" value="Register">
    </form>
</body>

</html>