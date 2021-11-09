<?php

require_once __DIR__ . "/../include/rpc_client.php";

$session_token = $_COOKIE["session_token"];

$db_client = new DatabaseRpcClient();
$db_client->call("logout", $session_token);

setcookie("session_token", null);
header("Location: /");
