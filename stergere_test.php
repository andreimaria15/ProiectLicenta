<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$cod_test = $_GET['cod_test'];

if ($result = mysqli_query($connect, "SELECT cod_intrebare FROM intrebari WHERE cod_test=$cod_test")) {
    while ($row = mysqli_fetch_array($result)) {
        mysqli_query($connect, "DELETE FROM optiuni WHERE cod_intrebare=" . $row['cod_intrebare']);
    }
    if ($result = mysqli_query($connect, "DELETE FROM intrebari WHERE cod_test=$cod_test")) {
        if ($result = mysqli_query($connect, "DELETE FROM teste WHERE cod_test=$cod_test")) {
            echo true;
        }
    }
}

mysqli_close($connect);
