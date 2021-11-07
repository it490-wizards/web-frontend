<?php 

session_start();
require_once "db-login.php"; //$connect = mysqli_connect("localhost", "root", "", "test");  

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

  if(isset($_POST["checkbox"])&&($_POST["checkbox"])=="Yes"){
    $checked="Yes";
    if(!isset($_POST["btnradio"]) && ((!isset($_POST["reviewText"]) || ($_POST["reviewText"])==""))){

      $dbStmt1=$database1->prepare("INSERT INTO inventoryTable (userID, movieID) 
	    VALUES (:userID, :movieID);"); //reviewID would be PK autoincrement

	    $r1 = $stmt1 -> execute ([
		  ":userID"=>$userID,
		  ":movieID"=>$movieID
	  ]);
          
    }

  }else{
    $checked="No";
  }
		
	$dbStmt=$database->prepare("
  INSERT INTO Reviews (userID, movieID, 
  reviewRating, reviewText) 
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <title>Home</title>
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
            <a class="nav-link active" aria-current="page" href="home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="profile.html">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="talk about whatever">Forums</a>
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
    $query = $mysql->prepare("
        SELECT Users.userID, movieID, title, description 
        FROM Movies, Users, Form 
        WHERE Users.userID = :userID AND Form.userID = Users.userID
        AND ((Form.genre = Movies.genre AND Form.duration = Movies.duration) OR
        (Form.genre = Movies.genre AND Form.era = Movies.era) OR
        (Form.duration = Movies.duration AND Form.era = Movies.era))
        GROUP BY Movies.movieID;"); //modify based on # of attributes 
    $r=$query->execute([":userID"=>$userID]);

    if ($r){
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
    ?> 
    <div class="col-md-4">
                          <!--action="movie.php?id= ?php echo $row["movieID"]; ?  -->
        <form method="post">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                <img src="<?php echo $row["imageLink"]; ?>" class="img-responsive" /><br />  
                <h4 class="text-info"><?php echo $row["title"]; ?></h4>  
                <h4 class="text-info">$ <?php echo $row["description"]; ?></h4>  
                <label for="flexCheckChecked">Save to Your Watch/Review Later Library?</label>
                <input type="checkbox" name = "checkbox" value="Yes" id="flexCheckChecked" />
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
                <input type="submit" name="submit" style="margin-top:5px;" class="btn btn-success" value="Submit" />  
            </div>  
        </form>  
    </div> 
    <?php
        }
    }
    ?> 

    <nav aria-label="Page navigation example">
					<div class = "text-center">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
					
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
						<li class="page-item"><a class="page-link" href="#">5</a></li>


						<li class="page-item">
							<a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
				</nav>
</div>			
</body>
</html>