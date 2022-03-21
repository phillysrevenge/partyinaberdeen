<?php
//Start the session
session_start();

//confirm the user is logged in, if not send him to the login page.

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logintestrole.php");
    exit;
}

//include our database connection file

require_once "dbconnection.php";

//define the variables with empty values initially

$email = $newpassword =$confirmpassword = "";
$emailerror = $newpassworderror = $confirmpassworderror = ""; 

//now we process the form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // first validate the email field
    if(empty(trim($_POST["email"]))){
       $emailerror = "Please enter a valid email address.";
    }
    else{
        $email = trim($_POST["email"]);
    }

    //validate the password field also.
    if(empty(trim($_POST["newpassword"]))){
        $newpassworderror = "Please enter a password";
    }
    else{
        $newpassword = trim($_POST["newpassword"]);
    }

    //validate the confirmpassword field also
    if(empty(trim($_POST["confirmpassword"]))){
        $confirmpassworderror = "Please confirm the password entered above.";
    }
    else{
        $confirmpassword = trim($_POST["confirmpassword"]);
        if(empty($newpassworderror) && ($newpassword != $confirmpassword)){
            $confirmpassworderror = "The passwords did not match.";
        }
    }

    //ensure there is no input error before sending to the database
    if(empty($emailerror) && empty($newpassworderror) && empty($confirmpassworderror)){
        //prepare the sql statement to update the password in the database
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        if($stmt =$pdo->prepare($sql)){
            //Bind the variables :password and :id to something called parampassword and paramid
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            //after binding them, now we set the password to be hashed using php's default algorithm
            $param_password = password_hash($newpassword, PASSWORD_DEFAULT);
            //set the parameter for id too using the session id since the user is already loggedin
            $param_id = $_SESSION["id"];

            //execute the statement
            if($stmt->execute()){
                //the password has been updated successfully so we can destroy the session
                session_destroy();
                //after destroying the session, redirect the user to the login page
                header("location: login.php");
                exit();
            }
            else{
                echo "Sorry buddy something went wrong. Try again after a cup of tea.";
            }
            //now we can close the statement
            unset($stmt);
        }
    }

    //close the connection
    unset($pdo);


}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="../CSS/Party.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #6f2232;">

        <a class="navbar-brand" href="#">PartyAberdeen</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navs">
            <div class="navbar-nav">
                <a href="homenormal.php" class="nav-item nav-link">Home</a>
                <a href="fileupload.php" class="nav-item nav-link">Post</a>
                <a href="login.php" class="nav-item nav-link">Login</a>
                <a href="logout.php" class="nav-item nav-link">Signout</a>

            </div>
        </div>
    </nav>
    <main class="container center">
        <div class="">
            <h2 class="text-center">Reset your password</h2>
        </div>
        <div class="mt-5">
            <h5>Please fill the form below to recover your password.</h3>
        </div>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-5" method="post">
                <div class="">
                    <div>
                    <input type="email" name="email" placeholder="Email" class="form-control col-md-8 <?php echo (!empty($emailerror)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $emailerror; ?></span>
                </div>
                    <div>
                    <input type="password" name="newpassword" placeholder="Password" class="form-control col-md-8 mt-5 <?php echo (!empty($newpassworderror)) ? 'is-invalid' : ''; ?>" value="<?php echo $newpassword; ?>">
                    <span class="invalid-feedback"><?php echo $newpassworderror; ?></span>
                </div>
                    <div>
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control col-md-8 mt-5 <?php echo (!empty($confirmpassworderror)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmpassword; ?>">
                    <span class="invalid-feedback"><?php echo $confirmpassworderror; ?></span>
                </div>
                    <input type="submit" class="btn btn-lg bg-secondary" value="Reset">
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="socialmedia">
            <ul class="icons">

                <l1><a href=""><img src="../images.png" alt="" class="icons"></a></l1>


            </ul>
            <p class="text-center">ClubAberdeen 2022</p>

        </div>
    </footer>

    <!--I will like to clearly state that the links below are javascript codes from bootstrap official site and are included as advised on getbootstrap.com. I claim no ownership-->
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