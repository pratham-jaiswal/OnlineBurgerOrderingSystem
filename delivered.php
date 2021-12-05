<?php
require_once "config.php";
session_start();
if (isset($_GET['order_id'])){
    echo 11;
    $sql = 'UPDATE orders SET details = "Delivered" WHERE order_id ='.$_GET["order_id"];
    mysqli_query($conn, $sql);
    header("location: sales.php");
    exit();
}
?>