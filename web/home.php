<?php 

$session_token = $_COOKIE["session_token"] ?? null;
require_once __DIR__ . "/../include/rpc_client.php";
$db_client = new DatabaseRpcCLient();
$userID=$db_client->call("session_to_userid", $session_token);
if ($userID===0){
  http_response_code(403);
  die();
}


//$userID=19;
if(isset($_POST["submit"])){ 

  $movieID = (int)$_POST["hidden_movieID"];
  $reviewText=$_POST["reviewText"];

  if(isset($_POST["btnradio"])){
      switch($_POST["btnradio"]){
        case "1":
          $reviewRating=1;
          break;
        case "2":
          $reviewRating=2;
          break;
        case "3":
          $reviewRating=3;
          break;
        case "4":
          $reviewRating=4;
          break;
        case "5":
          $reviewRating=5;
          break;
      }
  }  
  if(isset($_POST["checkbox"])&&($_POST["checkbox"])=="Yes"){
    //if(!isset($_POST["btnradio"]) && ((!isset($_POST["reviewText"]) || ($_POST["reviewText"])==""))){
      $response=$db_client->call("addSaved",$userID,$movieID);

    //}
  }
  else{
    $response=$db_client->call("addReview",$movieID, $userID,$reviewRating,$reviewText);
  }

}
?>	
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Home</title>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">Cinema5D</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home   </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="profile.php">Profile   </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forum">Forum</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br></br>
  <h3 style="margin-left:20px">Recommended Movies!</h3>
  <hr></hr>
  <div class="container" style="width:700px;">  

    <?php
    $response1=$db_client->call("getRecommended",$userID);  
    foreach($response1 as $attribute){
    ?> 
    <div class = "container">
          <form action="home.php" method="post">  

            <div class="card" style="width: 40vw;">
          <div class="card-body">
          <h4 class="card-title"><?php echo $attribute->title; ?></h4>  
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $attribute->description; ?></h6>
          <label for="flexCheckChecked">Save to Your Watch/Review Later Library?</label>
                <input type="checkbox" name = "checkbox" value="Yes" id="flexCheckChecked" />
                <h4>Rate This Movie!</h4>

                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Rating</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01">
    <option selected>Choose...</option>
    <option value="1">⭐</option>
    <option value="2">⭐⭐</option>
    <option value="3">⭐⭐⭐</option>
    <option value="4">⭐⭐⭐⭐</option>
    <option value="5">⭐⭐⭐⭐⭐</option>
  </select>
</div>
                  
                <textarea class="form-control" name="reviewText" id="reviewText" aria-label="With textarea" rows="4" cols="50">
                Write your review...
                </textarea>
                <input type="hidden" name="hidden_title" value="<?php echo $attribute->title; ?>" />  
                <input type="hidden" name="hidden_description" value="<?php echo $attribute->description; ?>" />
                <input type="hidden" name="hidden_movieID" value="<?php echo $attribute->movie_id; ?>" />  
                <input type="submit" name="submit" style="margin-top:5px;" class="btn btn-success" value="Submit" />  
  </div>
</div>
        </form>  

    </div> 
    <?php
    } 
    ?> 

</div>			
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>