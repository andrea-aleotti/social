<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login cliente</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- stile -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <main class="container-fluid">
        <div class="container-lg mx-auto my-5 px-3 row">
            <div class="col px-0">
                <div id="form-container" class="h-100 d-flex flex-column justify-content-center">
                    <form method="POST" action="assets/includes/login.inc.php">
                        
                        <?php
                        if (isset($_GET["error"])) {
                            switch ($_GET["error"]) {
                                case "emptyinputs":
                                    echo "<div class='alert alert-warning mb-5'>";
                                    echo "<span>Compilare tutti i campi per continuare.</span>";
                                    echo "</div>";
                                    break;
                                case "user-not-found":
                                    echo "<div class='alert alert-warning mb-5'>";
                                    echo "<span>Utente non trovato. Controllare email e password.</span>";
                                    echo "</div>";
                                    break;
                                case "waiting-confirm":
                                    echo "<div class='alert alert-warning mb-5'>";
                                    echo "<span>Utente in attesa di conferma della email di registrazione.</span>";
                                    echo "</div>";
                                    break;
                                case "invalid-email":
                                    echo "<div class='alert alert-warning mb-5'>";
                                    echo "<span>Inserire un'email valida.</span>";
                                    echo "</div>";
                                    break;
                                case "badconn":
                                    echo "<div class='alert alert-danger mb-5'>";
                                    echo "<span>Effettuare l'accesso tramite login.</span>";
                                    echo "</div>";
                                    break;
                            }
                        }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control" size="40">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-5">
                            <input type="password" name="psw" id="psw" placeholder="Password" class="form-control" size="40">
                            <label for="psw">Password</label>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn d-block linear-button" name="login">LOG IN</button>
                        </div>
                        <div class="text-center mb-5"><a href="forgotPsw.php" class="text-muted custom-hover">Password dimenticata?</a></div>
                    </form>
                </div>
            </div>
            <div class="col px-0">
                <img src="assets/img/login/login-cliente.jpg" alt="immagine login cliente" class="img-fluid">
            </div>
        </div>
    </main>
</body>

</html>
