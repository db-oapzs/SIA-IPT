<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}

$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];

function archivoExistencia($nombre) {
    $rutaData = '../exelDFLE/unidades/' . $nombre . '.xlsx';
    return file_exists($rutaData);
}

// Ruta donde se guardará la copia del archivo
$nombreArchivo = 'General_'.$nombre_usuario;
$rutaCopiaArchivo = '../exelDFLE/unidades/'.$nombreArchivo.'.xlsx';

if (archivoExistencia($nombreArchivo)) {
    // Establecer las cabeceras para la descarga del archivo
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'. basename($rutaCopiaArchivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($rutaCopiaArchivo));

    // Enviar el contenido del archivo al navegador
    readfile($rutaCopiaArchivo);

    // Redirigir después de enviar el archivo
    header("Location: cargarData.php?status=ArchivoDownload");
    exit();
} else {
    // Redirigir si el archivo no existe
    header("Location: cargarData.php?status=ArchivoNull");
    exit();
}
?>
