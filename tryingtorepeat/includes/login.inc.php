<?php
    if(isset($_POST['login-submit'])){
        require "dbh.inc.php";
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM users WHERE Username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $passCheck = password_verify($pass, $row['Password']);
                if($passCheck == false){
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                else if($passCheck == true){
                    session_start();
                    $_SESSION["ID"] = $row['ID'];
                    $_SESSION["Username"] = $row['Username'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }

    }
    else{
        header("Location: ../index.php");
        exit();
    }