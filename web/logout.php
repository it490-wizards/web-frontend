<?php
session_start();


require_once __DIR__ . "/../include/rpc_client.php";
$session_token = $_COOKIE["session_token"];
$db_client = new DatabaseRpcCLient();


if ($_SESSION['userIDE']===0){
    http_response_code(403);
  die();
}
$library=$db_client->call("getSaved",$_SESSION['userIDE']);
if(!empty($library)){
    //$responseInfo=$db_client->call("getUserInfo",$userID);
    //foreach($responseInfo as $attributeInfo){
        //$username= //$attributeInfo->username;
        //$email= //$attributeInfo->email;
    //}
    $messageSubject1="Cinema5D - Review Saved Movies!";
    $count=count($library);
    $body1= "Hi ".$_SESSION['usernameE']."!\r\n". $count." movies are waiting in your library... Review them now!";
    mail($_SESSION['emailE'], $messageSubject1, $body1);
}

$db_client->call("logout", $session_token);
$session_token=$_COOKIE["session_token"]= null;
echo $session_token;
//header("Location: /");
?>