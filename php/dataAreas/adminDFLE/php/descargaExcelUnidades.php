<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $directory = '../../../exelDFLE/unidades';
    
    if (!is_dir($directory)) {
        die("el directorio no es correcto.");
    }
    
    if (!class_exists('ZipArchive')) {
        die("ZipArchive no activada");
    }
    
    $zip = new ZipArchive();
    $zipFileName = 'DFLE Unidades.zip';
    
    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        foreach ($_POST['archivosUnidades'] as $file) {
            if (file_exists($directory . '/' . $file)) {
                $zip->addFile($directory . '/' . $file, $file);
            } else {
                echo "Archivo No Encontrado: $file<br>";
            }
        }
        
        $zip->close();
        
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$zipFileName");
        readfile($zipFileName);
        unlink($zipFileName);
        
        exit;
    } else {
        echo "Error al crear el Zip con los Archivos";
    }
}else{
    header("Location: DescargaFormatos.php?status=ArchivosFallU");
    exit();
}
?>
