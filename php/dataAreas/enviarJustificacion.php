<?php
include '../conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && isset($_POST["idioma"]) && $_POST['idioma'] != "") {
    echo "<br><h2>Envia la justificacion a la base de datos Formal</h2><br>";
    var_dump($_POST);
    $justificacion = $_POST['Justificación'];
    $nombreArchivo =  'Lenguas con registro COMPARATIVO';
    $idioma = $_POST['idioma'];
    $fecha =  date('d-m-Y H:i:s');
    echo "<br><h2>" . count($_POST) . "</h2>";
    var_dump($justificacion);
    var_dump($idioma);


    //llenado del excel justificaciones
    $queryTemp = '
        INSERT INTO JustificacionesFormato5_9_Temporal (Desc_Justificacion, id_FormatoAutoevaluacion, id_Idioma, Fecha)
        VALUES (?,
        (SELECT ID_FormatoAutoevaluacion FROM FormatosAutoevaluacion WHERE Desc_FormatoAutoevaluacion = ?),
        (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?), ?)
    ';

    $params = array($justificacion,$nombreArchivo,$idioma,$fecha);
    // Preparar la consulta
    $stmt = sqlsrv_prepare($connection, $queryTemp, $params);
    if ($stmt === false) {
        // Manejar el error de la consulta preparada
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            // Manejar el error de la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            echo "<br><h1>datos insertados</h1>";
        }
        // Liberar el conjunto de resultados
        sqlsrv_free_stmt($stmt);
    }
    }else{
        header("Location: status.php?status=IdiomamErr");
        exit();
    }
?>