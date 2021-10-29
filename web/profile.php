<?php 
session_start();
require_once "db-login.php";//$connect = mysqli_connect("localhost", "root", "", "test");  

//$userID=function to get userID - if(isset($_GET["id"])){$id=$_GET["id"];}
$movieID = $_POST["hidden_movieID"];
$reviewText=$_POST["reviewText"];

if(isset($_POST["submit"])){ 

  if(isset($_POST["btnradio"])){
      switch($_POST["btnradio"]){
        case "1":
          $reviewRating="1";
          break;
        case "2":
          $reviewRating="2";
          break;
        case "3":
          $reviewRating="3";
          break;
        case "4":
          $reviewRating="4";
          break;
        case "5":
          $reviewRating="5";
          break;
      }
  }

  $dbStmt=$database->prepare("INSERT INTO ReviewTable (userID, movieID, reviewRating, reviewText) 
	VALUES (:userID, :movieID, :reviewRating, :reviewText);"); //reviewID would be PK autoincrement
	$r = $stmt -> execute ([
		":userID"=>$userID,
		":movieID"=>$movieID,
		":reviewRating"=>$reviewRating,
		":reviewText"=>$reviewText
	]);
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

  <title>My Profile</title>
</head>

<body>
  <nav class="navbar navbar-light bg-primary navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.html">Cinema5D</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.html">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.html">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="row">

    <div class="col-6">
      <center>

        <img style="width:20vw; height:20vw; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7jQPameD633rQUVhrvSydfTvWY5HT16mhSA&usqp=CAU"></img>
        <h3>$UserName</h3>
        <br></br>
        <a class="btn btn-info" href="form.html" role="button">Fill Out or Review Profile Form</a>
      </center>
    </div>
    <div class="col-6" style="margin-top:30px;">
      <p>
        MOVIES WATCHED - 15
      </p><br>
      <p>
        MOVIES REVIEWED - 8
      </p><br>
      <p>
        AVERAGE REVIEW - ⭐⭐⭐
      </p><br>
    </div>
  </div>
  
  <br></br>

  <h3 style="margin-left:20px">Saved Movies - Review Now!</h3>
  <hr>
  <div class="container">
  <?php
    $query = $mysql->prepare("
        SELECT Users.userID, Inventory.movieID, title, description 
        FROM Movies, Users, Inventory 
        WHERE Users.userID = :userID AND Inventory.userID = Users.userID
        AND Movies.movieID=Inventory.movieID
        GROUP BY Inventory.movieID;");//modify based on # of attributes
    $r=$query->execute([":userID"=>$userID]);

    if ($r){
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
    ?> 
    <div class="col-md-4"> <!--action="movie.php?id= ?php echo $row["movieID"]; ?  --> 
        <form method="post">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                <img src="<?php echo $row["imageLink"]; ?>" class="img-responsive" /><br />  
                <h4 class="text-info"><?php echo $row["title"]; ?></h4>  
                <h4 class="text-info">$ <?php echo $row["description"]; ?></h4>  
                <h4>Rate This Movie!</h4>
                    <div class="btn-group" style="height:3rem; padding:5px;" role="group" aria-label="Basic radio toggle button group">
                        
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio1">⭐</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio2">⭐⭐ </label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="3" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio3">⭐⭐⭐ </label>
                                        
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" value="4"autocomplete="off">					
                        <label class="btn btn-outline-primary" for="btnradio4">⭐⭐⭐⭐ </label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio5" value="5"autocomplete="off" >
                        <label class="btn btn-outline-primary" for="btnradio5">⭐⭐⭐⭐⭐ </label>
                    </div>
                <textarea class="form-control" name="reviewText" id="reviewText" aria-label="With textarea" rows="4" cols="50"
                Write your review...
                </textarea>
                <input type="hidden" name="hidden_title" value="<?php echo $row["title"]; ?>" />  
                <input type="hidden" name="hidden_description" value="<?php echo $row["description"]; ?>" />
                <input type="hidden" name="hidden_movieID" value="<?php echo $row["movieID"]; ?>" />  
                <input type="submit" name="submit" style="margin-top:5px;" class="btn btn-success" value="submit" />  
            </div>  
        </form>  
    </div> 
    <?php
        }
    }
    ?> 
  </div>
<br></br>
  <h3 style="margin-left:20px">Past Reviews</h3>
<hr>

<!-- REVIEWED MOVIES -->

<div class="container">
  <?php
    $query = $mysql->prepare("
        SELECT Users.userID, Movies.movieID, title, description, reviewRating,
        reviewText FROM Movies, Users, Reviews 
        WHERE Users.userID = :userID AND Users.userID = Reviews.userID
        AND Movies.movieID=Reviews.movieID
        GROUP BY Reviews.movieID;");//modify based on # of attributes
    $r=$query->execute([":userID"=>$userID]);

    if ($r){
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
    ?> 
    <div class="col-md-4">  
      <form method="POST">
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                <img src="<?php echo $row["imageLink"]; ?>" class="img-responsive" /><br />  
                <h4 class="text-info"><?php echo $row["title"]; ?></h4>  
                <h4 class="text-info">$ <?php echo $row["description"]; ?></h4>  
                <h4 class="text-info">$ <?php echo $row["reviewRating"]; ?></h4> 
                <h4 class="text-info">$ <?php echo $row["reviewText"]; ?></h4>  
                <input type="hidden" name="hidden_title" value="<?php echo $row["title"]; ?>" />  
                <input type="hidden" name="hidden_description" value="<?php echo $row["description"]; ?>" />
                <input type="hidden" name="hidden_movieID" value="<?php echo $row["movieID"]; ?>" />  
                <input type="submit" name="submit" href="movie.php?id=<?php echo $row["id"]?> "style="margin-top:5px;" class="btn btn-success" value="See what other people are saying!" />  
            </div> 
        </form> 
    </div> 
    <?php
        }
    }
    ?> 
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