<?php
 //start the session
 session_start();
 //check if the user is logged in
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Homepage.php");
    exit;
 }
 //include the database connection file
 require_once "dbconnection.php";

 //set the variables as empty initially.
 $email = $password = $role =  "";
 $emailerror = $passworderror = $loginerror = $roleerror = "";
 //check if the method is post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //verify email field
    if(empty(trim($_POST["email"]))){
        $emailerror = "Hey buddy, enter an email please.";
    }
    else{
        $email = trim($_POST["email"]);
    }
    //verify password field
    if(empty(trim($_POST["password"]))){
        $passworderror = "Hey buddy, enter a password.";
    }
    else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["role"]))){
        $roleerror = "Please select a role buddy";
    }

    //verify no errors in the form before querying DB

    if(empty($emailerror) && empty($passworderror) && empty($roleerror)){
        //if no errors, check the database for th user based on the password wntered
        $sql = "SELECT id, email, password, role FROM users WHERE email = :email AND role = :role";
        if($stmt = $pdo->prepare($sql)){
            //I will attach the value :email to a parameter
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":role", $param_role, PDO::PARAM_STR);
            //I will set the parameter below
            $param_email = trim($_POST["email"]);
            $param_role = trim($_POST["role"]);
            //since i have all the parameters, i'll execute the statement.
            if($stmt->execute()){
                echo "prepare sql";
                if($stmt->rowCount() == 1){
                    echo "found user";
                    if($row = $stmt->fetch()){
                        //retrieve the details from the row in the DB
                        $id = $row["id"];
                        $email = $row["email"];
                        $role = $row["role"];
                        $hashed_password = $row["password"];

                        if(password_verify($password, $hashed_password)){
                            //the above code compares the password entered with the hashed one in DB
                            //if it's the same, store it in a session.
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;
                            //redirect the user to the homepage.
                            switch($role){
                                case "admin":
                                header("location: Homepage.php");
                                break;

                                case "reader":
                                header("location: homenormal.php");

                            }
                        }
                        else{
                            $loginerror = "Invalid email or password buddy."; 
                        }
                    }
                }
                else{
                    $loginerror = "Seems like you entered wrong credentials.";
                }
            }
            else{
                echo "Seems like there's something wrong buddy. Take a breath and try again";
            }
            //now i'll close the statament
            unset($stmt);

        }
    }
    //close the connection. Phew!
    unset($pdo);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <a href="" class="nav-item nav-link">Home</a>
                <a href="" class="nav-item nav-link">Contact Us</a>
                <a href="" class="nav-item nav-link">Login</a>
                <a href="" class="nav-item nav-link">Signout</a>

            </div>
        </div>
    </nav>
    <main class="mt-5">
        <h1 class="text-center">Login using your credentials below</h1>
        <div class="container cont mt-5">
            <?php if(!empty($loginerror)){
                echo '<div class="alert alert-danger">' . $loginerror . '</div>';
            }?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="m-4">
                <div class="mt-5">
                    <input type="email" name="email" placeholder="Email" class="form-control <?php echo (!empty($emailerror)) ? 'is-invalid' : ''; ?>">
                     <span class="invalid-feedback"><?php echo $emailerror; ?> </span>
                </div>
                <div class="mt-5">
                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($passworderror)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $passworderror; ?> </span>
                </div>
                <div class="mt-5">
                 <select name="role" id="role" class="<?php echo (!empty($roleerror)) ? 'is-invalid' : ''; ?>">
                     <option value="admin">Admin</option>
                     <option value="storyteller">Story Teller</option>
                     <option value="reader">Reader</option>
                 </select>
                </div>
                <div class="mt-5">
                    <input type="submit" class="btn btn-lg bg-secondary" value="Login">
                </div>
                <p class="text-right"><a href="" class="password">Forgot Password?</a></p>
                <P class="text-center mt-5">New User? <a href="signup.php" class="password">Join Now</a></P>


        </div>
        </form>
        </div>
    </main>

    <div class="mt-5">

        <h1 class="text-center mt-5">Welcome to Nightlife in Aberdeen</h1>

    </div>

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
<footer>
    <div class="socialmedia">
        <ul class="icons text-center">

            <l1><a href=""><img src="../images.png" alt="" class="icons"></a></l1>


        </ul>
        <p>ClubAberdeen 2022</p>

    </div>
</footer>

</html>