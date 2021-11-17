<?php   
    session_start();
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])) // Destroying All Sessions
    {
        session_destroy();
        header("Location: login.php"); // Redirecting To Home Page
    }
    else{
        header("Location: login.php");
    }
?>