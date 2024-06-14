<?php
require '../../../vendor/autoload.php';
header('Content-Type: application/json; charset=utf-8');  // Cambia el Content-Type para JSON
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$offset = ($page - 1) * $perPage;

$queryUsers = "
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
    WHERE 
        nu.Desc_Nombre_Usuario LIKE ? OR 
        ua.Desc_Nombre_Unidad_Academica LIKE ? OR 
        c.Desc_Cargo LIKE ? OR
        nt.Desc_Numero_Telefono LIKE ? OR
        dc.Desc_Correo_Electronico LIKE ?
    ORDER BY nu.Desc_Nombre_Usuario
    OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";

$params = [
    "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%",
    $offset, $perPage
];

$stmt = sqlsrv_prepare($connection, $queryUsers, $params);
if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$result = sqlsrv_execute($stmt);
if ($result === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$users = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $users[] = $row;
}

sqlsrv_free_stmt($stmt);

$queryCount = "
    SELECT COUNT(*) as total
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
    WHERE 
        nu.Desc_Nombre_Usuario LIKE ? OR 
        ua.Desc_Nombre_Unidad_Academica LIKE ? OR 
        c.Desc_Cargo LIKE ? OR
        nt.Desc_Numero_Telefono LIKE ? OR
        dc.Desc_Correo_Electronico LIKE ?";

$paramsCount = [
    "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%"
];

$stmtCount = sqlsrv_prepare($connection, $queryCount, $paramsCount);
if ($stmtCount === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$resultCount = sqlsrv_execute($stmtCount);
if ($resultCount === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$totalRows = sqlsrv_fetch_array($stmtCount, SQLSRV_FETCH_ASSOC)['total'];
$totalPages = ceil($totalRows / $perPage);

sqlsrv_free_stmt($stmtCount);

echo json_encode([
    "users" => $users,
    "totalPages" => $totalPages,
    "currentPage" => $page
]);
