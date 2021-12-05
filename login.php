<?php
//Handles login
session_start();

//Check if user is already logged in
if(isset($_SESSION['username'])){
    if($_SESSION["admin"]=='YES'){
        header("location: sales.php");
    }
    else{
        header("location: index.php");
    }
    exit();
}

require_once "config.php";

$username = $password = "";
$uerr = $perr = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
        $uerr = "Please enter both username and password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $sql = "SELECT id, fullname, email, username, password, admin FROM loginform WHERE username = ?";
        $q = mysqli_query($conn, $sql);
        if(!$q){
            $uerr = "An account with that username does not exist";
        }
    }
}
if(empty($err)){
    $sql = "SELECT id, fullname, email, username, password, admin, created_at FROM loginform WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    //Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $id, $fullname, $email, $username, $hashed_password, $admin, $created_at);
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hashed_password)){
                    //Password is correct. Allow user to login
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["fullname"] = $fullname;
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    $_SESSION["loggedin"] = true;
                    //Redirect the user to the accountInfo page
                    $_SESSION["admin"] = $admin;
                    $_SESSION["created_at"] = $created_at;
                    if($_SESSION["admin"]=='YES'){
                        header("location: sales.php");
                    }
                    else{
                        header("location: index.php");
                    }
                }
                else{
                    $perr = "Incorrect password";
                }
            }
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
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a id="active" href="login.php">Login</a></li>
            </ul>
        </ul>
    </nav>
    <div class="container">
        <form action="" method="post">
            <section class="login-page">
                <div class="login-input">
                    <div class="login-details">
                        <label for="username">Username</label> <span style="color:red;"><?php echo $uerr;?></span>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="login-details"> <span style="color:red;"><?php echo $perr;?></span>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>
                <div class="login-btn">
                    <button>Login</button>
                </div>
            </section>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/6f42fc440c.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>