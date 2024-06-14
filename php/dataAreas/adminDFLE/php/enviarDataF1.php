<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectNivelA"]) && isset($_POST["selectNivelA"]) && $_POST['selectNivelA'] != "") {
    echo "<br><h2>Envia a la base de datos Formal</h2><br>";
    var_dump($_POST);
    $nombreArchivo =  'UNIDADES ACADÉMICAS QUE CUENTAN CON CELEX Y SUPERVISADAS';
    $fecha = date('d-m-Y H:i:s');
    echo "<br><h2>" . count($_POST) . "</h2>";
    $dataSeparada = array();

    foreach ($_POST as $key => $value) {
        $newKey = str_replace("Trim", "-", $key);
        $dataSeparada[$newKey] = $value;
    }

    var_dump($dataSeparada);
} else {
    header("Location: formato1.php?status=Ni");
    exit();
}
?>
