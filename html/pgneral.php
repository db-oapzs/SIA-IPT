<?php
include '../php/conexion.php';

$queryPerfilUser = '
    SELECT 
        CE.Desc_Correo_Electronico, RD.Desc_Rol
    FROM Usuarios_General UG
    JOIN Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
    JOIN Rol_Dentro_Del_Sistema RD ON UG.id_Rol = RD.ID_Rol
    WHERE CE.Desc_Correo_Electronico = ?
';

$correo = 'oscar.a.p.solano@gmail.com';
$params = array($correo);
$dato = '';

$stmt = sqlsrv_prepare($connection, $queryPerfilUser, $params);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
    } else {
        // Mostrar los resultados
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $dato = $row['Desc_Rol'];
        }
    }
    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);
}

var_dump($dato);

?>
