<?php
session_start();
?>
<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}
$cod_test = $_GET["cod_test"];
$test = mysqli_query($connect, "SELECT * FROM teste WHERE cod_test='$cod_test'");
$test = mysqli_fetch_array($test);
$prezentare = mysqli_query($connect, "SELECT * FROM prezentari WHERE cod_test = '" . $cod_test . "' AND username = '" . $_SESSION['username'] . "'");
$prezentare = mysqli_fetch_array($prezentare);
?>

<html lang="en">

<head>
    <title>HomeLearning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        li.raspuns input:checked {
            background: #00c4ff3d;
        }
    </style>
</head>

<body class="bg-info">
    <div class="w-50 mx-auto my-4 p-4 card container">
        <div class="container-fluid">
            <div class="text-center">
                <a class="btn btn-outline-info" href="student.php" role="button">Inapoi la pagina principala</a>
            </div>
            <br>
            <div class="col-md-12 alert alert-primary"><?php echo $test['denumire'] ?></div>
            <br>
            <?php
            if ((10 * $prezentare['scor'] / $prezentare['scor_total']) >= 5)
                echo '<div class="col-md-12 alert alert-success"> Nota: ' . (10 * $prezentare['scor'] / $prezentare['scor_total']) . '</div>';
            else
                echo '<div class="col-md-12 alert alert-danger"> Nota: ' . (10 * $prezentare['scor'] / $prezentare['scor_total']) . '</div>';
            ?>
            <br>
            <div class="card">
                <div class="card-body">
                    <?php
                    $intrebare = mysqli_query($connect, "SELECT * FROM intrebari where cod_test = '" . $cod_test . "'");
                    $i = 1;
                    while ($row = mysqli_fetch_array($intrebare)) {
                        $optiune = mysqli_query($connect, "SELECT * FROM optiuni where cod_intrebare = '" . $row['cod_intrebare'] . "' ORDER BY RAND()");
                        $raspuns = mysqli_query($connect, "SELECT * FROM raspunsuri where cod_test = '" . $cod_test . "' AND username = '" . $_SESSION['username'] . "' AND cod_intrebare = '" . $row['cod_intrebare'] . "'");
                        $raspuns = mysqli_fetch_array($raspuns);
                    ?>
                        <ul class="q-items list-group mt-4 mb-4">
                            <li class="q-field list-group-item">
                                <strong><?php echo ($i++) . '. '; ?> <?php echo $row['intrebare'] ?></strong>
                                <br>
                                <ul class='list-group mt-4 mb-4'>
                                    <?php while ($opt_row = mysqli_fetch_assoc($optiune)) { ?>
                                        <li class="raspuns list-group-item
                                            <?php
                                            if (($raspuns['cod_optiune'] == $opt_row['cod_optiune']) && $raspuns['corect'] == 1) {
                                                echo "bg-success";
                                            } else {
                                                if ($opt_row['corect'] == 1) {
                                                    echo "bg-success";
                                                } else {
                                                    echo "bg-danger";
                                                }
                                            }
                                            ?>">
                                            <label><input type="radio" name="cod_optiune[<?php echo $row['cod_intrebare'] ?>]" value="<?php echo $opt_row['cod_optiune'] ?>" <?php echo $raspuns['cod_optiune'] == $opt_row['cod_optiune']  ? "checked='checked'" : "" ?>> <?php echo $opt_row['optiune'] ?></label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('input').attr('readonly', true)
    })
</script>