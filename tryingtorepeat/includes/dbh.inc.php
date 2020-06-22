<?php
    $conn = mysqli_connect("localhost","root","","login");
    if(!$conn){
        die("connection not succesful");
    }
    else{
        echo "connection succesful";
    }