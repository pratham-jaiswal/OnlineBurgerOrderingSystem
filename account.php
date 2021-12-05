<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}
require_once "config.php";
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
                <li><a href="cart.php">Cart</a></li>
                <li><a id="active" href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <section class="account-page">
            <div class="account-details">
                <div class="account" style="margin-left: 0.7%;">
                    <h3 style="font-size: 25px;">Account</h3 style="color: grey;">
                    <hr style="margin-right: 5%">
                </div>
                <div class="account-info">
                    <table>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $_SESSION["fullname"];?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $_SESSION["username"];?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $_SESSION["email"];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <?php if($_SESSION["admin"] == "NO"){?>
            <div class="account-details" style="margin-left: 0.7%; margin-top 4%;">
                <div class="orders">
                    <h3 style="font-size: 25px;">Orders</h3>
                    <hr style="margin-right: 5%">
                </div>
                <div class="sales-table" style="margin-top: 1%;">
                    <table style="justify-content: left;">
                        
                        <?php 
                            $sql = "SELECT * FROM orders WHERE username='".$_SESSION["username"]."'";
                            $results = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($results)==0): ?>
                                <h4 style='color: grey; font-size: 20px;'>No Orders!</h4>
                            <?php 
                            else: ?>
                                <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Details</th>
                            <?php
                                $oid = ''; $f=0;
                                while($ord = mysqli_fetch_assoc($results)): 
                                    if($oid!=$ord['order_id']): 
                                        if($f==1): $f=0;?>
                                            </tr>
                                        <?php 
                                        endif;
                                        $oid=$ord['order_id']; $f=1;
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?php echo $ord["id"];?></td>
                                        <td><?php echo $ord["order_id"];?></td>
                                        <td><?php echo $ord["username"];?></td>
                                        <td><?php echo $ord["fullname"];?></td>
                                        <td><?php echo $ord["item"];?></td>
                                        <td><?php echo $ord["quantity"];?></td>
                                        <td><?php echo $ord["email"];?></td>
                                        <td><?php echo $ord["address"];?></td>
                                        <td><?php echo $ord["details"];?></td>
                            <?php 
                                endwhile; 
                            endif; ?>
                            </tr>
                    </table>
                </div>
            </div>
            <?php }?>
        </section>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>