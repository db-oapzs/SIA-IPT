<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}

$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];

// Directorio de archivos
$ficheroArchivos = '../exelDFLE/unidades';

// Verificar si el directorio existe
if (!is_dir($ficheroArchivos)) {
    die("El directorio no existe.");
}

// Año actual
$anio = (string)date('Y');

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

// Buscar archivo específico
$mes = date('n');
$numTrimestre = match (true) {
    $mes <= 3 => 1,
    $mes <= 6 => 2,
    $mes <= 9 => 3,
    $mes <= 12 => 4,
    default => "Mes inválido"
};
$nombreArchivoBuscado = '4 DFLE_' . $numTrimestre . 'T_' . $anio . ' ' . $nombre_usuario . '.xlsx';

if (in_array($nombreArchivoBuscado, $archivos4T)) {
    $rutaArchivo = $ficheroArchivos . '/' . $nombreArchivoBuscado;

    // Establecer las cabeceras para la descarga del archivo
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. basename($rutaArchivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($rutaArchivo));

    // Enviar el contenido del archivo al navegador
    readfile($rutaArchivo);

    // Añadir script para redirigir después de la descarga
    echo '<script type="text/javascript">window.location.href = "cargarData.php?status=ArchivoDescargado";</script>';
    exit();
} else {
    // Redirigir si el archivo no existe
    header("Location: cargarData.php?status=ArchivoNull");
    exit();
}
?>
