<?php
if (!empty($_POST) && isset($_POST['Unidad'])) {
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
        // Descargar el archivo
        $filePath = $ficheroArchivos . '/' . $archivoEncontrado;
        if (file_exists($filePath)) {
            // Asegurarse de que no se envíe ningún contenido antes de los encabezados
            if (ob_get_length()) {
                ob_end_clean();
            }

            // Obtener la extensión del archivo
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            $contentType = 'application/octet-stream';

            // Determinar el tipo de contenido basado en la extensión del archivo
            switch ($fileExtension) {
                case 'xls':
                    $contentType = 'application/vnd.ms-excel';
                    break;
                case 'xlsx':
                    $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                    break;
                // Añadir otros tipos de archivos según sea necesario
            }

            // Enviar encabezados de descarga
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $contentType);
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo '<br>No se puede bajar el archivo, no se encuentra en el servidor.<h2>';
        }
    } else {
        echo '<br>No se puede bajar el archivo.<h2>';
        header('Location: excelesVerificacion.php?status=ExcelNoEncontrado');
        exit();
    }
} else {
    echo '<br><h2>No se envió data</h2>';
}
?>
