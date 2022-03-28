<?php
//start session
session_start();

$_SESSION = array();

//now we take our hammer and destroy the session haha!
session_destroy();

//now that there is no more session, it's holiday time.
// Redirct to login page if you want a new session
header("location: index.php");
exit;

?>