<html lang="en">

<head>
    <title>Solicitare cont de acces</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info">
    <div class="w-50 mx-auto my-4 p-4 card container">
        <?php
        $connect = mysqli_connect("localhost", "root", "", "licenta");

        if (mysqli_connect_errno()) {
            echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
            exit();
        }

        $functie = $_POST["functie"];
        $nume = $_POST["nume"];
        $prenume = $_POST["prenume"];
        $cnp = $_POST["cnp"];
        $email = $_POST["email"];

        if ($functie == "student") {
            $nr_matricol = $_POST["nr_matricol"];
            $facultate = $_POST["facultate"];
            $specializare = $_POST["specializare"];
            $an_studiu = $_POST["an_studiu"];
            if ($result = mysqli_query($connect, "SELECT * FROM studenti WHERE TRIM(LOWER(nume))=LOWER('$nume')
         AND TRIM(LOWER(prenume))=LOWER('$prenume')
         AND cnp='$cnp' AND TRIM(LOWER(nr_matricol))=LOWER('$nr_matricol')
          AND TRIM(LOWER(facultate))=LOWER('$facultate') AND TRIM(LOWER(specializare))=LOWER('$specializare')
           AND an_studiu='$an_studiu' AND TRIM(LOWER(email))=LOWER('$email')")) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_row($result);

                    if ($result = mysqli_query($connect, "SELECT * FROM useri WHERE TRIM(LOWER(email))=LOWER('$email') AND TRIM(LOWER(nume))=LOWER('$nume') AND TRIM(LOWER(prenume))=LOWER('$prenume')")) {
                        if (mysqli_num_rows($result) == 1) {
        ?>
                            <h5 class="text-center">Solicitare cont de acces pe HomeLearning</h5>
                            <div class="text-center">
                                <p class="text-warning font-size">
                                    Sunteti deja inrolat pe platforma HomeLearning.
                                </p>
                                <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <?php
                            session_start();
                            $_SESSION["email"] = $email;
                            $_SESSION["nume"] = $nume;
                            $_SESSION["prenume"] = $prenume;
                            $_SESSION["rol"] = $functie;
                            ?>
                            <h5 class="text-center">Finalizare inregistrare</h5>
                            <p class="text-danger pb-2">
                                <?php
                                $mesaj = isset($_GET['eroare']) ? $_GET['eroare'] : "";
                                echo $mesaj;
                                ?>
                            </p>
                            <form action="finalizare_inregistrare.php" method="post" onsubmit="return validareCampuri()">
                                <div class="form-group pb-2">
                                    <label for="idInregistrare">Alegeti un username</label>
                                    <input type="text" class="form-control" name="idInregistrare" id="idInregistrare" placeholder="Username" />
                                    <p class="text-danger" id="userValidation">Introduceti un username</p>
                                </div>
                                <div class="form-group py-2">
                                    <label for="parolaInregistrare">Alegeti o parola</label>
                                    <input type="password" class="form-control" name="parolaInregistrare" id="parolaInregistrare" placeholder="Parola" />
                                    <p class="text-danger" id="passValidation"></p>
                                </div>
                                <div class="form-group py-2">
                                    <label for="confirmParolaInregistrare">Confirmare parola</label>
                                    <input type="password" class="form-control" name="confirmParolaInregistrare" id="confirmParolaInregistrare" placeholder="Confirmare parola" />
                                    <p class="text-danger" id="confirmPassValidation"></p>
                                </div>
                                <div class="form-group pt-2"></div>
                                <input type="submit" class="btn btn-success btn-rounded" value="Creare cont" />
                            </form>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <h5 class="text-center">Solicitare cont de acces pe HomeLearning</h5>
                    <div class="text-center">
                        <p class="text-danger font-size">
                            Solicitarea pentru crearea unui cont pe platforma HomeLearning a fost respinsa.
                            Nu sunteti student in cadrul universitatii.
                        </p>
                        <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                    </div>
                    <?php
                }
            }
        } else {
            if ($functie == "profesor") {
                if ($result = mysqli_query($connect, "SELECT * FROM profesori WHERE TRIM(LOWER(nume))=LOWER('$nume')
         AND TRIM(LOWER(prenume))=LOWER('$prenume')
         AND cnp='$cnp' AND TRIM(LOWER(email))=LOWER('$email')")) {
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_row($result);

                        if ($result = mysqli_query($connect, "SELECT * FROM useri WHERE TRIM(LOWER(email))=LOWER('$email') AND TRIM(LOWER(nume))=LOWER('$nume') AND TRIM(LOWER(prenume))=LOWER('$prenume')")) {
                            if (mysqli_num_rows($result) == 1) {
                    ?>
                                <h5 class="text-center">Solicitare cont de acces pe HomeLearning</h5>
                                <div class="text-center">
                                    <p class="text-warning font-size">
                                        Sunteti deja inrolat pe platforma HomeLearning.
                                    </p>
                                    <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                                </div>
                            <?php
                            } else {
                            ?>
                                <?php
                                session_start();
                                $_SESSION["email"] = $email;
                                $_SESSION["nume"] = $nume;
                                $_SESSION["prenume"] = $prenume;
                                $_SESSION["rol"] = $functie;
                                ?>
                                <h5 class="text-center">Finalizare inregistrare</h5>
                                <p class="text-danger pb-2">
                                    <?php
                                    $mesaj = isset($_GET['eroare']) ? $_GET['eroare'] : "";
                                    echo $mesaj;
                                    ?>
                                </p>
                                <form action="finalizare_inregistrare.php" method="post" onsubmit="return validareCampuri()">
                                    <div class="form-group pb-2">
                                        <label for="idInregistrare">Alegeti un username</label>
                                        <input type="text" class="form-control" name="idInregistrare" id="idInregistrare" placeholder="Username" />
                                        <p class="text-danger" id="userValidation">Introduceti un username</p>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="parolaInregistrare">Alegeti o parola</label>
                                        <input type="password" class="form-control" name="parolaInregistrare" id="parolaInregistrare" placeholder="Parola" />
                                        <p class="text-danger" id="passValidation"></p>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="confirmParolaInregistrare">Confirmare parola</label>
                                        <input type="password" class="form-control" name="confirmParolaInregistrare" id="confirmParolaInregistrare" placeholder="Confirmare parola" />
                                        <p class="text-danger" id="confirmPassValidation"></p>
                                    </div>
                                    <div class="form-group pt-2"></div>
                                    <input type="submit" class="btn btn-success btn-rounded" value="Creare cont" />
                                </form>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <h5 class="text-center">Solicitare cont de acces pe HomeLearning</h5>
                        <div class="text-center">
                            <p class="text-danger font-size">
                                Solicitarea pentru crearea unui cont pe platforma HomeLearning a fost respinsa.
                                Nu sunteti profesor in cadrul universitatii.
                            </p>
                            <a class="btn btn-outline-info" href="index.php" role="button">Inapoi la pagina principala</a>
                        </div>
        <?php
                    }
                }
            }
        }

        mysqli_close($connect);
        ?>
    </div>
</body>

</html>

<script type="text/javascript">
    function validareCampuri() {
        var ok = true;
        var username = document.getElementById("idInregistrare").value;
        var validareUsername = document.getElementById("userValidation");
        validareUsername.style.display = "none";

        if (username == "") {
            validareUsername.style.display = "block";
            ok = false;
        }

        var parola = document.getElementById("parolaInregistrare").value;
        var validareParola = document.getElementById("passValidation");
        validareParola.style.display = "none";

        if (parola == "") {
            validareParola.innerHTML = "Introduceti o parola";
            validareParola.style.display = "block";
            ok = false;
        } else {
            if (!parola.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)) {
                validareParola.innerHTML = "Parola trebuie sa contina minim 8 caractere, cel putin o litera mare, o litera mica si o cifra";
                validareParola.style.display = "block";
                ok = false;
            }
        }

        var confirmParola = document.getElementById("confirmParolaInregistrare").value;
        var validareConfirmParola = document.getElementById("confirmPassValidation");
        validareConfirmParola.style.display = "none";

        if (parola != "" && ok == true) {
            if (confirmParola == "") {
                validareConfirmParola.innerHTML = "Confirmati parola";
                validareConfirmParola.style.display = "block";
                ok = false;
            } else {
                if (confirmParola.localeCompare(parola) != 0) {
                    validareConfirmParola.innerHTML = "Parolele nu se potrivesc";
                    validareConfirmParola.style.display = "block";
                    ok = false;
                }
            }
        }

        return ok;
    }
    window.onload = function() {
        document.getElementById("userValidation").style.display = "none";
        document.getElementById("passValidation").style.display = "none";
        document.getElementById("confirmPassValidation").style.display = "none";
    }
</script>