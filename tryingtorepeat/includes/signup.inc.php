<?php
    if(isset($_POST['signup-submit'])){
        require "dbh.inc.php";
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];
        if(empty($user) || empty($email) || empty($pass)){
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-ZA-Z0-9]*$/", $user)){
            header("Location: ../signup.php?error=emailandusercoulndtvalidate");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../signup.php?error=emailcoulndtvalidate");
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $user)){
            header("Location: ../signup.php?error=usernamecouldntvalidate");
            exit();
        }
        else if($pass !== $pass2){
            header("Location: ../signup.php?error=passwordsdontmatch");
            exit();
        }
        else{
            $sql = "SELECT Username FROM users WHERE Username=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?sql=error1");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0){
                    header("Location: ../signup.php?error=usernameistaken");
                    exit();
                }
                else{
                    $sql = "INSERT INTO users(Username, Email, Password) VALUES(?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../signup.php?sql=errori");
                        exit();
                    }
                    else{
                        $hashed = password_hash($pass, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $user, $email, $hashed);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../index.php?sql=success");
                        exit(); 
                    }

                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else{
        header("Location: ../signup.php");
        exit();
    }