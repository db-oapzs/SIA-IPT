<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../../../html/login.php?status=sessionCad");
    exit();
}
$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$roll = $_SESSION['roll'];

if (!empty($_POST) && isset($_POST['Unidad'])) {
    $fechaAcT = date('Y-m-d H:i:s');
    $unidad = (string)$_POST['Unidad'];

    // Directorio de archivos
    $ficheroArchivos = '../../../exelDFLE/unidades';

    // Verificar si el directorio existe
    if (!is_dir($ficheroArchivos)) {
        die("El directorio no existe.");
    }

    // Arrays para clasificar los archivos
    $archivos4T = [];

    // Abrir el directorio
    if ($handle = opendir($ficheroArchivos)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if (strpos($entry, "4 DFLE_") !== false) {
                    $archivos4T[] = $entry;
                }
            }
        }
        closedir($handle);
    } else {
        die("No se pudo abrir el directorio.");
    }

    // Función para buscar en el arreglo y devolver el nombre del archivo
    function buscarEnArreglo($archivos4T, $dato) {
        foreach ($archivos4T as $archivo) {
            if (strpos($archivo, $dato) !== false) {
                return $archivo;
            }
        }
        return false;
    }

    $archivoEncontrado = buscarEnArreglo($archivos4T, $unidad);

    if ($archivoEncontrado) {
        echo '<br><h2>Archivo encontrado: ' . $archivoEncontrado . '</h2>';

        $queryDataValidacion = '
            INSERT INTO RegistroValidaciones
            (id_UnidadAcademica, NombreDelExcel, ValidadoAnalista, ValidadoJefeAnalistas, NombreAnalista, NombreJefeAnalista, Fecha)
            VALUES (
                (SELECT ID_UnidadAcademica 
                FROM Unidades_Academicas 
                WHERE Desc_Nombre_Unidad_Academica = ?),
                ?, 
                ?, 
                ?, 
                ?, 
                ?, 
                ?
            )
        '; 

        function daterollAnal($dato) {
            switch ($dato) {
                case 'DII-Analista':
                    return 1;
                default:
                    return 0;
            }
        }
        function daterollJefeAnal($dato) {
            switch ($dato) {
                case 'DII-Jefe_Analista':
                    return 1;
                default:
                    return 0;
            }
        }

        $params = array($unidad, $archivoEncontrado, daterollAnal($roll),daterollJefeAnal($roll), $nombre_usuario, '', $fechaAcT); // Ajusta según tus necesidades
        // Preparar la consulta
        $stmt = sqlsrv_prepare($connection, $queryDataValidacion, $params);
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
                echo "<br><h1>Datos insertados</h1>";
                header('Location: excelesVerificacion.php?status=ExcelValidado');
                exit();
            }
            // Liberar el conjunto de resultados
            sqlsrv_free_stmt($stmt);
        }
    } else {
        echo '<br>No se puede bajar el archivo.<h2>';
        header('Location: excelesVerificacion.php?status=ExcelNoEncontrado');
        exit();
    }
} else {
    echo '<br><h2>No se envió data</h2>';
    header('Location: excelesVerificacion.php?status=ErrorValidar');
    exit();
}
?>
