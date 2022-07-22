<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$cod_intrebare = $_GET['cod_intrebare'];

if ($result = mysqli_query($connect, "DELETE FROM intrebari WHERE cod_intrebare=$cod_intrebare")) {
    if ($result = mysqli_query($connect, "DELETE FROM optiuni WHERE cod_intrebare=$cod_intrebare")) {
        echo true;
    }
}

mysqli_close($connect);
