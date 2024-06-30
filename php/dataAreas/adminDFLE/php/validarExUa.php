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
    $unidad = (string) $_POST['Unidad'];


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
    function buscarEnArreglo($archivos4T, $dato)
    {
        foreach ($archivos4T as $archivo) {
            if (strpos($archivo, $dato) !== false) {
                return $archivo;
            }
        }
        return false;
    }

    $archivoEncontrado = buscarEnArreglo($archivos4T, $unidad);





    function dataUniExcel($connection, $archivos4T, $dato, $stadoQ)
    {
        if ($stadoQ === 1) {
            $queryVerifi = '
            SELECT COALESCE(MAX(CASE WHEN ValidadoAnalista = 1 THEN 1 ELSE 0 END), 0) AS ValidadoAnalista
            FROM [DFLE_Desarrollo].[dbo].[RegistroValidaciones] RV
            JOIN [DFLE_Desarrollo].[dbo].[Unidades_Academicas] UA ON RV.id_UnidadAcademica = UA.ID_UnidadAcademica
            WHERE UA.Desc_Nombre_Unidad_Academica = ?
            AND RV.NombreDelExcel = ?
        ';
        }
        if ($stadoQ === 2) {
            $queryVerifi = '
            SELECT COALESCE(MAX(CASE WHEN [ValidadoJefeAnalistas] = 1 THEN 1 ELSE 0 END), 0) AS ValidadoAnalista
            FROM [DFLE_Desarrollo].[dbo].[RegistroValidaciones] RV
            JOIN [DFLE_Desarrollo].[dbo].[Unidades_Academicas] UA ON RV.id_UnidadAcademica = UA.ID_UnidadAcademica
            WHERE UA.Desc_Nombre_Unidad_Academica = ?
            AND RV.NombreDelExcel = ?;
        ';
        }
        // Parámetros para la consulta
        $params = [$dato, buscarEnArreglo($archivos4T, $dato)];

        // Preparar la consulta
        $stmt = sqlsrv_prepare($connection, $queryVerifi, $params);
        if ($stmt === false) {
            echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
            return '<div class="trabajadoItem gg-close-r"></div>'; // Devolver HTML de error en caso de fallo
        }

        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
            return '<div class="trabajadoItem gg-close-r"></div>'; // Devolver HTML de error en caso de fallo
        }

        // Obtener el resultado de la consulta
        $registroExiste = false; // Inicializar como false por defecto
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $registroExiste = $row['ValidadoAnalista']; // Convertir a booleano
        }

        // Liberar el conjunto de resultaados
        sqlsrv_free_stmt($stmt);

        return $registroExiste;
    }


    //tabla de verdad 
    /*
        00
        01
        10
        11
    */ 
   $dat1 = dataUniExcel($connection, $archivos4T, $unidad,1);
   $dat2 = dataUniExcel($connection, $archivos4T, $unidad,2);

   if($dat1 === 0 && $dat2 === 0 && $roll === 'DII-Analista'){
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

            function daterollAnal($dato)
            {
                switch ($dato) {
                    case 'DII-Analista':
                        return 1;
                    default:
                        return 0;
                }
            }
            function daterollJefeAnal($dato)
            {
                switch ($dato) {
                    case 'DII-Jefe_Analista':
                        return 1;
                    default:
                        return 0;
                }
            }

            $params = array($unidad, $archivoEncontrado, daterollAnal($roll), 0, $nombre_usuario, '', $fechaAcT); // Ajusta según tus necesidades
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
   }else if(($dat1 === 1 && $dat2 === 0) && $roll === 'DII-Jefe_Analista'){
            if ($archivoEncontrado) {
                echo '<br><h2>Archivo encontrado: ' . $archivoEncontrado . '</h2>';

                $queryDataValidacion = '
                    UPDATE RegistroValidaciones 
                    SET NombreJefeAnalista = ?, ValidadoJefeAnalistas = ?
                    WHERE id_UnidadAcademica = (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?) 
                    AND NombreDelExcel = ?
                ';

                function daterollAnal($dato)
                {
                    switch ($dato) {
                        case 'DII-Analista':
                            return 1;
                        default:
                            return 0;
                    }
                }
                function daterollJefeAnal($dato)
                {
                    switch ($dato) {
                        case 'DII-Jefe_Analista':
                            return 1;
                        default:
                            return 0;
                    }
                }

                $params = array($unidad,1, $unidad,buscarEnArreglo($archivos4T, $unidad)); // Ajusta según tus necesidades
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
                        header('Location: excelesVerificacion.php?status=ExcelActualizadoValidado');
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
   }else if($dat1 === 1 && $dat2 === 1){
        echo '<br>No se puede bajar el archivo.<h2>';
        header('Location: excelesVerificacion.php?status=ExcelYaValidado');
        exit();
   }else{
        echo '<br>No se puede bajar el archivo.<h2>';
        header('Location: excelesVerificacion.php?status=NoExcelnoUser');
        exit();
   }
} else {
    echo '<br><h2>No se envió data</h2>';
    header('Location: excelesVerificacion.php?status=ErrorValidar');
    exit();
}
?>