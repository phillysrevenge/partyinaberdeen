<?php
   //The code below displays the navigation bars based on roles. Idea gotten from a Stackoverflow post.
   //I implemented it just using if statments and elseifs.


//if user is logged in, check their role and display nav menu based on that.
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["role"] == "admin"){
        echo "<a href=\"admin.php\" class=\"nav-item nav-link\">Admin</a>
        <a href=\"addclub.php\" class=\"nav-item nav-link\">Add club</a>
        <a href=\"home.php\" class=\"nav-item nav-link\">Home</a>
         <a href=\"logout.php\" class=\"nav-item nav-link\">Signout</a>
         <a href=\"fileupload.php\" class=\"nav-item nav-link\">Post</a>
         <a href=\"password.php\" class=\"nav-item nav-link\">Change Password</a>";
            
    }
    elseif($_SESSION["role"] == "storyteller"){
        echo "
        <a href=\"home.php\" class=\"nav-item nav-link\">Home</a>
        <a href=\"logout.php\" class=\"nav-item nav-link\">Signout</a>
        <a href=\"fileupload.php\" class=\"nav-item nav-link\">Post</a>
        <a href=\"password.php\" class=\"nav-item nav-link\">Change Password</a>";
    }
    elseif($_SESSION["role"] == "reader"){
        echo "
        <a href=\"readershome.php\" class=\"nav-item nav-link\">Home</a>
        <a href=\"logout.php\" class=\"nav-item nav-link\">Signout</a>
        <a href=\"password.php\" class=\"nav-item nav-link\">Change Password</a>";
        

    }
    //if user is not loggedin, just display this.
}else{
    echo "
         <a href=\"login.php\" class=\"nav-item nav-link\">Login</a>
         <a href=\"fileupload.php\" class=\"nav-item nav-link\">About</a>
         <a href=\"password.php\" class=\"nav-item nav-link\">Change Password</a>";}


?>