<?php

require_once __DIR__ . "/../include/rpc_client.php";
$session_token = $_COOKIE["session_token"]??null;
$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);
if ($userID===0){
   http_response_code(403);
   die();
}

//$userID=19;
if(isset($_POST["submit"])){ 

$duration=(int)$_POST["duration"];
$year=(int)$_POST["era"];
$language=$_POST["language"];
$genre =$_POST["genre"];

$response=$db_client->call("addForm",$userID,$genre,$duration,$year,$language);
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <title>Select Your Preferences!</title>
   </head>
   <body>

   <nav class="navbar navbar-light bg-primary navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">Cinema5D</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forum">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
   
  
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
                           <option type = "number" value="60">60 minutes</option>
                           <option type = "number" value="100">100 minutes</option>
                           <option type = "number" value="120">120 minutes</option>
                           <option type = "number" value="150">150 minutes</option>
                           <option type = "number" value="180">180 minutes</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Do you like movies from a specific decade?</label>
                        <select name="era" id="era" class="form-control" required>
                           <option type = "number" value="1970">70s</option>
                           <option type = "number" value="1980">80s</option>
                           <option type = "number" value="1990">90s</option>
                           <option type = "number" value="2000">2000s</option>
                           <option type = "number" value="2010">2010s</option>
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
                        <input type="submit" name="submit" style="margin-top:5px;" href = "home.php" class="btn btn-success" value="Go to Recommended Movies!" />  
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   </body>
</html>