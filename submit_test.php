<?php
$connect = mysqli_connect("localhost", "root", "", "licenta");

if (mysqli_connect_errno()) {
    echo "Eroare la conectarea cu serverul MySQL: " . mysqli_connect_error();
    exit();
}

extract($_POST);

$intrebari_corecte = 0;
foreach ($cod_intrebare as $cod => $value) {
    $query_adaugare_raspuns = " username = '" . $username;
    $query_adaugare_raspuns .= "', cod_test = '" . $cod_test;
    $query_adaugare_raspuns .= "', cod_intrebare = '" . $cod_intrebare[$cod] . "' ";
    $corect = 0;
    if (isset($cod_optiune[$cod])) {
        $query_adaugare_raspuns .= ", cod_optiune = '" . $cod_optiune[$cod] . "' ";
        $optiuni = $connect->query("SELECT * FROM optiuni where cod_optiune = '" . $cod_optiune[$cod] . "'");
        $optiune = $optiuni->fetch_assoc();
        $corect = $optiune["corect"];
    }
    $query_adaugare_raspuns .= ", corect = '" . $corect . "' ";
    $adaugare_raspuns = $connect->query("INSERT INTO raspunsuri SET " . $query_adaugare_raspuns);
    if ($adaugare_raspuns && $corect > 0)
        $intrebari_corecte = $intrebari_corecte + 1;
}
$scor = $intrebari_corecte * $puncte_intrebare;
$scor_total = count($cod_intrebare) * $puncte_intrebare;
$query_adaugare_prezentare = " cod_test = '" . $cod_test;
$query_adaugare_prezentare .= "', username = '" . $username;
$query_adaugare_prezentare .= "', scor = '" . $scor;
$query_adaugare_prezentare .= "', scor_total = '" . $scor_total . "'";
$adaugare_prezentare = $connect->query("INSERT INTO prezentari SET " . $query_adaugare_prezentare);
if ($adaugare_prezentare)
    echo json_encode(array("status" => 1, "scor" => $scor, "total" => $scor_total));

mysqli_close($connect);
