<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$id_legatura = $_GET['id_legatura'];
$username = explode(" ", $id_legatura)[0];
$cod_materie = explode(" ", $id_legatura)[1];

if ($result = mysqli_query($connect, "DELETE FROM materii_profesori WHERE username = '$username' AND cod_materie = '$cod_materie'")) {
    echo true;
}

mysqli_close($connect);
