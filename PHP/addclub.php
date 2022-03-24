<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logintestrole.php");
   exit; 
}
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin"){
    header("location: logout.php");
}

require_once "dbconnection.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dir = "Uploads/";
    $filename = $dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $file_type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if(file_exists($filename)){
        echo "Hey admin this file already exists";
        $uploadOk = 0;
    }
    if($uploadOk = 0){
        echo "Sorry admin file was not uploaded.";
    }
    else{
        if(move_uploaded_file($_FILES["picture"]["tmp_name"], $filename)){
            if(isset($_POST["clubname"])) $club = $_POST["clubname"];
            if(isset($_POST["location"])) $location = $_POST["location"];
            if(isset($_POST["category"])) $category = $_POST["category"];
            $picture = $filename;

            $sql = "INSERT INTO clubs (clubname, Location, Category, picture) VALUES ('$club', '$location', '$category', '$picture')";
            $result = $pdo->exec($sql);

            header("location: testhome.php");
        
        }
        else{
            echo "Sorry could not upload";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #6f2232;">

        <a class="navbar-brand" href="#">PartyAberdeen</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navs">
            <div class="navbar-nav">
            <a href="testhome.php" class="nav-item nav-link">Home</a>
                <a href="fileupload.php" class="nav-item nav-link">Post</a>
                <a href="login.php" class="nav-item nav-link">Login</a>
                <a href="logout.php" class="nav-item nav-link">Signout</a>

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
                    <button class="bg-secondary">Add Club</button>
                </div>
            </div>
        </form>
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

</html>