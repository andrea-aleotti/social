<?php

include "./dbconn.inc.php";
include "./functions.inc.php";

session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $psw = $_POST["psw"];

    if (checkInputsLogin($email, $psw) === 1) {
        header("location: ../../index.php?error=emptyinputs");
        exit();
    }

    if(checkValidEmail($email) === 0) {
        header("location: ../../index.php?error=invalid-email");
        exit();
    }

    $conn = openCon();
    $sql = "SELECT * FROM TUsers WHERE Email = '$email' AND Password = '$psw'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 0) {
        header("location: ../../index.php?error=user-not-found");
        exit();
    }

    $row = mysqli_fetch_assoc($query);

    if ($row["RegistrazioneConfermata"] == 0) {
        header("location: ../../index.php?error=waiting-confirm");
        exit();
    }

    $_SESSION["UserID"] = $row["UserID"];
    $_SESSION["Nome"] = $row["NomeCompleto"];
    header("location: ../../home.php");
    mysqli_close($conn);
} else {
    header("location: ../../index.php?error=badconn");
    exit();
}
