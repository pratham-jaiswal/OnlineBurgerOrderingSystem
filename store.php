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
$vwhp = $nvwhp = $vwpj = $nvwpj = $vkng = $nvkng = 0;
//$Pvwhp = $Pnvwhp = $Pvwpj = $Pnvwpj = $Pvkng = $Pnvkng = 0;
$Pvwhp = 150;
$Pnvwhp = 180;
$Pvwpj = 100;
$Pnvwpj = 120;
$Pvkng = 180;
$Pnvkng = 200;


$cartItemN = [];
$cartItemQ = [];
$cartItemP = [];
$err = $addr = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['tocart'])){
        $vwhp = $_POST['vwhp'];
        $nvwhp = $_POST['nvwhp'];
        $vwpj = $_POST['vwpj'];
        $nvwpj = $_POST['nvwpj'];
        $vkng = $_POST['vkng'];
        $nvkng = $_POST['nvkng'];
        if($vwhp>0){
            $cartItemN[] = "Whopper Veg";
            $cartItemQ[] = $vwhp;
            $cartItemP[] = $vwhp*$Pvwhp;
        }
        if($nvwhp>0){
            $cartItemN[] = "Whopper Non-Veg";
            $cartItemQ[] = $nvwhp;
            $cartItemP[] = $nvwhp*$Pnvwhp;
        }
        if($vwpj>0){
            $cartItemN[] = "Whopper Jr. Veg";
            $cartItemQ[] = $vwpj;
            $cartItemP[] = $vwpj*$Pvwpj;
        }
        if($nvwpj>0){
            $cartItemN[] = "Whopper Jr. Non-Veg";
            $cartItemQ[] = $nvwpj;
            $cartItemP[] = $nvwpj*$Pnvwpj;
    
        }
        if($vkng>0){
            $cartItemN[] = "King Veg";
            $cartItemQ[] = $vkng;
            $cartItemP[] = $vkng*$Pvkng;
        }
        if($nvkng>0){
            $cartItemN[] = "King Non-Veg";
            $cartItemQ[] = $nvkng;
            $cartItemP[] = $nvkng*$Pnvkng;
        }
    }
}
    
$totPrice = $tax = 0;
foreach($cartItemP as $pr){
    $totPrice = $totPrice + $pr;
}
if(($totPrice>0)){
    $tax = $totPrice*(8/100);
    $_SESSION["tax"] = $tax;
    $totPrice = $totPrice + $tax;
    $_SESSION["netAmount"] = $totPrice;
    if(empty(trim($_POST['addr']))){
        $err = "*Please enter Delivery Address";
    }
    else{
        $_SESSION["addr"] = $_POST['addr'];
        header("location: cart.php");
    }
    
    $_SESSION["cartItemN"] = $cartItemN;
    $_SESSION["cartItemQ"] = $cartItemQ;
    $_SESSION["cartItemP"] = $cartItemP;
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
                <li><a id="active" href="store.php">Store</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <div class="food-items">
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/Whopper.png" alt="wh">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vwhp" id="vwhp" min="0" max="10" value="0">
                        <input class="food-quantity" style="border: 2px solid red" type="number" name="nvwhp" id="nvwhp" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Whopper</h3>
                        <ul>
                            <li>Veg: Rs. 150</li>
                            <li>Non-Veg: Rs. 180</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/Whopper Jr.png" alt="whj">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vwpj" id="vwpj" min="0" max="10" value="0">
                        <input class="food-quantity" style="border: 2px solid red" type="number" name="nvwpj" id="nvwpj" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Whopper Jr.</h3>
                        <ul>
                            <li>Veg: Rs. 100</li>
                            <li>Non-Veg: Rs. 120</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/King.png" alt="kn">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" style="border: 2px solid green" type="number" name="vkng" id="vkng" min="0" max="10" value="0">
                        <input class="food-quantity" style="border: 2px solid red" type="number" name="nvkng" id="nvkng" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>King</h3>
                        <ul>
                            <li>Veg: Rs. 180</li>
                            <li>Non-Veg: Rs. 200</li>
                        </ul>
                    </div>
                </div>
                <!--<div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/Rebel.png" alt="rb">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" type="number" name="vrbl" id="vrbl" min="0" max="10" value="0">
                        <input class="food-quantity" type="number" name="nvrbl" id="nvrbl" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Rebel</h3>
                        <ul>
                            <li>Veg: Rs. 120</li>
                            <li>Non-Veg: Rs. 150</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/Shake.png" alt="sh">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" type="number" name="shk" id="shk" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Shake</h3>
                        <ul>
                            <li>Rs. 100</li>
                        </ul>
                    </div>
                </div>
                <div class="food">
                    <div class="food-pic">
                        <img src="Assets/Store/Meal.png" alt="ml">
                    </div>
                    <div class="food-input">
                        <input class="food-quantity" type="number" name="vml" id="vml" min="0" max="10" value="0">
                        <input class="food-quantity" type="number" name="nvml" id="nvml" min="0" max="10" value="0">
                    </div>
                    <div class="food-details">
                        <h3>Meal</h3>
                        <ul>
                            <li>Veg: Rs. 250</li>
                            <li>Non-Veg: Rs. 280</li>
                        </ul>
                    </div>
                </div>-->
                <div class="address" style="margin: 3% 8%">
                    <div>
                        Delivery Address: <span style="color: red;"><?php echo $err;?></span>
                    </div><br>
                    <div>
                        <input class="delivery-address" type="text" name="addr" id="addr" style="width: 50%; font-size: 16px; padding: 3px;" placeholder="221b Baker St, London NW1 6XE">
                    </div>
                </div>
                <div class="to-cart">
                    <button name="tocart" type="submit">Add to Cart</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>