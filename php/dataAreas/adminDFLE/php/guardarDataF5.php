<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Justificacion"]) && isset($_POST["idioma"]) && $_POST['idioma'] != "") {
    echo "<br><h2>Envia la justificacion a la base de datos temporal</h2><br>";
    var_dump($_POST);
    $justificacion = $_POST['Justificacion']; // Correct key
    $nombreArchivo =  'LENGUAS  CON  REGISTRO COMPARATIVO';
    $idioma = $_POST['idioma'];
    $fecha = date('d-m-Y H:i:s');
    echo "<br><h2>" . count($_POST) . "</h2>";
    var_dump($justificacion);
    var_dump($idioma);

    // Function to save content in a specific cell of a sheet
    function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $hoja) {
        $spreadsheet->getSheet($hoja)->setCellValue($celda, $contenido);
    }

    // Function to check if a file exists
    function archivoExistencia($nombre) {
        $rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
        return file_exists($rutaData);
    }

    // Function to get cell row based on language
    function ObtenerCeldaIdioma($rango, $idioma, $hoja) {
        $celdas = $hoja->rangeToArray($rango, null, true, true, true);

        // Iterate over each cell in the range
        foreach ($celdas as $fila => $columnas) {
            foreach ($columnas as $columna => $valor) {
                // Check if the cell value matches the searched language
                if (strcasecmp($valor, $idioma) === 0) {
                    // If matched, return the row number
                    return $fila;
                }
            }
        }

        // If the language is not found, return an error message
        return "No se encontró el idioma en el rango de celdas especificado";
    }

    // Insert justification into the database
    $queryTemp = '
        INSERT INTO JustificacionesFormato5_9 (Desc_Justificacion, id_FormatoAutoevaluacion, id_Idioma, Fecha)
        VALUES (?, 
        (SELECT ID_FormatoAutoevaluacion FROM FormatosAutoevaluacion WHERE Desc_FormatoAutoevaluacion = ?),
        (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?), ?)
    ';

    $params = array($justificacion, $nombreArchivo, $idioma, $fecha);
    $stmt = sqlsrv_prepare($connection, $queryTemp, $params);

    if ($stmt === false) {
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            echo "<br><h1>datos insertados</h1>";
        }
        sqlsrv_free_stmt($stmt);

    }
} else {
    header("Location: archivoF5Justificacion.php?status=IdiomamErr");
    exit();
}
?>
