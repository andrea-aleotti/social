<?php

function openCon() {
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "social";
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}

function closeCon($conn) {
    mysqli_close($conn);
}
