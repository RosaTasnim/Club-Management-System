<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'club';

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn){
        echo 'Connection Unsuccessfull';
    }
?>