<?php
session_start();
require_once "config.php";
if(isset($_SESSION['payment'])){
    $_SESSION["payment"] = NULL;
    header( "refresh:5; url=index.php");
}
else{
    header("location: index.php");
}
?>

<html>
    <head>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Online Burger Ordering System</title>
            <link rel="icon" href="Assets/logo.png">
            <link rel="stylesheet" href="style.css">
        </head>
    </head>
    <body style="text-align: center;">
        <div class="container" style="margin-top: 25vh;">
            <div class="card" >
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                    <i class="checkmark">✓</i>
                </div>
                <h1>Success</h1>
                <p>We've received your order and payment!<br><br>Please don't close or move out<br>from this page.</p>
            </div>
        </div>
    </body>
</html>