<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="../CSS/video.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #6f2232; z-index: 80;">

    <a class="navbar-brand" href="#">PartyAberdeen</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
        <span class="navbar-toggler-icon"></span>

    </button>
    <div class="collapse navbar-collapse" id="navs">
        <div class="navbar-nav">
        <?php
                include('navs.php');
            ?>

        </div>
    </div>
</nav>
<!--As this was not in the scope of the course, i learnt how to make background a video on w3schools, and 
CSS tricks URL: https://css-tricks.com/full-page-background-video-styles/-->
<header class="video-header">
    <video src="../video/party.mp4" autoplay loop playsinline muted
        poster="https://images.unsplash.com/photo-1602618135005-165bc6b7e847?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8Y2x1YnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"></video>

    <div class="viewport-header">
        <h1>Party In <span>Aberdeen</span> </h1>

    </div>
</header>
<main>
    Hello Buddy welcome to PartyAberdeen, a story telling application capturing night life in Aberdeen Scotland. 
    Here you can find clubs, stories of peoples visit to the clubs. You can also share your stories so others can view and learn too.
    We look forward to having you on board.
</main>
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

<footer style="z-index: 100;">
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