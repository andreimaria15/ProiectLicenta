<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}
$cod_test = $_GET["cod_test"];
$result = mysqli_query($connect, "SELECT * FROM teste WHERE cod_test='$cod_test'");
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
</head>

<body class="bg-info">
    <div class="w-50 mx-auto my-4 p-4 card container">
        <div class="container-fluid">
            <div class="text-center">
                <a class="btn btn-outline-info" href="profesor.php" role="button">Inapoi la pagina principala</a>
            </div>
            <br>
            <div class="col-md-12 alert alert-primary"><?php echo $result['denumire'] ?></div>
            <button type="button" class="btn btn-primary bt-sm" data-bs-toggle="modal" data-bs-target="#adaugare_intrebare">Adaugare intrebare</button>
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    Intrebari
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $result = mysqli_query($connect, "SELECT * FROM intrebari WHERE cod_test='$cod_test'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <li class="list-group-item"><?php echo $row['intrebare'] ?>
                                <br>
                                <center>
                                    <button class="btn btn-sm btn-outline-danger stergere_intrebare" data-id="<?php echo $row['cod_intrebare'] ?>" type="button">Stergere</button>
                                </center>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="adaugare_intrebare" role="dialog">
            <div class="modal-dialog modal-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Adaugare intrebare</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" id="form_adaugare_intrebare">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Intrebare</label>
                                <input type="hidden" name="cod_test" value="<?php echo $cod_test ?>" />
                                <textarea rows='3' name="intrebare" required class="form-control"></textarea>
                            </div>

                            <label>Optiuni</label>
                            <div class="form-group">
                                <textarea rows="1" name="text_optiune1" required class="form-control"></textarea>
                                <span>
                                    <label><input type="radio" name="optiune" value="optiune1" checked="checked" /> <small>Raspuns corect</small></label>
                                </span>
                                <br>
                                <textarea rows="1" name="text_optiune2" required class="form-control"></textarea>
                                <label><input type="radio" name="optiune" value="optiune2" /> <small>Raspuns corect</small></label>
                                <br>
                                <textarea rows="1" name="text_optiune3" required class="form-control"></textarea>
                                <label><input type="radio" name="optiune" value="optiune3" /> <small>Raspuns corect</small></label>
                                <br>
                                <textarea rows="1" name="text_optiune4" required class="form-control"></textarea>
                                <label><input type="radio" name="optiune" value="optiune4" /> <small>Raspuns corect</small></label>
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
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form_adaugare_intrebare').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'adaugare_intrebare.php',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    alert('Eroare!')
                },
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            alert('Intrebare adaugata cu succes!');
                            location.reload()
                        }
                    }
                }
            })
        })
        $('.stergere_intrebare').click(function() {
            var id = $(this).attr('data-id')
            var conf = confirm('Sunteti sigur ca doriti sa stergeti intrebarea?');
            if (conf == true) {
                $.ajax({
                    url: 'stergere_intrebare.php?cod_intrebare=' + id,
                    success: function(resp) {
                        if (resp == true)
                            location.reload()
                    }
                })
            }
        })
    })
</script>