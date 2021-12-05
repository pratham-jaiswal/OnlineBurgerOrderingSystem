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
$cartItemN = $_SESSION["cartItemN"];
$cartItemQ = $_SESSION["cartItemQ"];
$cartItemP = $_SESSION["cartItemP"];
$netAmount = $_SESSION["netAmount"];
$username = $_SESSION['username'];
$addr = $_SESSION["addr"];
$cname = $cno = $emonth = $fullname = $email = $eyear = $cvv = $err = "";
$cname_err = $cno_err = $emy_err = $fullname_err = $email_err = $cvv_err = "";
if($_SERVER['REQUEST_METHOD']=="POST"){

    if(empty(trim($_POST['cname']))){
        $cname_err = "*Name on Card cannot be blank";
    }
    else{
        $cname = trim($_POST['cname']);
    }
    if(empty(trim($_POST['cno']))){
        $cno_err = "*Card Number cannot be blank";
    }
    else{
        if(strlen(trim($_POST['cno'])) == 16){
            $cno = trim($_POST['cno']);
        }
        else{
            $cno_err = "*Invalid Card Number";
        }
    }
    if(empty(trim($_POST['emonth'])) || empty(trim($_POST['eyear']))){
        $emy_err = "*Expiry month/year cannot be blank";
    }
    else{
        if(trim($_POST['eyear']) > date('Y')){
            if((trim($_POST['emonth'])<=12) && (trim($_POST['emonth'])>=1)){
                $emonth = trim($_POST['emonth']);
                $eyear = trim($_POST['eyear']);
            }
            else{
                $emy_err = "*Invalid month number";
            }
        }
        elseif(trim($_POST['eyear']) == date('Y')){
            if(trim($_POST['emonth']) > date('m')){
                $emonth = trim($_POST['emonth']);
                $eyear = trim($_POST['eyear']);
            }
            else{
                $emy_err = "*Card Expired!!";
            }
        }
        else{
            $emy_err = "*Card Expired!!";
        }
    }
    if(empty(trim($_POST['cvv']))){
        $cvv_err = "*CVV cannot be blank";
    }
    else{
        if(strlen(trim($_POST['cvv'])) == 3){
            $cvv = trim($_POST['cvv']);
        }
        else{
            $cvv_err = "*Invalid CVV";
        }
    }
    if(empty(trim($_POST['fullname']))){
        $name_err = "Full Name cannot be blank";
    }
    else{
        $fullname = trim($_POST['fullname']);
    }

    if(empty(trim($_POST['email']))){
        $email_err = "Email cannot be blank";
    }
    else{
        $email = trim($_POST['email']);
    }
}
$allCN = $allCQ = "";
foreach($cartItemN as $cn){
    $allCN = $cn.", ".$allCN;
}

foreach($cartItemQ as $cq){
    $allCQ = $cq.", ".$allCQ;
}

if(isset($_POST["paymentdone"])){
    if(empty($cname_err) && empty($ccno_err) && empty($emy_err) && empty($fullname_err) && empty($email_err) && empty($cvv_err)){
        $sql = "INSERT INTO orders (fullname, username, order_id, item, quantity, email, address, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_fullname, $param_username, $param_order_id, $param_item, $param_quantity, $param_email, $param_address, $param_price);
            $param_fullname = $fullname;
            $param_username = $username;
            $param_email = $email;
            $param_order_id = date('dmYhis');
            $param_item = $allCN;
            $param_quantity = $allCQ;
            $param_price = $netAmount;
            $param_address = $addr;
            $i++;
            //Try to execute the query
            if(mysqli_stmt_execute($stmt)){
                $_SESSION['payment'] = "yes";
                header("location: success.php");
            }
            else{
                $err = 'Something went wrong';
            }
            mysqli_stmt_close($stmt);
        }
    }
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
                <li><a id="active" href="payment.php">Payment</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="payment-page">
                <div class="payment-details">
                    <span style="color: red;"><?php echo $err;?></span>
                </div>
                <div class="payment-details">
                    <div class="pay-details">
                        <label for="cards">Accepted Cards</label>
                        <div>
                            <i class="fa fa-cc-mastercard fa-3x" aria-hidden="true" style="color:red;"></i>
                            <i class="fa fa-cc-visa fa-3x" aria-hidden="true" style="color:navy;"></i>
                        </div>
                    </div>
                    <div class="pay-details">
                        <label for="fullname">Full Name</label> <span style="color:red;"><?php echo $fullname_err;?></span>
                        <input type="text" name="fullname" id="fullname" placeholder="Tony Stark">
                    </div>
                    <div class="pay-details">
                        <label for="email">Email</label> <span style="color:red;"><?php echo $email_err;?></span>
                        <input type="email" name="email" id="email" placeholder="billionare@avengers.com">
                    </div>
                    <div class="pay-details">
                        <label for="cname">Name on Card</label> <span style="color:red;"><?php echo $cname_err;?></span>
                        <input type="text" name="cname" id="cname" placeholder="Anthony Edward Stark">
                    </div>
                    <div class="pay-details">
                        <label for="cno">Card Number</label> <span style="color:red;"><?php echo $cno_err;?></span>
                        <input type="text" name="cno" id="cno" placeholder="1111222233334444">
                    </div>
                    <div class="pay-details">
                        <label for="emonth">Expiry Month</label> <span style="color:red;"><?php echo $emy_err;?></span>
                        <input type="text" name="emonth" id="emonth" placeholder="11">
                    </div>
                    <div class="pay-details">
                        <label for="eyear">Expiry Year</label> <span style="color:red;"><?php echo $emy_err;?></span>
                        <input type="text" name="eyear" id="eyear" placeholder="2025">
                    </div>
                    <div class="pay-details">
                        <label for="cvv">CVV</label> <span style="color:red;"><?php echo $cvv_err;?></span>
                        <input type="text" name="cvv" id="cvv" placeholder="123">
                    </div>
                </div>
                <div class="pay">
                    <button type="submit" name="paymentdone">Pay &#x20B9;<?php echo $_SESSION["netAmount"];?></button>
                </div>
            </section>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>