<?php
session_start();
?>
<html lang="en">

<head>
    <title>HomeLearning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="admin.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">HomeLearning</span>
                    </a>
                    <div class="nav nav-pills flex-column mb-sm-auto mb-0 me-3 align-items-center align-items-sm-start" id="menu" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="materii-tab" data-bs-toggle="pill" data-bs-target="#materii" type="button" role="tab" aria-controls="materii" aria-selected="true">Materii</button>
                        <button class="nav-link" id="studenti-tab" data-bs-toggle="pill" data-bs-target="#studenti" type="button" role="tab" aria-controls="studenti" aria-selected="false">Studenti</button>
                        <button class="nav-link" id="profesori-tab" data-bs-toggle="pill" data-bs-target="#profesori" type="button" role="tab" aria-controls="profesori" aria-selected="false">Profesori</button>
                        <button class="nav-link" id="profil-tab" data-bs-toggle="pill" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="false">Profil</button>
                    </div>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $_SESSION["poza"]; ?>" alt="poza" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">
                                <?php
                                echo $_SESSION["username"];
                                ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="index.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3 tab-content">
                <div class="tab-pane fade show active" id="materii" role="tabpanel" aria-labelledby="materii-tab">
                    <div class="container-fluid">
                        <div class="col-md-12 alert alert-primary">Lista materii</div>
                        <button type="button" class="btn btn-primary bt-sm" data-bs-toggle="modal" data-bs-target="#adaugare_materie">Adaugare materie</button>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="tabel_materii">
                                    <thead>
                                        <tr>
                                            <th>Cod</th>
                                            <th>Denumire</th>
                                            <th>Facultate</th>
                                            <th>Specializare</th>
                                            <th>An de studiu</th>
                                            <th>Semestru</th>
                                            <th>Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connect = mysqli_connect("localhost", "root", "", "licenta");

                                        if (mysqli_connect_errno()) {
                                            echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                            exit();
                                        }
                                        if ($result = mysqli_query($connect, "SELECT * FROM materii")) {
                                            if (mysqli_num_rows($result) >= 1) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['cod_materie'] ?></td>
                                                        <td><?php echo $row['denumire'] ?></td>
                                                        <td><?php echo $row['facultate'] ?></td>
                                                        <td><?php echo $row['specializare'] ?></td>
                                                        <td><?php echo $row['an_studiu'] ?></td>
                                                        <td><?php echo $row['semestru'] ?></td>
                                                        <td>
                                                            <center>
                                                                <button class="btn btn-sm btn-outline-danger stergere_materie" data-id="<?php echo $row['cod_materie'] ?>" type="button"><i class="fa fa-trash"></i> Stergere</button>
                                                            </center>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        mysqli_close($connect);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-md-12 alert alert-primary">Materii studenti</div>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="tabel_materii_studenti">
                                            <thead>
                                                <tr>
                                                    <th>Nume de utilizator</th>
                                                    <th>Cod materie</th>
                                                    <th>Actiuni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $connect = mysqli_connect("localhost", "root", "", "licenta");

                                                if (mysqli_connect_errno()) {
                                                    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                                    exit();
                                                }
                                                if ($result = mysqli_query($connect, "SELECT * FROM materii_studenti")) {
                                                    if (mysqli_num_rows($result) >= 1) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                            <tr>
                                                                <td><?php echo $row['username'] ?></td>
                                                                <td><?php echo $row['cod_materie'] ?></td>
                                                                <td>
                                                                    <center>
                                                                        <button class="btn btn-sm btn-outline-danger stergere_materie_student" data-id="<?php echo $row['username'] . " " . $row['cod_materie'] ?>" type="button"><i class="fa fa-trash"></i> Stergere</button>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                }
                                                mysqli_close($connect);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-md-12 alert alert-primary">Materii profesori</div>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="tabel_materii_profesori">
                                            <thead>
                                                <tr>
                                                    <th>Nume de utilizator</th>
                                                    <th>Cod materie</th>
                                                    <th>Actiuni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $connect = mysqli_connect("localhost", "root", "", "licenta");

                                                if (mysqli_connect_errno()) {
                                                    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                                    exit();
                                                }
                                                if ($result = mysqli_query($connect, "SELECT * FROM materii_profesori")) {
                                                    if (mysqli_num_rows($result) >= 1) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                            <tr>
                                                                <td><?php echo $row['username'] ?></td>
                                                                <td><?php echo $row['cod_materie'] ?></td>
                                                                <td>
                                                                    <center>
                                                                        <button class="btn btn-sm btn-outline-danger stergere_materie_profesor" data-id="<?php echo $row['username'] . " " . $row['cod_materie'] ?>" type="button"><i class="fa fa-trash"></i> Stergere</button>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                }
                                                mysqli_close($connect);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="adaugare_materie" role="dialog">
                        <div class="modal-dialog modal-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Adaugare materie</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <form method="post" id="form_adaugare_materie">
                                    <div class="modal-body">
                                        <div id="mesaj_materie"></div>
                                        <div class="form-group">
                                            <label>Denumire</label>
                                            <input type="text" name="denumire" id="denumire" required class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Facultate</label>
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
                                        <div class="form-group">
                                            <label>Specializare</label>
                                            <select class="form-control" name="specializare" id="specializare"></select>
                                        </div>
                                        <div class="form-group">
                                            <label>An de studiu</label>
                                            <select class="form-control" name="an_studiu" id="an_studiu">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Semestru</label>
                                            <select class="form-control" name="semestru" id="semestru">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Salvare" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="studenti" role="tabpanel" aria-labelledby="studenti-tab">
                    <div class="container-fluid">
                        <div class="col-md-12 alert alert-primary">Lista studenti</div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="tabel_studenti">
                                    <thead>
                                        <tr>
                                            <th>Nume de utilizator</th>
                                            <th>Nume</th>
                                            <th>Prenume</th>
                                            <th>Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connect = mysqli_connect("localhost", "root", "", "licenta");

                                        if (mysqli_connect_errno()) {
                                            echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                            exit();
                                        }
                                        if ($result = mysqli_query($connect, "SELECT * FROM useri WHERE rol='0'")) {
                                            if (mysqli_num_rows($result) >= 1) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['username'] ?></td>
                                                        <td><?php echo $row['nume'] ?></td>
                                                        <td><?php echo $row['prenume'] ?></td>
                                                        <td>
                                                            <center>
                                                                <button class="btn btn-sm btn-outline-primary asignare_materie_student" data-id="<?php echo $row['username'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#asignare_materie_student"><i class="fa fa-plus"></i> Asignare materie</button>
                                                            </center>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        mysqli_close($connect);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="asignare_materie_student" role="dialog">
                        <div class="modal-dialog modal-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Asignare materie unui student</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <form method="post" id="form_asignare_materie_student">
                                    <div class="modal-body">
                                        <div id="mesaj_asignare_materie_student"></div>
                                        <div class="form-group">
                                            <label>Nume de utilizator</label>
                                            <input type="text" name="username_student" id="username_student" class="form-control" readonly="readonly" />
                                        </div>
                                        <div class="form-group">
                                            <label>Cod materie</label>
                                            <input type="text" name="cod_materie_student" id="cod_materie_student" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Salvare" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profesori" role="tabpanel" aria-labelledby="profesori-tab">
                    <div class="container-fluid">
                        <div class="col-md-12 alert alert-primary">Lista profesori</div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="tabel_profesori">
                                    <thead>
                                        <tr>
                                            <th>Nume de utilizator</th>
                                            <th>Nume</th>
                                            <th>Prenume</th>
                                            <th>Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connect = mysqli_connect("localhost", "root", "", "licenta");

                                        if (mysqli_connect_errno()) {
                                            echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                            exit();
                                        }
                                        if ($result = mysqli_query($connect, "SELECT * FROM useri WHERE rol='1'")) {
                                            if (mysqli_num_rows($result) >= 1) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['username'] ?></td>
                                                        <td><?php echo $row['nume'] ?></td>
                                                        <td><?php echo $row['prenume'] ?></td>
                                                        <td>
                                                            <center>
                                                                <button class="btn btn-sm btn-outline-primary asignare_materie_profesor" data-id="<?php echo $row['username'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#asignare_materie_profesor"><i class="fa fa-plus"></i> Asignare materie</button>
                                                            </center>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        mysqli_close($connect);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="asignare_materie_profesor" role="dialog">
                        <div class="modal-dialog modal-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Asignare materie unui profesor</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <form method="post" id="form_asignare_materie_profesor">
                                    <div class="modal-body">
                                        <div id="mesaj_asignare_materie_profesor"></div>
                                        <div class="form-group">
                                            <label>Nume de utilizator</label>
                                            <input type="text" name="username_profesor" id="username_profesor" class="form-control" readonly="readonly" />
                                        </div>
                                        <div class="form-group">
                                            <label>Cod materie</label>
                                            <input type="text" name="cod_materie_profesor" id="cod_materie_profesor" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Salvare" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                    <section class="vh-100">
                        <div class="container py-5 h-100 w-100">
                            <div class="row d-flex justify-content-center align-items-center h-100 w-100">
                                <div class="col col-lg-6 mb-4 mb-lg-0 h-100 w-100">
                                    <div class="card mb-3 h-100 w-100" style="border-radius: .5rem;">
                                        <div class="row g-0 h-100">
                                            <div class="col-md-4 gradient-custom text-center text-white h-100" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                <img src="<?php echo $_SESSION["poza"]; ?>" alt="Poza" class="rounded-circle img-fluid my-3" style="width: 100px;" />
                                                <h5>
                                                    <?php
                                                    echo $_SESSION["nume"] . " " . $_SESSION["prenume"];
                                                    ?>
                                                </h5>
                                                <p>Administrator</p>
                                                <form action="schimbare_poza.php" method="post">
                                                    <div class="mb-3 mw-100">
                                                        <label for="pozaProfil" class="form-label">Poza de profil</label>
                                                        <input class="form-control form-control-sm" id="pozaProfil" name="pozaProfil" type="file">
                                                    </div>
                                                    <div class="mb-3 mw-100">
                                                        <input type="submit" class="btn btn-primary btn-rounded" value="Schimbare poza" onclick="return alegerePoza()" />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-8 h-100">
                                                <div class="card-body p-4">
                                                    <h6>Informatii cont</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Nume de utilizator</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["username"];
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>E-mail</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["email"];
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style type="text/css">
    .gradient-custom {
        background: #f6d365;
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }
</style>

<script type="text/javascript">
    function alegerePoza() {
        if (document.getElementById("pozaProfil").value == "") {
            alert("Trebuie sa selectati o poza de profil");
            return false;
        }
        return true;
    }
</script>

<script type="text/javascript">
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
        optiuniSpecializare();
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form_adaugare_materie').submit(function(e) {
            e.preventDefault();
            $('#mesaj_materie').html('')

            $.ajax({
                url: 'adaugare_materie.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    alert('Eroare!')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Materie adaugata cu succes!');
                            location.reload()
                        } else {
                            $('#mesaj_materie').html('<div class="alert alert-danger">' + resp.mesaj + '</div>')
                        }
                    }
                }
            })
        })
        $('#form_asignare_materie_student').submit(function(e) {
            e.preventDefault();
            $('#mesaj_asignare_materie_student').html('')

            $.ajax({
                url: 'asignare_materie_student.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    alert('Eroare!')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Materie asignata cu succes!');
                            location.reload()
                        } else {
                            $('#mesaj_asignare_materie_student').html('<div class="alert alert-danger">' + resp.mesaj + '</div>')
                        }
                    }
                }
            })
        })
        $('#form_asignare_materie_profesor').submit(function(e) {
            e.preventDefault();
            $('#mesaj_asignare_materie_profesor').html('')

            $.ajax({
                url: 'asignare_materie_profesor.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    alert('Eroare!')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Materie asignata cu succes!');
                            location.reload()
                        } else {
                            $('#mesaj_asignare_materie_profesor').html('<div class="alert alert-danger">' + resp.mesaj + '</div>')
                        }
                    }
                }
            })
        })
        $('.stergere_materie').click(function() {
            var id = $(this).attr('data-id')
            var conf = confirm('Sunteti sigur ca doriti sa stergeti materia?');
            if (conf == true) {
                $.ajax({
                    url: 'stergere_materie.php?cod_materie=' + id,
                    success: function(resp) {
                        if (resp == true)
                            location.reload()
                    }
                })
            }
        })
        $('.stergere_materie_student').click(function() {
            var id = $(this).attr('data-id')
            var conf = confirm('Sunteti sigur ca doriti sa dezasociati materia studentului?');
            if (conf == true) {
                $.ajax({
                    url: 'stergere_materie_student.php?id_legatura=' + id,
                    success: function(resp) {
                        if (resp == true)
                            location.reload()
                    }
                })
            }
        })
        $('.stergere_materie_profesor').click(function() {
            var id = $(this).attr('data-id')
            var conf = confirm('Sunteti sigur ca doriti sa dezasociati materia profesorului?');
            if (conf == true) {
                $.ajax({
                    url: 'stergere_materie_profesor.php?id_legatura=' + id,
                    success: function(resp) {
                        if (resp == true)
                            location.reload()
                    }
                })
            }
        })
        $('.asignare_materie_student').click(function() {
            var id = $(this).attr('data-id')
            document.getElementById("username_student").value = id;
        })
        $('.asignare_materie_profesor').click(function() {
            var id = $(this).attr('data-id')
            document.getElementById("username_profesor").value = id;
        })
    })
</script>