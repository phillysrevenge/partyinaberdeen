<?php
session_start();
//start the session
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/Party.css">
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="../CSS/index.css">
</head>
    <nav class="navbar navbar-dark navbar-expand-lg"style="color:white; margin:0px;">

    <a class="navbar-brand" href="login.php" style="z-index:300;">PartyAberdeen</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse navigation" id="navs" style="position:absolute; z-index:300; font-weight:bolder; background-color:black; padding:0;">
            <div class="navbar-nav" style="padding:0;">
                <!--This makes the navigation bar change based on the role and is not hardcoded-->
                <?php
                include('navs.php');
            ?>
        
        </div>
    </nav>
    
<body>
    <!--Knowledge of how to implement a background video was gotten from W3schools URL for transparency: https://www.w3schools.com/howto/howto_css_fullscreen_video.asp-->
    
    <video autoplay muted loop id="myVideo">
        <source src="../video/party.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="content mt-5">
        
        <h1>Party In Aberdeen!</h1>
        <p>Welcom to Aberdeen if you are new here. Aberdeen boasts of a good nightlife, you can view clubs and see stories from tourists and locals who have visited those clubs.
            Sounds great? <span ><a href="signup.php" style="colour:orange;">SIGNUP</a></span>  to see it all!
        </p>
        <button id="controlvid" onclick="myFunction()">Pause</button>
    </div>

    <!--Learnt how to implement the javascript code below from W3schools URL for transparency: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_fullscreen_video-->
    <script>
        var video = document.getElementById("myVideo");
        var btn = document.getElementById("controlvid");

        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    </script>
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