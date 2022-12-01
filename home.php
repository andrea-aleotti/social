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
    <title>Homepage</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- stile -->
    <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <?php include "assets/parts/header.php"; ?>

    <main>
        <div class="container-lg my-5">
            <div class="row">
                <div class="col-md-4 col-lg-3 bg-white px-0 me-3">
                    <div class="profile">
                        <div class="bg-orange">
                            <img src="https://dummyimage.com/200x200/000/fff.jpg" class="img-fluid">
                        </div>
                        <div class="profile-text">
                            <h4 class="my-3"><?php echo $_SESSION["Nome"]; ?></h4>
                            <p class="text-muted">Graphic designer</p>
                        </div>
                        <div class="border-top pt-3 text-center">
                            <h5 class="text-muted">Followers</h5>
                            <p>N/A</p>
                        </div>
                        <div class="border-top pt-3 text-center">
                            <h5 class="text-muted">Following</h5>
                            <p>N/A</p>
                        </div>
                        <div class="d-grid pb-0 mb-0">
                            <a href="#" class="btn btn-danger">Vedi profilo</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-7 bg-white top-block">
                    <div class="row justify-content-between align-items-center h-100">
                        <div class="col"><img src="https://dummyimage.com/70x70/000/fff.jpg" class="small-icon img-fluid"></div>
                        <div class="col">
                            <a href="upload.php" class="btn btn-danger text-white me-2">Carica una nuova foto</a>
                            <a href="album.php" class="btn btn-secondary text-white">Vedi foto</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 bg-white mt-3" style="height:400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>