<?php

session_start();
if (!isset($_SESSION["UserID"])) {
    header("location: index.php?error=badconn");
    exit();
}

if (!isset($_GET["imageid"])) {
    header("location: album.php?error=imageid-not-found");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commenti</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- stile -->
    <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/comments.css">
</head>

<body>
<?php include "assets/parts/header.php"; ?>

</body>

<main>
    <div class="container-lg my-5 row mx-auto">
        <div class="card px-0">
            <?php
            include "assets/includes/dbconn.inc.php";
            $conn = openCon();
            $sql = "SELECT * FROM TImages WHERE Eliminata = 0 AND ImageID = " . $_GET["imageid"];
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query);
            ?>
            <img src="assets/img/album/<?php echo $result["FileName"]; ?>" alt="immagine <?php echo $_GET["imageid"]; ?>" class="img-fluid mb-3 card-img-top">
            <div class="card-body">
                <?php

                // query per visualizzare nome completo del commentatore, data e testo del commento
                $sql = "SELECT TCommenti.*, TUsers.* FROM TCommenti INNER JOIN TUsers ON TCommenti.UserID=TUsers.UserID 
                        WHERE TCommenti.Eliminato = 0 AND TCommenti.ImageID = " . $_GET["imageid"];
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <div class="card-text d-flex align-items-center border-top pt-2">
                            <span class="comment-user me-3"><?php echo $row["NomeCompleto"]; ?></span>
                            <small><?php echo $row["Updated"]; ?></small>
                        </div>
                        <p class="card-text mb-3"><?php echo $row["Testo"]; ?></p>
                        <?php
                    }
                }
                mysqli_close($conn);
                ?>

                <form method="post" action="assets/includes/comment.inc.php" class="py-3">
                    <textarea name="comment" placeholder="Commenta la foto" class="form-control mb-3"></textarea>
                    <button type="submit" name="pubblica" class="btn btn-outline-primary">PUBBLICA COMMENTO</button>
                </form>
                <?php $_SESSION["imageID"] = $_GET["imageid"]; ?>
            </div>
        </div>
    </div>
</main>

</html>