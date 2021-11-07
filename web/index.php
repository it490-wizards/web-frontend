<?php
$session_token = $_COOKIE["session_token"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>Home</h1>
    <?php if ($session_token === null) { ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php } else { ?>
        <a href="logout.php"> Logout</a>
    <?php } ?>

</body>

</html>
