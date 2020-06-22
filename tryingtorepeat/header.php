<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    
    if(isset($_SESSION["ID"])){
        echo '<form action="includes/logout.inc.php" method="post">
        <button type="submit" name="logout-submit">LOGOUT</button>
    </form>';
    }
    else{
        echo '<form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login-submit">LOGIN</button>
    </form>
    
    <a href="signup.php">SIGNUP</a>';
    }
    ?>
    
