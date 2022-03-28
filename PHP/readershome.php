<?php 
 session_start();
  /*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    chose to allow all users access this page even if not logged in.
    
    exit;
   }*/
   //invoke the connection file.
   require_once "dbconnection.php";
   try{
     //retrieve everything from the post table.
       $sql = "SELECT * FROM posts";
       $stmt = $pdo ->prepare($sql);
       $stmt->execute();
       $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
       //count the retrieved items.
       $count = count($stories);

       //$pdo = null;
   }
   catch(PDOException $e){
       echo $e->getMessage();
   }
?>

<?php
require_once "dbconnection.php";
try{
    //retrieve everything from the clubs table.
    $query = "SELECT * FROM clubs";
    $stmt = $pdo ->prepare($query);
    $stmt->execute();
    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($clubs);

    $pdo = null;
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<!--All images used for the clubs and some stories were gotten free from https://unsplash.com/-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party</title>
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
                 <!--This makes the navigation bar change based on the role and is not hardcoded-->
              <?php
                include('navs.php');
              ?>

            </div>
            <form class="d-flex ml-auto" action="search.php" method="post">
                <input class="form-control me-2" type="search" placeholder="Search stories" aria-label="Search" name="category">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <h3>Logged in as <?php echo htmlspecialchars($_SESSION["role"]); ?></h3>
    <h1 class="text-center mt-5">Party in Aberdeen</h1>
    <div class="container mt-5">
        <div class="row justify-content-between">
            <!--This code below makes the page dynamic and retrieves users posts from the database and displays them on the website.-->
            <!--it also create a loop and display all retrieved clubs and displays them according to the style below. -->
        <?php
            foreach($clubs as $club){?>
            
            <div class="col-4 col-md-4 col-sm-12" style="width: 18rem;">
                <img style="height: 400px;" src="<?php echo $club["picture"]?>"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Club Name: <?php echo $club["clubname"]; ?></h5>
                    <p class="card-text">Club Location: <?php echo $club["Location"]; ?></p>
                    <p class="card-text">Club Category: <?php echo $club["Category"]; ?></p>
                    <a href="https://www.atikclub.co.uk/club/aberdeen/" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <?php }?>
              <!--Prior to the page being dynamic, the code below shows the hardcoded pictures-->
        <!--Left them here for your reference-->
           
           <!-- <div class="col-3.5 col-md-3 col-sm-12" style="width: 18rem;">
                <img src="https://images.unsplash.com/photo-1602618135005-165bc6b7e847?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8Y2x1YnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                    class=" card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="fileupload.html" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class=" col-3.5 col-md-3 col-sm-12" style="width: 18rem;">
                <img src="https://images.unsplash.com/photo-1569924995012-c4c706bfcd51?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8bmlnaHRjbHVifGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=400&q=60"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            -->
        </div>
        
        <h1 class="mt-5 text-center">View Stories</h1>
        <div class="row mt-5">
            <!--This code below makes the page dynamic and retrieves users posts from the database and displays them on the website.-->
            <!--it also create a loop and display all retrieved stories and displays them according to the style below. -->
         <?php
            foreach($stories as $story){?>

            
            <div class=" col-md-3" style="width: 18rem;">
                <img style="height: 150px;" src="<?php echo $story["picture"]?>"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Club Name: <?php echo $story["club"]; ?></h5>
                    <p class="card-text" style="height: 70px;">Caption: <?php echo $story["caption"]; ?></p>
                    <p class="card-text" style="height: 70px;">Location: <?php echo $story["location"]; ?></p>
                    <p class="card-text" style="height: 40px;">Author: <?php echo $story["author"]; ?></p> <!--I made the authors of the post anonymous as a lot of people club and they want to keep it confidential-->

                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <?php } ?>
            <!--
            <div class=" col-md-3" style="width: 18rem;">
                <img src="https://images.unsplash.com/photo-1642878289692-0317bbaf50ed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8Y2x1YiUyMHBlb3BsZXxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=400&q=60"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="col-md-3" style="width: 18rem;">
                <img src="https://images.unsplash.com/photo-1642878289657-b31f7ba11227?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fGNsdWIlMjBwZW9wbGV8ZW58MHx8MHx8&auto=format&fit=crop&w=400&q=60"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="col-md-3" style="width: 18rem;">
                <img src="https://images.unsplash.com/photo-1526654583006-5a084e2f004b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTQ0fHxjbHViJTIwcGVvcGxlfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=400&q=60"
                    class="card-img-top img-thumbnail img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>-->

    </div>
</div>

        <!--I claim no ownership to the code below, and they are part of the open source bootstrap library for additional functionality-->
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