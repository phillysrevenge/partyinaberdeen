<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logintestrole.php");
    
    
}
?>
<?php
require_once "dbconnection.php";
$name = $_POST['category'];
try{
    $sql = "SELECT * FROM posts WHERE category LIKE '%{$name}'";
    
    $stmt = $pdo ->prepare($sql);
    $stmt->execute();
    $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($stories);

   $pdo = null;
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/Party.css">
    <link rel="stylesheet" href="../CSS/signup.css">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #6f2232;">

        <a class="navbar-brand" href="#">PartyAberdeen</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navs">
            <div class="navbar-nav">
            <?php
                include('navs.php');
            ?>

            </div>
            <form class="d-flex ml-auto" action="search.php" method="post">
                <input class="form-control me-2" type="search" placeholder="Search Stories" aria-label="Search" name="category">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </nav>

<div class="container">
  <div class="row mt-5">
         <?php
            foreach($stories as $story){?>

            <div class=" col-md-6" style="width: 18rem;">
                <img style="height: 170px;" src="<?php echo $story["picture"]?>"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Club Name: <?php echo $story["club"]; ?></h5>
                    <p class="card-text" style="height: 170px;">Caption: <?php echo $story["caption"]; ?></p>
                    <p class="card-text" style="height: 50px;">Location: <?php echo $story["location"]; ?></p>
                    <p class="card-text" style="height: 40px;">Author: <?php echo $story["author"]; ?></p> <!--I made the authors of the post anonymous as a lot of people club and they want to keep it confidential-->
                    <p class="card-text" style="height: 40px;">Category: <?php echo $story["category"]; ?></p>

                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <?php } ?>
            </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
</body>
            
<footer>
    <div class="socialmedia" style="width:100%; display:flex; flex-direction:column; justify-content:center;">
    <nav class="nav nav-pills nav-justified justify-content-center">
  <a class="nav-item nav-link" href="#">Fawole</a>
  <a class="nav-item nav-link" href="#">Oluwaferanmi</a>
  <a class="nav-item nav-link" href="#">Philemon</a>
  <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">2120933</a>
</nav>
        <p class="text-center">ClubAberdeen 2022</p>

    </div>
</footer>
</html>