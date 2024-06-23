<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
if (isset($_POST['ustUMA']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $queryModUserSoli = '
    SELECT 
    g.Desc_Grado,
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
    Grado g ON ug.id_Grado = g.ID_Grado
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
    dc.Desc_Correo_Electronico = ?


    ';
    $CorreoE = $_POST['ustUMA'];
    $Nom = '';
    $StateBloq = '';
    $StateDesh = '';
    $Unidad = '';
    $Cargo = '';
    $Extencion = '';
    $grado = '';

    $params = [
        $CorreoE
    ];

    $stmt = sqlsrv_prepare($connection, $queryModUserSoli, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        exit;
    }
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        exit;
    }
    $users = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $users[] = $row;
        $Nom = $row['Desc_Nombre_Usuario'];
        $StateBloq = $row['Desc_Estatus_Bloqueo'];
        $StateDesh = $row['Desc_Estatus_Deshabilitado'];
        $Unidad = $row['Desc_Nombre_Unidad_Academica'];
        $Cargo = $row['Desc_Cargo'];
        $Extencion = $row['Desc_Numero_Telefono'];
        $roll = $row['Desc_Rol'];
        $grado = $row['Desc_Grado'];
        $arrayDt7 = $row['Desc_Correo_Electronico'];
    }
    sqlsrv_free_stmt($stmt);
} else {
    $Nom = '';
    $StateBloq = '';
    $StateDesh = '';
    $Unidad = '';
    $Cargo = '';
    $Extencion = '';
    header("Location: adminPanel.php?status=consultErr");
    exit();
}

$queryListUniAc = 'SELECT Desc_Nombre_Unidad_Academica FROM Unidades_Academicas';

$uniAcademicas = array();
$stmt = sqlsrv_prepare($connection, $queryListUniAc);
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
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $uniAcademicas[] = $row;
        }
    }
}

$querySelectRoll = 'SELECT Desc_Rol FROM Rol_Dentro_Del_Sistema';
$rolesSistema = array();
$stmt = sqlsrv_prepare($connection, $querySelectRoll);
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
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rolesSistema[] = $row;
        }
    }
}


$QueryListCargo = 'SELECT Desc_Cargo FROM cargos ';
$ListCargos = array();
$stmt = sqlsrv_prepare($connection, $QueryListCargo);
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
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $ListCargos[] = $row;
        }
    }
}
$queryListGrados = 'SELECT Desc_Grado FROM Grado';
$ListGrados = array();
$stmt = sqlsrv_prepare($connection, $queryListGrados);
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
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $ListGrados[] = $row;
        }
    }
}


/*
var_dump($users);
var_dump($Nom);
var_dump($StateBloq);
var_dump($StateDesh);
var_dump($Unidad);
var_dump($Cargo);
var_dump($Extencion);
*/

//var_dump($unidadesAc);
//var_dump($cargosSistema);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/stylesPanelAdmin.css">
    <link rel="stylesheet" href="../styles/iconos.css">
</head>

<body>
    <div class="contModModif">
        <header class="contBtnCloseMod">
            <a href="modificarUrA.php" class="conTbtnCls"><span class="gg-arrow-left-r"></span></a>
        </header>
        <form class="formMoD" method="POST" action="userModif.php">
            <h2 class="txtModePadm">Modificación de perfil para <?php echo $Nom ?></h2>
            <nav class="conInpLab">
                
                <label>Grado</label>
                <input class="dtPasado" type="text" value="<?php echo $grado ?>" readonly />
                <select id="slectCargo" name="opcGrado" required>
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <?php 
                        foreach ($ListGrados as $ListGrado) {
                            $grado0 = $ListGrado['Desc_Grado'];
                            echo "<option  value=\"$grado0\">$grado0</option>";
                        }
                    ?>
                </select>
                <label>Nombre : </label>
                <input class="dtPasado" type="text" value="<?php echo $Nom ?>" readonly />
                <input type="text" placeholder="Nuevo Nombre" name="nombre" />
                <label>Estado bloqueo : </label>
                <input class="dtPasado" type="text" value="<?php echo $StateBloq ?>" readonly />
                <select name="opcEstadoBloq">
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <option value="bloqueado">bloqueado</option>
                    <option value="desbloqueado">desbloqueado</option>
                </select>
                <label>Estado deshabilitado : </label>
                <input class="dtPasado" type="text" value="<?php echo $StateDesh ?>" readonly />
                </select>
                <select name="opcEstadoDesh">
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <option value="deshabilitado">Deshabilitado</option>
                    <option value="habilitado">Habilitado</option>
                </select>
                <label>Contraseña : </label>
                <input type="password" name="claseNueva" placeholder="Nueva Contraseña" />
                <label>Centro o Unidad : </label>
                <input class="dtPasado" type="text" value="<?php echo $Unidad ?>" readonly />
                <select name="opcCentroUnidad">
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <?php
                        foreach ($uniAcademicas as $uniAcademica) {
                            $nombreUnidad = $uniAcademica['Desc_Nombre_Unidad_Academica'];
                            echo "<option class='optionIdiomas' value=\"$nombreUnidad\">$nombreUnidad</option>";
                        }
                    ?>
                </select>
                <label>Cargo : </label>
                <input class="dtPasado" type="text" value="<?php echo $Cargo ?>" readonly />
                <select name="opcCargo">
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <?php 
                        foreach ($ListCargos as $ListCargo) {
                            $cargos = $ListCargo['Desc_Cargo'];
                            echo "<option  value=\"$cargos\">$cargos      </option>";
                        }
                    ?>
                </select>
                <label>Roll</label>
                <input class="dtPasado" type="text" value="<?php echo $roll ?>" readonly />
                <select id="slectCargo" name="opcRoll" required>
                    <option value=" " disabled selected> Selecciona una Opción</option>
                    <?php 
                        foreach ($rolesSistema as $rooll) {
                            $cargos = $rooll['Desc_Rol'];
                            echo "<option  value=\"$cargos\">$cargos</option>";
                        }
                    ?>
                </select>
                <label>Extención : </label>
                <input class="dtPasado" type="text" value="<?php echo $Extencion ?>" readonly />
                <input type="tel" placeholder="Nueva Extención" name="extencionTel" maxlength="5"/>
                <input type="hidden" name="correo" value="<?php echo $arrayDt7 ?>" />
            </nav>          
            <input type="submit" value="modificar">
        </form>
    </div>

    <?php


    $Nom = '';
    $StateBloq = '';
    $StateDesh = '';
    $Unidad = '';
    $Cargo = '';
    $Extencion = '';

    ?>
    <script src="../scripts/scriptPanelAdmin.js" async defer></script>
</body>

</html>