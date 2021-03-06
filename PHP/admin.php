<?php
//The HTML in this code is almost irrelevant except for styling purpose
//Start session and validate if the user is logged in and has access to this page based on their role.
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
   exit; 
}
if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
    header("location: logout.php");
}
?>
<!--Bootstrap was used mostly to style this application-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     
        <link rel="stylesheet" href="../CSS/Party.css">
    <link rel="stylesheet" href="../CSS/signup.css">

</head>
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
            <form class="d-flex ml-auto">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </nav> 


    <H1 class="text-center">USERS TABLE</H1>

   
 <?php
 //invoke database connection file. 
 require_once "dbconnection.php";

 try{
     //retrieve everything from the users table
 $sql = "SELECT * FROM users";
 $result = $pdo->query($sql);
  if($result->rowCount() >0){
      //Display the results in a tabular form
     echo "<table>";
        echo "<tr>";
           echo "<th>id</th>";
           echo "<th>username</th>";
           echo "<th>password</th>";
           echo "<th>email</th>";
           echo "<th>phone</th>";
           echo "<th>role</th>";
           echo "<th>created_at</th>";
        echo "</tr>" ;
        //Fetch all the values in the rows
      while($row = $result->fetch()){
          //retrieve the values in the rows and display them.
         echo "<tr>";
             echo"<td>" . $row['id'] . "</td>";
             echo"<td>" . $row['username'] . "</td>";
             echo"<td>" . $row['password'] . "</td>";
             echo"<td>" . $row['email'] . "</td>";
             echo"<td>" . $row['phone'] . "</td>";
             echo"<td>" . $row['role'] . "</td>";
             echo"<td>" . $row['created_at'] . "</td>";

         echo"</tr>";
        }
     echo"</table>";

      unset($result);
    }
    else{
        echo "Something happened buddy sorry!";
    }
 }catch(PDOException $e){
    die("ERROR: could not execute $sql." .$e->getMessage());
 }


 ?>
 <!--The below code does the same thing as the above just for a different table.-->

 <h1 class="text-center">Posts Table</h1>

 <?php
 require_once "dbconnection.php";

 try{
 $sql = "SELECT * FROM posts";
 $result = $pdo->query($sql);
  if($result->rowCount() >0){
     echo "<table>";
        echo "<tr>";
           echo "<th>Club</th>";
           echo "<th>Location</th>";
           echo "<th>Caption</th>";
           echo "<th>Category</th>";
           echo "<th>Picture</th>";
           echo "<th>created_at</th>";
        echo "</tr>" ;
      while($row = $result->fetch()){
         echo "<tr>";
             echo"<td>" . $row['club'] . "</td>";
             echo"<td>" . $row['location'] . "</td>";
             echo"<td>" . $row['caption'] . "</td>";
             echo"<td>" . $row['category'] . "</td>";
             echo"<td>" . $row['picture'] . "</td>";
             echo"<td>" . $row['created_at'] . "</td>";

         echo"</tr>";
        }
     echo"</table>";

      unset($result);
    }
    else{
        echo "Something happened buddy sorry!";
    }
 }catch(PDOException $e){
    die("ERROR: could not execute $sql." .$e->getMessage());
 }


 ?>



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
</html>