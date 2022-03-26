<?php


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["role"] == "admin"){
        echo "<a href=\"admin.php\" class=\"nav-item nav-link\">Admin</a>
        <a href=\"addclub.php\" class=\"nav-item nav-link\">Add club</a>
        <a href=\"testhome.php\" class=\"nav-item nav-link\">Home</a>
         <a href=\"logout.php\" class=\"nav-item nav-link\">Signout</a>
         <a href=\"fileupload.php\" class=\"nav-item nav-link\">Post</a>
         <a href=\"password.php\" class=\"nav-item nav-link\">Change Password</a>";
            
    }
    elseif($_SESSION["role"] == "storyteller"){
        echo "
        <a href=\"testhome.php\" class=\"nav-item nav-link\">Home</a>
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
}/*else{
    echo "
         <a href="logintestrole.php" class="nav-item nav-link">Login</a>
         <a href="fileupload.php" class="nav-item nav-link">About</a>
         <a href="password.php" class="nav-item nav-link">Change Password</a>";}*/


?>