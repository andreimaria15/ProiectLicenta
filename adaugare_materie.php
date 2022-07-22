<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

$denumire = $_POST['denumire'];
$facultate = $_POST['facultate'];
$specializare = $_POST['specializare'];
$an_studiu = $_POST['an_studiu'];
$semestru = $_POST['semestru'];

if ($result = mysqli_query($connect, "SELECT * FROM materii WHERE TRIM(LOWER(denumire))=TRIM(LOWER('$denumire')) 
          AND TRIM(LOWER(facultate))=LOWER('$facultate') AND TRIM(LOWER(specializare))=LOWER('$specializare') 
           AND an_studiu='$an_studiu' AND semestru='$semestru'")) {
    if (mysqli_num_rows($result) == 1) {
        echo json_encode(array('status' => 0, 'mesaj' => 'Materia exista deja!'));
        exit;
    }
}

if ($result = mysqli_query($connect, "INSERT INTO materii VALUES (NULL, '$denumire', 
    '$facultate','$specializare','$an_studiu','$semestru')")) {
    echo json_encode(array('status' => 1));
}

mysqli_close($connect);
