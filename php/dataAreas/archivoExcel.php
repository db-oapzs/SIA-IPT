<?php
// Ruta del archivo original
$rutaArchivoOriginal = '../exelDFLE/plnatilla/General.xlsx';
$unidad = 'SIA';
// Ruta donde se guardará la copia del archivo
$rutaCopiaArchivo = '../exelDFLE/unidades/General'.$unidad.'.xlsx';

// Copiar el archivo original a la nueva ubicación
if (copy($rutaArchivoOriginal, $rutaCopiaArchivo)) {
    echo 'Copia del archivo creada exitosamente.';
} else {
    echo 'Error al crear la copia del archivo.';
}
?>
