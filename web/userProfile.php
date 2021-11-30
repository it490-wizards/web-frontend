<?php

$session_token = $_COOKIE["session_token"]??null;
require_once __DIR__ . "/../include/rpc_client.php";
$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);
if ($userID===0){
  http_response_code(403);
  die();
}

/*if(isset($_POST["follow"])){
  $followerID=$userID;
  $followedID=$_POST["hidden_userID"];
  $db_client->call("addFollow", $followerID, $followedID);
}*/
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>User Page</title>
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

  <?php
     $userID=(int)$_GET["userID"]; //gets from URL
     $userPageID=$userID;
     $response1=$db_client->call("getUserReviews",$userPageID);

     foreach($response1 as $attribute1){
  ?> 
<h5 class="text-info">   <?php echo $attribute1->username;?></h5>
<h5 class="text-info">Number of Followers: <?php echo $attribute1->followers;?></h5>
<hr></hr>
<div class="container">
<form method="POST" action = "userProfile.php">
<div class="card" style="width: 40vw;">  
<div class="card-body">  
<h3 class="text-info"><?php echo $attribute1->title;?></h3>  
<h3 class="text-info"><?php echo $attribute1->description;?></h3>  
<h3 class="card-subtitle mb-2 text-muted">Rating: <?php echo $attribute1->reviewRating;?></h3>
<h3 class="text-info">Review: <?php echo $attribute1->reviewText;?></h3>  
<a type="button" href="movie.php?movie_id=<?php echo $attribute1->movie_id;?>"style="margin-top:5px;" class="btn btn-success">Check out this movie's page and reviews!</a>  

</div>
</div>
</form> 
</div> 

<?php } ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
