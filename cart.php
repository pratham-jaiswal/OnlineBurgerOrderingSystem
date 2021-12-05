<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}
if($_SESSION["admin"]=='YES'){
    header("location: sales.php");
    exit();
}
require_once "config.php";
if(isset($_SESSION['cartItemN'])){
    $cartItemN = $_SESSION["cartItemN"];
    $cartItemQ = $_SESSION["cartItemQ"];
    $cartItemP = $_SESSION["cartItemP"];
    $addr = $_SESSION["addr"];
}
$fl = "Yes";
if(empty($cartItemN)){
    $cartItemN[] = "";
    $cartItemP[] = "";
    $cartItemQ[] = "";
    $fl = "No";
    $addr = "";
}
$tax = $netAmount = "";
if(isset($_SESSION["tax"])){
    $netAmount = $_SESSION["netAmount"];
    $tax = $_SESSION["tax"];

}
if($_SERVER['REQUEST_METHOD']=="POST"){
    header("location: payment.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Burger Ordering System</title>
    <link rel="icon" href="Assets/logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="nav-container">
        <ul>
            <ul>
                <li class="brand"><img src="Assets/logo.png" alt="Music">Burger Mania</li>
            </ul>
            <ul class="right-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a id="active" href="cart.php">Cart</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="cart-details">
                <?php $i=0;
                        foreach($cartItemN as $cn){?>
                            <div class="cart-items">
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Name</li>
                                        <?php } ?>
                                        <li><?php echo $cn;?></li>
                                    </ul>
                                </div>
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Quantity</li>
                                        <?php } ?>
                                        <li><?php echo $cartItemQ[$i];?></li>
                                    </ul>
                                </div>
                                <div>
                                    <ul>
                                        <?php if($i==0){?>
                                            <li style="font-weight: bold;">Price (&#x20B9;)</li>
                                        <?php } ?>
                                        <li><?php echo $cartItemP[$i]; $i++;?></li>
                                    </ul>
                                </div>
                            </div>
                <?php }?>
                <br><br>
                <div style="margin-left: 78.5%">
                    <span style="font-weight: bold;">Tax: </span><?php echo $tax;?><br>
                    <span style="font-weight: bold;">Net Amount: </span><?php echo $netAmount;?>
                </div>
                <div style="margin: 5% 11.5%">Deliver to: <?php echo $addr;?></div>
                <?php if ($fl == "Yes"){?>
                    <div class="checkout">
                        <button name="topay" type="submit">Proceed to Checkout</button>
                    </div>
                <?php }?>
            </section>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>