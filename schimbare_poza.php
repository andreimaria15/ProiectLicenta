<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$pozaProfil = $_POST["pozaProfil"];
$username = $_SESSION["username"];
$rol = $_SESSION["rol"];
$pozaProfil = "poze/" . $pozaProfil;
if ($result = mysqli_query($connect, "UPDATE useri SET poza_profil='$pozaProfil' WHERE username='$username'")) {
    $_SESSION["poza"] = $pozaProfil;
    if ($rol == '2') {
        header("Location: admin.php");
    } else {
        if ($rol == '1') {
            header("Location: profesor.php");
        } else {
            if ($rol == '0') {
                header("Location: student.php");
            }
        }
    }
}

mysqli_close($connect);
