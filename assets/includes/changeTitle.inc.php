<?php
session_start();
if (!isset($_SESSION["UserID"])) {
    header("location: index.php?error=badconn");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload foto</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- stile -->
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        form {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php include "../parts/header.php"; ?>

    <main class="container-lg my-3">
        <form method="post" action="">
            <input type="text" name="titolo" placeholder="Titolo" class="form-control mb-3" required>
            <button type="submit" name="change" class="btn btn-warning text-white d-block mx-auto">CAMBIA</button>
        </form>
    </main>

</body>

</html>
<?php

if (isset($_GET["imageid"])) {
    if (isset($_POST["change"])) {
        $newtitle = $_POST["titolo"];
        include "./dbconn.inc.php";
        $conn = openCon();
        $sql = "UPDATE TImages SET Titolo = '$newtitle' WHERE ImageID = " . $_GET['imageid'];
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header("location: ../../album.php?error=title-none");
            mysqli_close($conn);
            exit();
        } else {
            header("location: ../../album.php?error=title-wrong");
            exit();
        }
    }
} else {
    header("location: ../../album.php");
    exit();
}
