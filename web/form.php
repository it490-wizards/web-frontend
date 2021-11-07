<?php

require_once "../include/rpc_client.php";
$session_token = $_COOKIE["session_token"];
$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);

if(isset($_POST["submit"])){ 

$duration=$_POST["duration"];
$year=$_POST["era"];
$language=$_POST["language"];
$genre =$_POST["genre"];

$response=$db_client->call("addForm",$userID,$genre,$duration,$year,$language);
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Create Form</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <style type="text/css">
         .wrapper{
         width: 500px;
         margin: 0 auto;
         background-color:#337ab7;
		 
         }
         .btn-primary {
         color: #fff;
         background-color: #333;
         border-color: #2e6da4;
         }
         body {
         font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
         font-size: 14px;
         line-height: 1.42857143;
         color: #333;
         background-color: #b3e5fc;
         }
		 .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
	
    padding-top: 0px;
    background-color: #ff5722;
}
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
      </style>
   </head>
   <body>
      <div class="wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="page-header">
                     <h5>Select Preferences</h5>
                  </div>
                  <form action="form.php" method="post">
                     <div class="form-group">
                        <label>What's the longest runtime for a movie that you'd be interested in?</label>
                        <select name="duration" id="duration" class="form-control" required>
                           <option value="60">60 minutes</option>
                           <option value="100">100 minutes</option>
                           <option value="120">120 minutes</option>
                           <option value="150">150 minutes</option>
                           <option value="180">180 minutes</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Do you like movies from a specific decade?</label>
                        <select name="era" id="era" class="form-control" required>
                           <option value="1970">70s</option>
                           <option value="1980">80s</option>
                           <option value="1990">90s</option>
                           <option value="2000">2000s</option>
                           <option value="2010">2010s</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Do you like movies in a different language?</label>
                        <select name="language" id="language" class="form-control" required>
                           <option value="Spanish">Spanish</option>
                           <option value="Korean">Korean</option>
                           <option value="French">French</option>
                           <option value="Italian">Italian</option>
                           <option value="Hindi">Hindi</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>What genres do you prefer?</label>
                        <select name="genre" id="genre" class="form-control" required>
                           <option value="" selected></option>
                           <option value="Action">Action</option>
                           <option value="Horror">Horror</option>
                           <option value="Comedy">Comedy</option>
                           <option value="Romance">Romance</option>
                           <option value="Science Fiction">Science Fiction</option>
                           <option value="Drama">Drama</option>
                        </select>
                     </div>
                     <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>