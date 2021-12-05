<?php
    session_start();
    $cartItemN = $cartItemQ = $cartItemP = arraY();
    session_unset();
    session_destroy();
    header("location: index.php");
?>