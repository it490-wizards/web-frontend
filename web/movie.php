<?php

$session_token = $_COOKIE["session_token"]??null;
require_once __DIR__ . "/../include/rpc_client.php";
$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);
if ($userID===0){
  http_response_code(403);
  die();
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Movie Page!</title>
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
     $movieID=(int)$_GET["movie_id"]; //gets from URL
     $response1=$db_client->call("getMovie",$movieID);

     foreach($response1 as $attribute1){
  ?> 
<h6>     Movie</h6>
<h5 class="text-info">   <?php echo $attribute1->title;?></h5>
<h6>     Summary</h6>
<h5 class="text-info">   <?php echo $attribute1->description;?></h5>
<hr></hr>

<?php } ?>

<?php
    $response2=$db_client->call("getAllReviews", $movieID);

    foreach($response2 as $attribute2){
?> 

<div class="container">
<form method="POST">
<div class="card" style="width: 40vw;">  
<div class="card-body">
<h5 class="card-title">User: <?php echo $attribute2->username;?></h5>  
<h3 class="card-subtitle mb-2 text-muted">Rating: <?php echo $attribute2->reviewRating;?></h3>
<h3 class="text-info">Review: <?php echo $attribute2->reviewText;?></h3>  

</div>
</div>
</form> 
</div> 
    <?php } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
