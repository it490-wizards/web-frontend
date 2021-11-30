<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Global Rankings</title>
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

 <!-- RANKINGS -->

  <?php
     $responseA=$db_client->call("getRankings");
     foreach($responseA as $attributeA){
  ?> 

<div class = "container">
  <form method="POST">
    <div class="card" style="width: 40vw;">  
    <div class="card-body">
    <h4 class="card-title"><?php echo $attributeA->username; ?></h4>
    <h3 class="text-info"><?php 
      $countFollowers=(int)$attributeA->followers;
      if($countFollowers <= 3){
        $memberType="Bronze";
      }elseif($countFollowers > 3 && $countFollowers <= 5){
        $memberType="Silver";
      }else{
        $memberType="Gold";
      }
      echo $memberType;
      ?> Member: <?php echo $attributeA->followers;?> Followers 
      <?php 
      if ($memberType="Bronze"){
        echo "\r\n User needs " . 4-$countFollowers . " follower(s) to get to Silver and " . 6-$countFollowers . " to get to Gold!\r\n";
      }elseif($memberType="Silver"){
        echo "User needs " . 6-$countFollowers . " follower(s) to get to Gold!";
      }
      ?></h3>
    <a type="button" href="userProfile.php?user_id=<?php echo $attributeA->userID;?>"style="margin-top:5px;" class="btn btn-success">Go to user's page!</a>  
    </div> 
</div>
</form>   
</div>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>