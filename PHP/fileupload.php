<?php 
//start session and verify the user is logged in and has access to this page based on role.
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
   exit; 
   //the code above checks if the user is loggedin and if not, redirects the user to the login page.
}
if(!isset($_SESSION["role"]) || $_SESSION["role"] == "reader"){
    header("location: logout.php");
}
//The code above verifies the user role is not reader as they do not have access to this page. Logs them out if user is a reader

//Invoke the database connection file
require_once "dbconnection.php";
//The code below only executes if the form method is post.

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dir = "Uploads/";
    // the code above specifies the directory where images will be stored is uploads.
    $filename = $dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $file_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

    
    //verify file size.
    if($_FILES["picture"]["size"] > 1000000){
        echo "Hey buddy the file is too large.";
        $uploadOk = 0;
    }
    /*if($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif" && $file_type != "pdf"){
      echo "File must be a jpg, jpeg, png, pdf, or gif format";
      $uploadOk = 0;
    }*/
    
    //verify there are no errors
    if($uploadOk = 0){
        echo "Sorry Buddy file was not uploaded.";
    }
    //i noe errors, store the users input in the form in variables.
    else{
        if(move_uploaded_file($_FILES["picture"]["tmp_name"], $filename)){
            if(isset($_POST["clubname"])) $club = $_POST["clubname"];
            if(isset($_POST["location"])) $location = $_POST["location"];
            if(isset($_POST["category"])) $category = $_POST["category"];
            if(isset($_POST["caption"])) $caption = $_POST["caption"];
            if(isset($_POST["author"])) $author = $_POST["author"];
            $picture = $filename;
            //the line above retrieves the filename and assigns it to a variable.

            // Insert into database with the SQL command below.
            $sql = "INSERT INTO posts (club, location, category, caption, picture, author) VALUES ('$club', '$location', '$category', '$caption', '$picture', '$author')";
            $result = $pdo->exec($sql);

            //if successful, redirect the user to the homepage where they can see the upload. Just like how instagram does!
            header("location: home.php");
        
        }
            //if upload was not successful, echo an error
        else{
            echo "Sorry could not upload";
            exit;
        }
    }
}



?>
<!--Bootstrap was used mostly to style this application-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
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
        </div>
    </nav>
    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <h4><label for="name">Name of Club</label></h4>
                </div>
                <div class="col-md-7">
                    <input type="text" name="clubname" id="name" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <h4><label for="location">Location</label></h4>
                </div>
                <div class="col-md-7">
                    <input type="text" name="location" id="location" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <h4><label for="category">Category</label></h4>
                </div>
                <div class="col-md-7">
                    <select name="category" id="category" class="form-control">

                        <option value="">--Kindly select a category--</option>
                        <option value="African">Afrobeat Club</option>
                        <option value="British">British</option>
                        <option value="Jamaican">Reggae</option>
                        <option value="Lounge">Lounge</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <h4><label for="Upload">Upload</label></h4>
                </div>
                <div class="col-md-7">
                    <input type="file" name="picture" class="form-control">
                </div>
            </div>
            

            <div class="row mt-5">
                <div class="col-md-4">
                    <h4><label for="caption">Caption:</label></h4>
                </div>
                <div class="col-md-7">
                    <textarea name="caption" id="caption" cols="90" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <h4><label for="author">Author</label></h4>
                </div>
                <div class="col-md-7">
                    <input type="text" name="author" id="author" class="form-control">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <button class="bg-secondary">Post Story</button>
                </div>
            </div>
        </form>
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