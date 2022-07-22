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
$result = mysqli_query($connect, "SELECT * FROM teste WHERE cod_test='$cod_test' ORDER BY RAND()");
$result = mysqli_fetch_array($result);
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
        li.raspuns {
            cursor: pointer;
        }

        li.raspuns:hover {
            background: #00c4ff3d;
        }

        li.raspuns input:checked {
            background: #00c4ff3d;
        }
    </style>
</head>

<body class="bg-info">
    <div class="w-50 mx-auto my-4 p-4 card container">
        <div class="container-fluid">
            <div class="col-md-12 alert alert-primary"><?php echo $result['denumire'] ?></div>
            <br>
            <div class="col-md-12 alert alert-primary"><?php echo 'Fiecare intrebare valoreaza ' . $result['puncte_intrebare'] . ' puncte' ?></div>
            <br>
            <div class="card">
                <div class="card-body">
                    <form method="post" id="form_submit_test">
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                        <input type="hidden" name="cod_test" value="<?php echo $cod_test ?>">
                        <input type="hidden" name="puncte_intrebare" value="<?php echo $result['puncte_intrebare'] ?>">
                        <?php
                        $intrebare = mysqli_query($connect, "SELECT * FROM intrebari where cod_test = '" . $cod_test . "'");
                        $i = 1;
                        while ($row = mysqli_fetch_array($intrebare)) {
                            $optiune = mysqli_query($connect, "SELECT * FROM optiuni where cod_intrebare = '" . $row['cod_intrebare'] . "' ORDER BY RAND()");
                        ?>
                            <ul class="q-items list-group mt-4 mb-4">
                                <li class="q-field list-group-item">
                                    <strong><?php echo ($i++) . '. '; ?> <?php echo $row['intrebare'] ?></strong>
                                    <input type="hidden" name="cod_intrebare[<?php echo $row['cod_intrebare'] ?>]" value="<?php echo $row['cod_intrebare'] ?>">
                                    <br>
                                    <ul class='list-group mt-4 mb-4'>
                                        <?php while ($opt_row = mysqli_fetch_assoc($optiune)) { ?>
                                            <li class="raspuns list-group-item">
                                                <label><input type="radio" name="cod_optiune[<?php echo $row['cod_intrebare'] ?>]" value="<?php echo $opt_row['cod_optiune'] ?>"> <?php echo $opt_row['optiune'] ?></label>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                            </ul>
                        <?php } ?>
                        <input type="submit" class="btn btn-block btn-primary" value="Submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('.raspuns').each(function() {
            $(this).click(function() {
                $(this).find('input[type="radio"]').prop('checked', true)
                $(this).css('background', '#00c4ff3d')
                $(this).siblings('li').css('background', 'white')
            })
        })
        $('#form_submit_test').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'submit_test.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    alert('Eroare!')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Test finalizat! Ai obtinut ' + resp.scor + " puncte din maximul de " + resp.total);
                            location.replace('vizualizare_rezultat.php?cod_test=<?php echo $cod_test ?>')
                        }
                    }
                }
            })
        })
    })
</script>