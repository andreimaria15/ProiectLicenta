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
                    <a href="student.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">HomeLearning</span>
                    </a>
                    <div class="nav nav-pills flex-column mb-sm-auto mb-0 me-3 align-items-center align-items-sm-start" id="menu" role="tablist" aria-orientation="vertical">
                        <button class="nav-link" id="materii-tab" data-bs-toggle="pill" data-bs-target="#materii" type="button" role="tab" aria-controls="materii" aria-selected="false">Materii</button>
                        <button class="nav-link" id="teste-tab" data-bs-toggle="pill" data-bs-target="#teste" type="button" role="tab" aria-controls="teste" aria-selected="false">Lista teste</button>
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
                <div class="tab-pane fade" id="materii" role="tabpanel" aria-labelledby="materii-tab">
                    <div class="container-fluid">
                        <div class="col-md-12 alert alert-primary">Lista materii student</div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connect = mysqli_connect("localhost", "root", "", "licenta");

                                        if (mysqli_connect_errno()) {
                                            echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
                                            exit();
                                        }
                                        $username = $_SESSION["username"];
                                        if ($result = mysqli_query($connect, "SELECT materii.* FROM materii, materii_studenti WHERE materii_studenti.username='$username' AND materii.cod_materie=materii_studenti.cod_materie")) {
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
                <div class="tab-pane fade" id="teste" role="tabpanel" aria-labelledby="teste-tab">
                    <div class="container-fluid">
                        <div class="col-md-12 alert alert-primary">Lista teste</div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="tabel_teste">
                                    <thead>
                                        <tr>
                                            <th>Cod</th>
                                            <th>Test</th>
                                            <th>Cod materie</th>
                                            <th>Nota</th>
                                            <th>Status</th>
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
                                        if ($result = mysqli_query($connect, "SELECT teste.* FROM teste, materii_studenti WHERE materii_studenti.username='$username' AND teste.cod_materie=materii_studenti.cod_materie")) {
                                            if (mysqli_num_rows($result) >= 1) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $status = mysqli_query($connect, "SELECT * FROM prezentari WHERE cod_test='" . $row['cod_test'] . "'" . " AND username='" . $username . "'");
                                                    $prezentare = mysqli_fetch_assoc($status);
                                        ?>
                                                    <tr>
                                                        <td><?php echo $row['cod_test'] ?></td>
                                                        <td><?php echo $row['denumire'] ?></td>
                                                        <td><?php echo $row['cod_materie'] ?></td>
                                                        <td><?php echo $status->num_rows > 0 ? 10 * $prezentare['scor'] / $prezentare['scor_total'] : '' ?></td>
                                                        <td><?php
                                                            if ($status->num_rows > 0)
                                                                echo (10 * $prezentare['scor'] / $prezentare['scor_total']) >= 5 ? 'Promovat' : 'Nepromovat'
                                                            ?></td>
                                                        <td>
                                                            <center>
                                                                <?php if ($status->num_rows <= 0) : ?>
                                                                    <a class="btn btn-sm btn-outline-primary" href="parcurgere_test.php?cod_test=<?php echo $row['cod_test'] ?>">Incepere test</a>
                                                                <?php else : ?>
                                                                    <a class="btn btn-sm btn-outline-primary" href="vizualizare_rezultat.php?cod_test=<?php echo $row['cod_test'] ?>">Vizualizare rezultat</a>
                                                                <?php endif; ?>
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
                                                <p>Student</p>
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
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Numar matricol</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["nr_matricol"];
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>Facultate</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["facultate"];
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Specializare</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["specializare"];
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>An de studiu</h6>
                                                            <p class="text-muted">
                                                                <?php
                                                                echo $_SESSION["an_studiu"];
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
    $(document).ready(function() {

    })
</script>