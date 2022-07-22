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
        <h5 class="text-center">Solicitare cont de acces pe HomeLearning</h5>
        <form action="procesare_solicitare.php" method="post" onsubmit="return validareCampuri()">
            <div class="form-group pb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="functie" value="student" id="student" onclick="activareDateStudent()">
                    <label class="form-check-label" for="student">
                        Student
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="functie" value="profesor" id="profesor" onclick="dezactivareDateStudent()">
                    <label class="form-check-label" for="profesor">
                        Profesor
                    </label>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="nume">Nume</label>
                <input type="text" class="form-control" name="nume" id="nume" placeholder="Nume" />
                <p class="text-danger" id="numeValidation">Nume invalid; ex.Popescu</p>
            </div>
            <div class="form-group py-2">
                <label for="prenume">Prenume</label>
                <input type="text" class="form-control" name="prenume" id="prenume" placeholder="Prenume" />
                <p class="text-danger" id="prenumeValidation">Prenume invalid; ex.Ion</p>
            </div>
            <div class="form-group py-2">
                <label for="cnp">CNP</label>
                <input type="text" class="form-control" name="cnp" id="cnp" placeholder="CNP" />
                <p class="text-danger" id="cnpValidation">CNP invalid; ex.5020928355061</p>
            </div>
            <div class="form-group py-2">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" />
                <p class="text-danger" id="emailValidation">Email invalid; ex.ion.popescu@student.upt.ro</p>
            </div>
            <div class="form-group py-2">
                <label for="nr_matricol">Numar matricol</label>
                <input type="text" class="form-control" name="nr_matricol" id="nr_matricol" placeholder="Numar matricol" />
                <p class="text-danger" id="nrMatValidation">Nr. matricol invalid; ex.LH612280</p>
            </div>
            <div class="form-group py-2">
                <label for="facultate">Facultate</label>
                <select class="form-control" name="facultate" id="facultate" onchange="optiuniSpecializare()">
                    <option value="Arhitectura si Urbanism">Arhitectura si Urbanism</option>
                    <option value="Automatica si Calculatoare">Automatica si Calculatoare</option>
                    <option value="Chimie Industriala si Ingineria Mediului">Chimie Industriala si Ingineria
                        Mediului</option>
                    <option value="Constructii">Constructii</option>
                    <option value="Electronica, Telecomunicatii si Tehnologii Informationale">Electronica,
                        Telecomunicatii si Tehnologii
                        Informationale</option>
                    <option value="Electrotehnica si Electroenergetica">Electrotehnica si Electroenergetica</option>
                    <option value="Inginerie din Hunedoara">Inginerie din Hunedoara</option>
                    <option value="Management in Productie si Transporturi">Management in Productie si Transporturi
                    </option>
                    <option value="Mecanica">Mecanica</option>
                    <option value="Stiinte ale Comunicarii">Stiinte ale Comunicarii</option>
                </select>
            </div>
            <div class="form-group py-2">
                <label for="specializare">Specializare</label>
                <select class="form-control" name="specializare" id="specializare"></select>
            </div>
            <div class="form-group py-2">
                <label for="an_studiu">An de studiu</label>
                <select class="form-control" name="an_studiu" id="an_studiu">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="form-group pt-2"></div>
            <input type="submit" class="btn btn-success btn-rounded" value="Solicitare cont" />
        </form>
    </div>
</body>

</html>

<script type="text/javascript">
    function activareDateStudent() {
        document.getElementById("nr_matricol").disabled = false;
        document.getElementById("facultate").disabled = false;
        document.getElementById("specializare").disabled = false;
        document.getElementById("an_studiu").disabled = false;
    }

    function dezactivareDateStudent() {
        document.getElementById("nr_matricol").value = "";
        document.getElementById("nr_matricol").disabled = true;
        document.getElementById("facultate").disabled = true;
        document.getElementById("specializare").disabled = true;
        document.getElementById("an_studiu").disabled = true;
    }

    function validareCampuri() {
        var ok = true;
        var nume = document.getElementById("nume").value;
        var validareNume = document.getElementById("numeValidation");
        validareNume.style.display = "none";

        if (!nume.match(/^[A-Z][a-z]+((\ |\-)[A-Z][a-z]+)*$/)) {
            validareNume.style.display = "block";
            ok = false;
        }

        var prenume = document.getElementById("prenume").value;
        var validarePrenume = document.getElementById("prenumeValidation");
        validarePrenume.style.display = "none";

        if (!prenume.match(/^[A-Z][a-z]+((\ |\-)[A-Z][a-z]+)*$/)) {
            validarePrenume.style.display = "block";
            ok = false;
        }

        var email = document.getElementById("email").value;
        var validareEmail = document.getElementById("emailValidation");
        validareEmail.style.display = "none";

        if (!email.match(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/)) {
            validareEmail.style.display = "block";
            ok = false;
        }

        var cnp = document.getElementById("cnp").value;
        var validareCnp = document.getElementById("cnpValidation");
        validareCnp.style.display = "none";

        if (!cnp.match(/^[1-9]\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])(0[1-9]|[1-4]\d|5[0-2]|99)(00[1-9]|0[1-9]\d|[1-9]\d\d)\d$/)) {
            validareCnp.style.display = "block";
            ok = false;
        }

        var validareNrMat = document.getElementById("nrMatValidation");
        validareNrMat.style.display = "none";

        if (document.getElementById("student").checked == true) {
            var nr_matricol = document.getElementById("nr_matricol").value;
            if (!nr_matricol.match(/^[A-Za-z][A-Za-z0-9][0-9]{5}[0-9]?$/)) {
                validareNrMat.style.display = "block";
                ok = false;
            }
        }

        return ok;
    }

    function optiuniSpecializare() {
        var optiuniSpecializare = document.querySelectorAll('#specializare option');
        optiuniSpecializare.forEach(o => o.remove());
        var e = document.getElementById("facultate");
        switch (e.selectedIndex) {
            case 0: {
                var opt;
                opt = document.createElement('option');
                opt.value = "Arhitectura";
                opt.innerHTML = opt.value;
                document.getElementById("specializare").appendChild(opt);
            }
            break;
        case 1: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Calculatoare si tehnologia informatiei";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria sistemelor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Informatica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 2: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Inginerie chimica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria mediului";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria produselor alimentare";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 3: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Inginerie civila";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria instalatiilor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie geodezica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 4: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Inginerie electronica, telecomunicatii si tehnologii informationale";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 5: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Inginerie electrica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie energetica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 6: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Stiinte ingineresti aplicate";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie electrica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria autovehiculelor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria mediului";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie si management";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 7: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Inginerie si management";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Stiinte administrative";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 8: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Ingineria materialelor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie industriala";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Inginerie mecanica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Stiinte ingineresti aplicate";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria transporturilor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Ingineria autovehiculelor";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Mecatronica si robotica";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        case 9: {
            var opt;
            opt = document.createElement('option');
            opt.value = "Stiinte ale comunicarii";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
            opt = document.createElement('option');
            opt.value = "Limbi moderne aplicate";
            opt.innerHTML = opt.value;
            document.getElementById("specializare").appendChild(opt);
        }
        break;
        }
    }
    window.onload = function() {
        document.getElementById("numeValidation").style.display = "none";
        document.getElementById("prenumeValidation").style.display = "none";
        document.getElementById("cnpValidation").style.display = "none";
        document.getElementById("emailValidation").style.display = "none";
        document.getElementById("nrMatValidation").style.display = "none";
        optiuniSpecializare();
        document.getElementById("student").checked = true;
    }
</script>