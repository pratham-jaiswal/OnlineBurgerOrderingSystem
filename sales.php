<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}
if($_SESSION["admin"]=='NO'){
    header("location: index.php");
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
                <li><a id="active" href="sales.php">Sales</a></li>
                <li><a href="burgers.php">Burgers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
        <section class="sales-page"><div class="sales-table" style="margin-top: 1%;">
            <div class="container">
                <div class="orders" style="margin-left: 5%; margin-top 4%;">
                    <h3 style="font-size: 25px;">Confirmed</h3>
                    <hr style="margin-right: 5%">
                </div>
                <div class="sales-table" style="margin-top: 1%;">
                    <table style="margin-bottom: 4%;">
                        <?php 
                            $sql = "SELECT * FROM orders WHERE details='Confirmed'";
                            $results = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($results)==0): ?>
                                <h4 style='margin-left: 5%; color: grey; font-size: 20px;'>No Orders!</h4>
                            <?php 
                            else: ?>
                                <tr>
                                <th style="border: 1px solid black; padding: 10px;">ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Order ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Username</th>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Item</th>
                                <th style="border: 1px solid black; padding: 10px;">Quantity</th>
                                <th style="border: 1px solid black; padding: 10px;">Email</th>
                                <th style="border: 1px solid black; padding: 10px;">Address</th>
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
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["order_id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["username"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["fullname"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["item"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["quantity"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["email"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["address"];?></td>
                                        <td style="border: none;">
                                            <a style="color: black; text-decoration: none;" onmouseover="style='color: blue; text-decoration: none;'"return; onmouseout="style='color: black; text-decoration: none;'"return; href="outForDelivery.php?order_id=<?=$ord['order_id']?>"><i class="fas fa-truck"></i></a>
                                        </td>
                            <?php 
                                endwhile; 
                            endif; ?>
                            </tr>
                    </table>
                </div>
                
                <div class="orders" style="margin-left: 5%; margin-top 4%;">
                    <h3 style="font-size: 25px;">Out for Delivery</h3>
                    <hr style="margin-right: 5%">
                </div>
                <div class="sales-table" style="margin-top: 1%;">
                    <table style="margin-bottom: 4%;">
                        <?php 
                            $sql = "SELECT * FROM orders WHERE details='Out for Delivery'";
                            $results = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($results)==0): ?>
                                <h4 style='margin-left: 5%; color: grey; font-size: 20px;'>No Orders!</h4>
                            <?php 
                            else: ?>
                                <tr>
                                <th style="border: 1px solid black; padding: 10px;">ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Order ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Username</th>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Item</th>
                                <th style="border: 1px solid black; padding: 10px;">Quantity</th>
                                <th style="border: 1px solid black; padding: 10px;">Email</th>
                                <th style="border: 1px solid black; padding: 10px;">Address</th>
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
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["order_id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["username"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["fullname"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["item"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["quantity"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["email"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["address"];?></td>
                                        <td style="border: none;">
                                            <a style="color: black; text-decoration: none;" onmouseover="style='color: blue; text-decoration: none;'"return; onmouseout="style='color: black; text-decoration: none;'"return; href="delivered.php?order_id=<?=$ord['order_id']?>"><i class="fas fa-truck-loading"></i></a>
                                        </td>
                            <?php 
                                endwhile; 
                            endif; ?>
                            </tr>
                    </table>
                </div>
                
                <div class="orders" style="margin-left: 5%; margin-top 4%;">
                    <h3 style="font-size: 25px;">Delivered</h3>
                    <hr style="margin-right: 5%">
                </div>
                <div class="sales-table" style="margin-top: 1%;">
                    <table style="margin-bottom: 4%;">
                        <?php 
                            $sql = "SELECT * FROM orders WHERE details='Delivered'";
                            $results = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($results)==0): ?>
                                <h4 style='margin-left: 5%; color: grey; font-size: 20px;'>No Orders!</h4>
                            <?php 
                            else: ?>
                                <tr>
                                <th style="border: 1px solid black; padding: 10px;">ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Order ID</th>
                                <th style="border: 1px solid black; padding: 10px;">Username</th>
                                <th style="border: 1px solid black; padding: 10px;">Full Name</th>
                                <th style="border: 1px solid black; padding: 10px;">Item</th>
                                <th style="border: 1px solid black; padding: 10px;">Quantity</th>
                                <th style="border: 1px solid black; padding: 10px;">Email</th>
                                <th style="border: 1px solid black; padding: 10px;">Address</th>
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
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["order_id"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["username"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["fullname"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["item"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["quantity"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["email"];?></td>
                                        <td style="border: 1px solid black; padding: 10px;"><?php echo $ord["address"];?></td>
                            <?php 
                                endwhile; 
                            endif; ?>
                            </tr>
                    </table>
                </div>
            </div>
        </section>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>