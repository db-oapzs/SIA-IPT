<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}
$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
    var_dump($_POST);
    $datos = $_POST;
    $dataPOST = array();
    foreach ($datos as $key => $value) {
        // Verificar si el nombre del campo no comienza con "T" y no contiene la palabra "total"
        if (substr($key, 0, 1) !== "T" && strpos($key, "total") === false) {
            // Guardar el nombre del campo y su valor (o un espacio si el valor está vacío)
            $dataPOST[$key] = $value !== "" ? $value : " ";
        }
    }
    $fechaCreacion = date('d-m-Y H:i:s');
    // Mostrar el arreglo resultante
    echo "<br>";
    var_dump($dataPOST);
    echo "<br><h2>" . count($dataPOST) . "</h2>";
}
?>
