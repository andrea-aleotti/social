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
    <title>Album</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- stile -->
    <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
<?php include "assets/parts/header.php"; ?>

    <main>
        <div class="container-lg my-5 row mx-auto">
            <form method="post" action="filtra_like.php" class="justify-content-start">
                <p class="me-3">Filtra per Likes:
                    <input class="ms-3" type="radio" id="cresc" name="sort" value="cresc">
                    <label class="form-check-label" for="cresc">Crescente</label>

                    <input class="ms-3" type="radio" id="decr" name="sort" value="decr">
                    <label class="form-check-label" for="decr">Decrescente</label>

                    <button type="submit" name="filtra" class="badge bg-danger border-0 p-2 ms-3">FILTRA</button>
                </p>
            </form>
            <?php

            if (isset($_POST["filtra"])) {
                include "assets/includes/dbconn.inc.php";
                $order = $_POST["sort"];
                $conn = openCon();
                if($order == "cresc") {
                    $sql = "SELECT * FROM TImages WHERE Eliminata = 0 ORDER BY Likes ASC LIMIT 10";
                } else {
                    $sql = "SELECT * FROM TImages WHERE Eliminata = 0 ORDER BY Likes DESC LIMIT 10";
                }
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
            ?>
                        <div class="col-sm-1 col-md-2 col-lg-4 px-0 card mx-2 my-3">
                            <div class="elimina">
                                <?php
                                if ($row["UserID"] == $_SESSION["UserID"]) {
                                    echo "<a href='assets/includes/delete.inc.php?imageid=" . $row["ImageID"] . "' name='elimina' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a>";
                                }
                                ?>
                            </div>
                            <div class="card-img-container">
                                <a href="comment.php?imageid=<?php echo $row["ImageID"]; ?>" title="lascia un commento">
                                    <img src="assets/img/album/<?php echo $row["FileName"]; ?>" class="card-img-top" alt="immagine">
                                    <span class="text-comment">Lascia un commento <i class="fa-regular fa-comments"></i></span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-3 d-flex justify-content-between align-items-center">
                                    <div class="col-sm-6">
                                        <?php
                                        echo $row["Titolo"];
                                        if ($row["UserID"] == $_SESSION["UserID"]) {
                                            echo "<a href='assets/includes/changeTitle.inc.php?imageid=" . $row["ImageID"] . "' name='elimina'>";
                                            echo "<i class='fa-solid fa-pencil ms-2' style='font-size: 10px; vertical-align: super;'></i>";
                                            echo "</a>";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <a href="assets/includes/likes.inc.php?imageid=<?php echo $row["ImageID"]; ?>">
                                            <i class="fa-regular fa-thumbs-up"></i>
                                        </a>
                                        <span class="badge bg-danger">
                                            <?php
                                            $sql2 = "SELECT * FROM TLikes WHERE ImageID = " . $row["ImageID"];
                                            $query2 = mysqli_query($conn, $sql2);
                                            $tot = mysqli_num_rows($query2);
                                            echo $tot;
                                            ?>
                                        </span>
                                    </div>
                                </h5>
                                <div>
                                    <small class="card-text mt-2"> Pubblicato da
                                        <?php
                                        $sql2 = "SELECT * FROM TUsers WHERE UserID = " . $row["UserID"];
                                        $query2 = mysqli_query($conn, $sql2);
                                        $result = mysqli_fetch_assoc($query2);
                                        echo $result["Email"];
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                    mysqli_close($conn);
                }
            }
            ?>
        </div>
    </main>

    <script src="assets/js/script.js"></script>
</body>

</html>