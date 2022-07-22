<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$cod_materie = $_GET['cod_materie'];

if ($result = mysqli_query($connect, "DELETE FROM materii WHERE cod_materie=$cod_materie")) {
    if ($result = mysqli_query($connect, "DELETE FROM materii_studenti WHERE cod_materie=$cod_materie")) {
        if ($result = mysqli_query($connect, "DELETE FROM materii_profesori WHERE cod_materie=$cod_materie")) {
            echo true;
        }
    }
}

mysqli_close($connect);
