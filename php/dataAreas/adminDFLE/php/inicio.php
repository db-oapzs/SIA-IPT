<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$queryUsers = '
    SELECT 
        nu.Desc_Nombre_Usuario,
        ch.Desc_Contrasena_Hash,
        eb.Desc_Estatus_Bloqueo,
        ed.Desc_Estatus_Deshabilitado,
        ua.Desc_Nombre_Unidad_Academica,
        c.Desc_Cargo,
        nt.Desc_Numero_Telefono,
        r.Desc_Rol,
        dc.Desc_Correo_Electronico
    FROM 
        Usuarios_General ug
    LEFT JOIN 
        Nombre_Usuarios nu ON ug.id_NombreUsuario = nu.ID_NombreUsuario
    LEFT JOIN 
        Contrasena_Hash ch ON ug.id_ContrasenaHash = ch.ID_ContrasenaHash
    LEFT JOIN 
        Estatus_Bloqueado eb ON ug.id_EstatusBloqueo = eb.ID_EstatusBloqueo
    LEFT JOIN 
        Estatus_Deshabilitado ed ON ug.id_EstatusDeshabilitado = ed.ID_EstatusDeshabilitado
    LEFT JOIN 
        Unidades_Academicas ua ON ug.id_UnidadAcademica = ua.ID_UnidadAcademica
    LEFT JOIN 
        Cargos c ON ug.id_Cargo = c.ID_Cargo
    LEFT JOIN 
        Numero_Telefono nt ON ug.id_NumeroTelefono = nt.ID_NumeroTelefono
    LEFT JOIN 
        Rol_Dentro_Del_Sistema r ON ug.id_Rol = r.ID_Rol
    LEFT JOIN 
        Correo_Electronico dc ON ug.id_CorreoElectronico = dc.ID_CorreoElectronico
        ';

// Preparar la consulta
$stmt = sqlsrv_prepare($connection, $queryUsers);
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
        // Mostrar los resultados
        $statusEnvio = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $statusEnvio[] = $row;
        }
        var_dump($statusEnvio);
    }
    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);
}
include 'menu.php';
?>
