<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

if ($result = mysqli_query($connect, "SELECT * FROM useri WHERE (username='" . $_POST['idAutentificare'] . "'
 OR email='" . $_POST['idAutentificare'] . "') AND (parola='" . $_POST['parolaAutentificare'] . "')")) {
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_row($result);
        $username = $row[0];
        $email = $row[1];
        $nume = $row[3];
        $prenume = $row[4];
        $rol = $row[5];
        $poza = $row[6];
        if ($rol == '2') {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["nume"] = $nume;
            $_SESSION["prenume"] = $prenume;
            $_SESSION["rol"] = $rol;
            $_SESSION["poza"] = $poza;
            header("Location: admin.php");
        } else {
            if ($rol == '1') {
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email;
                $_SESSION["nume"] = $nume;
                $_SESSION["prenume"] = $prenume;
                $_SESSION["rol"] = $rol;
                $_SESSION["poza"] = $poza;
                header("Location: profesor.php");
            } else {
                if ($rol == '0') {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email;
                    $_SESSION["nume"] = $nume;
                    $_SESSION["prenume"] = $prenume;
                    $_SESSION["rol"] = $rol;
                    $_SESSION["poza"] = $poza;
                    $date_student = mysqli_query($connect, "SELECT * FROM studenti WHERE email = '$email'");
                    $date_student = mysqli_fetch_array($date_student);
                    $_SESSION["nr_matricol"] = $date_student['nr_matricol'];
                    $_SESSION["facultate"] = $date_student['facultate'];
                    $_SESSION["specializare"] = $date_student['specializare'];
                    $_SESSION["an_studiu"] = $date_student['an_studiu'];
                    header("Location: student.php");
                }
            }
        }
    } else {
        header("Location: index.php?eroare=Autentificare nereusita");
    }
}

mysqli_close($connect);
