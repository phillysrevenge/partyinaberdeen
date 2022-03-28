<?php
//I include the database connection file.
require_once "dbconnection.php";

//I'll define the variables as initial values first.
$username = $email = $password = $phone = $role = "";
$usernameerror = $emailerror = $passworderror = $phoneerror = $roleerror = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //I'll validate the username field first
    if(empty(trim($_POST["username"]))){
        $usernameerror = "Kindly enter a password";
    }
    //Input an extra feature to protect against SQL injection or XSS attacks
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $usernameerror = "You have tried to input a dangerous character! change it.";
    }
    else{
        //i'll now create an SQL statement to check if the username exists in DB
        $sql = "SELECT id FROM users WHERE username = :username or email = :email";
        if($stmt = $pdo->prepare($sql)){
            //the variables :username and :email won't get values from the air haha so
            //I'll give them parameters.
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            //Now the queestion is, what is $param_username or $param_email?
            //I'll assign them the value entered in the form!
            $param_username = trim($_POST["username"]);
            $param_email = trim($_POST["email"]);
            //Execute the statement (stmt) above
            if($stmt->execute()){
                //check if the username exist. I can use >0 or ==1
                if($stmt->rowcount() == 1){
                 $usernameerror = "Hey this username already exists. Try another!";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "Sorry Buddy something went wrong. Take a breath and try again.";

            }
            //I can close the statement
            unset($stmt);
        }
    }

    //Of course i'll Validate the password also, this is not DVWA website haha!
    if(empty(trim($_POST["password"]))){
        $passworderror = "Kindly enter a password aight?";
    }
    //if it was not empty, i'll validate the length too for additional security
    elseif(strlen(trim($_POST["password"])) <8){
        $passworderror = "Hey buddy password is too short you can be hacked";
    }
    else{
        $password = trim($_POST["password"]);
    }
    //check email and phone to ensure it's not empty
    if(empty(trim($_POST["email"]))){
        $emailerror = "Hey buddy enter an email address";
    }
    else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["phone"]))){
        $phoneerror = "Hey buddy enter a phone number";
    }
    else{
        $phone = trim($_POST["phone"]);
    }
    if(empty(trim($_POST["role"]))){
        $roleerror = "Hey buddy select a role please";
    }
    else{
        $role = trim($_POST["role"]);
    }
    //Now i verify that there is no error hiding somewhere before i insert in my database
    if(empty($usernameerror) && empty($emailerror) && empty($passworderror) && empty($phoneerror) && empty($roleerror)){
      //the fun part!!
      $sql = "INSERT INTO users (username, password, email, phone, role) VALUES (:username, :password, :email, :phone, :role)";  
      if($stmt = $pdo->prepare($sql)){
         //as i did above when verifying the email, i'll have to give the :username, :password, etc.. values
         $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
         $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
         $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
         $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
         $stmt->bindParam(":role", $param_role, PDO::PARAM_STR);

         //give the param_.. the values from the form
         //recall above i already gave the $username variable the values trimmed from the form?
         $param_username = $username;
         $param_password = password_hash($password, PASSWORD_DEFAULT); //This code will encrypt the pasword using PHP default hashing.
         //This means even if someone does an sql injection attack i'm still safe a little!
         $param_email = $email;
         $param_phone = $phone;
         $param_role = $role;
         //i can execute my statement in peace now
         if($stmt->execute()){
             //Take the tourist to the login page to input his/her credentials!
             header("location: login.php");
            }
         else{
             echo " Hey buddy, take a breath and try again.";
            }
            //i'll close the statement now
            unset($stmt);
        }
    
    }
    //i'll close the pdo/connection
    unset($pdo);


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
              <a href="index.php" class="nav-item nav-link">Home</a>
              <a href="login.php" class="nav-item nav-link">Login</a>
                

            </div>
        </div>
    </nav>

    <main class="container mt-5 cont">
        <div class="form-header text-center mt-3">
            <h1 class="text-center">Create a New Account</h1>
            <p>Join our Comunity and enjoy partying in Aberdeen! Already have one? <a href="login.php">Signin</a></p>
        </div>
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row" method="post">
            <div class="col-md-6 col-sm-6">
                <div class="form-group mt-5">

                    <input type="text" name="username" class="form-control <?php echo(!empty($usernameerror)) ? 'is-invalid' : ''; ?>" placeholder="Username" value= "<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $usernameerror; ?></span>
                </div>
                <div class="form-group mt-5">

                    <input type="email" name="email"  class="form-control <?php echo(!empty($emailerror)) ? 'is-invalid' : ''; ?>" value= "<?php echo $email; ?>" placeholder="Email">
                    <span class="invalid-feedback"><?php echo $emailerror; ?></span>
                </div>
                <div class="form-group mt-5">

                    <input type="password" name="password" class="form-control <?php echo(!empty($passworderror)) ? 'is-invalid' : ''; ?>" value= "<?php echo $password; ?>" placeholder="Password">
                    <span class="invalid-feedback"><?php echo $passworderror; ?></span>
                </div>
                
                <div class="form-group mt-5">

                    <input type="text" name="phone" class="form-control <?php echo(!empty($phoneerror)) ? 'is-invalid' : ''; ?>" value= "<?php echo $phone; ?>" placeholder="Phone Number">
                    <span class="invalid-feedback"><?php echo $phoneerror; ?></span>
                </div>
                <div class="form-group mt-5">
                    <label for="Role">Select a Role</label>
                    <select name="role" id="Role" class="form-control <?php echo(!empty($roleerror)) ? 'is-invalid' : ''; ?>" value= "<?php echo $role; ?>">
                      <option value="admin">--Select a role--</option>
                     <!-- <option value="admin">Admin</option> -->
                     <option value="storyteller">Story Teller</option>
                     <option value="reader">Reader</option>
                    </select>
                   <span class="invalid-feedback"><?php echo $roleerror; ?></span>

                </div>
                <div class="mt-5">
                    <input type="checkbox" name="" id=""> I agree with the Terms of Use.
                </div>
                <div class="mt-5 mb-3">
                 <input type="submit" class="btn btn-primary" value="Submit">
                </div>
           </div>
 
            <div class="col-md-6 col-sm-6">
                <img src="https://images.unsplash.com/photo-1541532713592-79a0317b6b77?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8cGFydHl8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="img-fluid img-thumbnail">
            </div>
        </form>
           
   
        
    </main>
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