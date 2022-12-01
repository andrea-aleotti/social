<?php

session_start();

$userid = $_SESSION["UserID"];
$imageid = $_GET["imageid"];

include "./dbconn.inc.php";
$conn = openCon();
// prima query in cui controllo se per quella foto è già stato lasciato un like dall'utente
$sql = "SELECT * FROM TLikes WHERE UserID = $userid AND ImageID = $imageid";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 1) {
    // in caso positivo allora cancello il like
    $sql2 = "DELETE FROM TLikes WHERE UserID = $userid AND ImageID = $imageid";
    $query2 = mysqli_query($conn, $sql2);

    // ora faccio l'update su TImages dei Likes
    $sql5 = "UPDATE TImages SET Likes = Likes - 1 WHERE ImageID = $imageid";
    $query5 = mysqli_query($conn, $sql5);
    header("location: ../../album.php");
    exit();
} else {
    // altrimenti lo inserisco
    $sql3 = "INSERT INTO TLikes (UserID, ImageID) VALUES ($userid, $imageid)";
    $query3 = mysqli_query($conn, $sql3);

    // ora faccio l'update su TImages dei Likes
    $sql4 = "UPDATE TImages SET Likes = Likes + 1 WHERE ImageID = $imageid";
    $query4 = mysqli_query($conn, $sql4);
    header("location: ../../album.php");
    exit();
}
