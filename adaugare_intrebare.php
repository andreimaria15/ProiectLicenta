<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$cod_test = $_POST['cod_test'];
$intrebare = $_POST['intrebare'];
$text_optiune1 = $_POST['text_optiune1'];
$text_optiune2 = $_POST['text_optiune2'];
$text_optiune3 = $_POST['text_optiune3'];
$text_optiune4 = $_POST['text_optiune4'];
$optiune = $_POST['optiune'];

if ($result = mysqli_query($connect, "INSERT INTO intrebari VALUES (NULL, '$intrebare', '$cod_test')")) {
    if ($result = mysqli_query($connect, "SELECT MAX(cod_intrebare) AS ult_intrebare FROM intrebari")) {
        $row = mysqli_fetch_array($result);
        $cod_intrebare = $row['ult_intrebare'];
        if ($optiune == 'optiune1') {
            $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune1', '1', '$cod_intrebare')");
            $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune2', '', '$cod_intrebare')");
            $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune3', '', '$cod_intrebare')");
            $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune4', '', '$cod_intrebare')");
            echo json_encode(array('status' => 1));
        } else {
            if ($optiune == 'optiune2') {
                $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune1', '', '$cod_intrebare')");
                $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune2', '1', '$cod_intrebare')");
                $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune3', '', '$cod_intrebare')");
                $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune4', '', '$cod_intrebare')");
                echo json_encode(array('status' => 1));
            } else {
                if ($optiune == 'optiune3') {
                    $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune1', '', '$cod_intrebare')");
                    $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune2', '', '$cod_intrebare')");
                    $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune3', '1', '$cod_intrebare')");
                    $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune4', '', '$cod_intrebare')");
                    echo json_encode(array('status' => 1));
                } else {
                    if ($optiune == 'optiune4') {
                        $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune1', '', '$cod_intrebare')");
                        $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune2', '', '$cod_intrebare')");
                        $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune3', '', '$cod_intrebare')");
                        $result = mysqli_query($connect, "INSERT INTO optiuni VALUES (NULL, '$text_optiune4', '1', '$cod_intrebare')");
                        echo json_encode(array('status' => 1));
                    }
                }
            }
        }
    }
}

mysqli_close($connect);
