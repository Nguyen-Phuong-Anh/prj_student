<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "utt";
    $conn = mysqli_connect($host, $user, $pass, $dbName);
    if($conn->connect_error) {
        die("Connection failed".mysqli_connect_error());
    }
?>