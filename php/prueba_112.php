<?php
require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar opciones de DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Permite cargar contenido remoto (como imágenes y CSS externos)

// Crear una instancia de DOMPDF
$dompdf = new Dompdf($options);

// Cargar el contenido HTML desde un archivo
$html = file_get_contents('../html/copia.php');

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// (Opcional) Configurar el tamaño del papel y la orientación
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF directamente al navegador para que se descargue
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="documento.pdf"');
echo $dompdf->output();
?>
