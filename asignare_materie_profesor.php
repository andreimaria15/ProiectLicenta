<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$username = $_POST['username_profesor'];
$cod_materie = $_POST['cod_materie_profesor'];

if ($result = mysqli_query($connect, "SELECT * FROM materii WHERE cod_materie = '$cod_materie'")) {
    if (mysqli_num_rows($result) == 0) {
        echo json_encode(array('status' => 0, 'mesaj' => 'Materia asignata nu exista!'));
        exit;
    }
}

if ($result = mysqli_query($connect, "SELECT * FROM materii_profesori WHERE username = '$username' AND cod_materie = '$cod_materie'")) {
    if (mysqli_num_rows($result) == 1) {
        echo json_encode(array('status' => 0, 'mesaj' => 'Profesorul are deja materia asignata!'));
        exit;
    }
}

if ($result = mysqli_query($connect, "INSERT INTO materii_profesori VALUES ('$username','$cod_materie')")) {
    echo json_encode(array('status' => 1));
}

mysqli_close($connect);
