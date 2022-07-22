<html lang="en">

<head>
    <title>Autentificare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info">
    <div class="w-50 mx-auto my-4 p-4 card container">
        <h5 class="text-center">Autentificare</h5>
        <p class="text-danger pb-2">
            <?php
            $mesaj = isset($_GET['eroare']) ? $_GET['eroare'] : "";
            echo $mesaj;
            ?>
        </p>
        <form action="autentificare.php" method="post">
            <div class="form-group pb-2">
                <label for="idAutentificare">Nume de utilizator/e-mail</label>
                <input type="text" class="form-control" name="idAutentificare" id="idAutentificare" placeholder="User/e-mail" />
            </div>
            <div class="form-group py-2">
                <label for="parolaAutentificare">Parola</label>
                <input type="password" class="form-control" name="parolaAutentificare" id="parolaAutentificare" placeholder="Parola" />
            </div>
            <div class="form-group py-2">
                <p>
                    <a href="solicitare_cont.php" class="text-primary text-underline">Solicitare cont de acces pe HomeLearning</a>
                </p>
            </div>
            <input type="submit" class="btn btn-success btn-rounded" value="Conectare" />
        </form>
    </div>
</body>

</html>