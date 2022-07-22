<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

session_start();
$email = $_SESSION["email"];
$nume = $_SESSION["nume"];
$prenume = $_SESSION["prenume"];
$rol = $_SESSION["rol"];
$username = $_POST["idInregistrare"];
$parola = $_POST["parolaInregistrare"];

if ($rol == "student") {
    if ($result = mysqli_query($connect, "INSERT INTO useri VALUES ('$username', '$email', '$parola','$nume','$prenume','0',NULL)")) {
?>
        <html lang="en">

        <head>
            <title>Finalizare inregistrare</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        </head>

        <body class="bg-info">
            <div class="w-50 mx-auto my-4 p-4 card container">
                <h5 class="text-center">Finalizare inregistrare</h5>
                <div class="text-center">
                    <p class="text-success font-size">
                        Felicitari, <?php echo $prenume; ?>! Contul a fost creat cu succes.
                    </p>
                    <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                </div>
            </div>
        </body>

        </html>
        <?php
        session_unset();
        session_destroy();
    } else {
        header("Location: procesare_solicitare.php?eroare=Nume de utilizator deja existent");
    }
} else {
    if ($rol == "profesor") {
        if ($result = mysqli_query($connect, "INSERT INTO useri VALUES ('$username', '$email', '$parola','$nume','$prenume','1',NULL)")) {
        ?>
            <html lang="en">

            <head>
                <title>Finalizare inregistrare</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            </head>

            <body class="bg-info">
                <div class="w-50 mx-auto my-4 p-4 card container">
                    <h5 class="text-center">Finalizare inregistrare</h5>
                    <div class="text-center">
                        <p class="text-success font-size">
                            Felicitari, <?php echo $prenume; ?>! Contul a fost creat cu succes.
                        </p>
                        <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                    </div>
                </div>
            </body>

            </html>
<?php
            session_unset();
            session_destroy();
        } else {
            header("Location: procesare_solicitare.php?eroare=Nume de utilizator deja existent");
        }
    }
}

mysqli_close($connect);
