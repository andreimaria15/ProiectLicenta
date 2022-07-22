<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$denumire = $_POST['denumire'];
$puncte_intrebare = $_POST['puncte_intrebare'];
$cod_materie = $_POST['cod_materie'];

if ($result = mysqli_query($connect, "INSERT INTO teste VALUES (NULL,'$denumire', '$puncte_intrebare', '$cod_materie')")) {
    echo true;
}

mysqli_close($connect);
