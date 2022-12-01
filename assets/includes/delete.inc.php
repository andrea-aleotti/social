<?php

if (isset($_GET["imageid"])) {
    include "./dbconn.inc.php";
    $conn = openCon();
    $sql = "UPDATE TImages SET Eliminata = 1 WHERE ImageID = " . $_GET['imageid'];
    $query = mysqli_query($conn, $sql);
    if($query) {
        header("location: ../../album.php?error=img-none");
        mysqli_close($conn);
        exit();
    } else {
        header("location: ../../album.php?error=img-wrong");
        exit();
    }
} else {
    header("location: ../../album.php");
    exit();
}
