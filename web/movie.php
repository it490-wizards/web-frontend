<?php

$session_token = $_COOKIE["session_token"];
require_once "../include/rpc_client.php";

$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);

?>

<!doctype html>
<html lang="en">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Movie Page</title>
</head>

<body>
	<nav class="navbar navbar-light bg-light navbar-expand-lg sticky">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">Cinema5D</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://forum.localhost">Forum</a>               
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br></br>
  <h6 style="margin-left:20px">All Reviews</h6>
  <?php
     $movieID=$_GET["movieID"]; //gets from URL
     $response1=$db_client->call("getMovie",$movieID);
     $responseReadable1=json_decode($response1);

     foreach($responseReadable1 as $attribute1){
  ?> 
<h5 class="text-info"><?php echo $attribute1->title;?></h5>
<h5 class="text-info"><?php echo $attribute1->description;?></h5>
<?php } ?>
  <div class="container" style="height:90vh;">
  <?php
    $response2=$db_client->call("getAllReviews",$userID, $movieID);
    $responseReadable2=json_decode($response2);

    foreach($responseReadable2 as $attribute2){
  ?> 
    <div class="col-md-4">  
      <form method="POST">
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                <h5 class="text-info"><?php echo $attribute2->username; ?></h5>  
                <h3 class="text-info">$ <?php echo $attribute2->reviewRating; ?></h3> 
                <h3 class="text-info">$ <?php echo $attribute2->reviewText; ?></h3>  
            </div> 
        </form> 
    </div> 
    <?php } ?> 
  </div>
  <div class="container-fluid">
		<h3>Reviews</h3>
		<label for="Sortby"> Sort By:</label>>
		<select class="form-select" id="Sortby" name="Sortby"aria-label="Default select example">
		  <option value="1">Top rated</option>
		  <option value="2" selected>Most Recent</option>
		  <option value="3">Highest First</option>
			<option value="4">Lowest First</option>
		</select>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>
