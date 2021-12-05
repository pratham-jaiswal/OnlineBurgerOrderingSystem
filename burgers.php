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
                <li><a href="sales.php">Sales</a></li>
                <li><a id="active" href="burgers.php">Burgers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <div class="food-items">
            <div class="food">
                <div class="food-pic">
                    <img src="Assets/Store/Whopper.png" alt="wh">
                </div>
                <div class="food-input">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pvwhp" id="pvwhp" min="0" max="10" value="150">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dvwhp" id="dvwhp" min="0" max="10" value="0">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pnvwhp" id="pnvwhp" min="0" max="10" value="180">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dnvwhp" id="dnvwhp" min="0" max="10" value="0">
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
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pvwpj" id="pvwpj" min="0" max="10" value="100">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dvwpj" id="dvwpj" min="0" max="10" value="0">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pnvwpj" id="pnvwpj" min="0" max="10" value="120">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dnvwpj" id="dnvwpj" min="0" max="10" value="0">
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
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pvkng" id="pvkng" min="0" max="10" value="180">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dvkng" id="dvkng" min="0" max="10" value="0">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pnvkng" id="pnvkng" min="0" max="10" value="200">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dnvkng" id="dnvkng" min="0" max="10" value="0">
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
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pvrbl" id="pvrbl" min="0" max="10" value="120">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dvrbl" id="dvrbl" min="0" max="10" value="0">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pnvrbl" id="pnvrbl" min="0" max="10" value="150">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dnvrbl" id="dnvrbl" min="0" max="10" value="0">
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
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pshk" id="pshk" min="0" max="10" value="100">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dshk" id="dshk" min="0" max="10" value="0">
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
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pvml" id="pvml" min="0" max="10" value="250">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dvml" id="dvml" min="0" max="10" value="0">
                    <input class="food-price" style="margin-top: 10px; width: 100px;" type="number" name="pnvml" id="pnvml" min="0" max="10" value="280">
                    <input class="food-discount" style="margin-top: 10px; border: 2px solid red; width: 100px;" type="number" name="dnvml" id="dnvml" min="0" max="10" value="0">
                </div>
                <div class="food-details">
                    <h3>Meal</h3>
                    <ul>
                        <li>Veg: Rs. 250</li>
                        <li>Non-Veg: Rs. 280</li>
                    </ul>
                </div>
            </div>-->
            <div class="to-cart">
                <button onclick="location.href='burgers.php';">Update</button>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>