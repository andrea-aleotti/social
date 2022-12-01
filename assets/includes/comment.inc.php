<?php

if(isset($_POST["pubblica"])) {
    session_start();
    $userid = $_SESSION["UserID"];
    $imageid = $_SESSION["imageID"];
    include "./dbconn.inc.php";
    $commento = $_POST["comment"];
    $conn = openCon();
    $sql = "INSERT INTO TCommenti (UserID, ImageID, Testo) VALUES('$userid', '$imageid', '$commento')";
    $query = mysqli_query($conn, $sql);
    if($query) {
        header("location: ../../comment.php?imageid=$imageid");
        mysqli_close($conn);
        exit();
    } else {
        header("location: ../../comment.php?imageid=$imageid&error=something-wrong");
        exit();
    }
} else {
    header("location: ../../comment.php?imageid=$imageid&error=badconn");
    exit();
}