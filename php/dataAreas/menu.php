<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}
$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$arrayDataSQL_H = array();
$arrayDataSQL_M = array();
$idiomaRecolectado = '';
if(isset($_SESSION['arrayDataSQL_H']) && 
    isset($_SESSION['arrayDataSQL_M']) && 
    isset($_SESSION['idiomaRecolectado'])){
    $arrayDataSQL_H = $_SESSION['arrayDataSQL_H'];
    $arrayDataSQL_M = $_SESSION['arrayDataSQL_M'];
    $idiomaRecolectado = $_SESSION['idiomaRecolectado'];
}else{
    for($i = 0 ; $i < 24 ; $i++){
        $arrayDataSQL_H[] = 0;
        $arrayDataSQL_M[] = 0;
    }
    $idiomaRecolectado = '';
}

$img = '';
$query = '
    SELECT UA.ID_UnidadAcademica
    FROM Usuarios_General UG
    JOIN unidades_academicas UA ON UG.id_UnidadAcademica = UA.ID_UnidadAcademica
    JOIN Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
    WHERE CE.Desc_Correo_Electronico = ?;
';
$params = array($correo);
$stmt = sqlsrv_prepare($connection, $query, $params);
if ($stmt === false) {
    $img = '';
    //echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        $img = '';
    } else {
        // Mostrar los resultados
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $img = $row['ID_UnidadAcademica'];
        }
    }
    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($connection);

//------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../recursos/multimedia/Logos/SIA Logo.png" type="image/png">
    <link rel="stylesheet" href="../../styles/iconos.css">
    <link rel="stylesheet" href="../../styles/stylesCarga.css">
    <link rel="stylesheet" href="../../styles/stylesPerfil.css">
    <link rel="stylesheet" href="../../styles/stylesInicioUA.css">
    <link rel="stylesheet" href="../../styles/modaleslogin.css">
    <link rel="stylesheet" href="../../styles/StylesCargProf.css">
    <link rel="stylesheet" href="../../styles/stylesJustF3.css">
    <script src="../../scripts/ScriptModalCarga.js" async defer></script>
    <script src="../../scripts/scriptPerfil.js" async defer></script>
    <script src="../../scripts/scriptInicioUA.js" async defer></script>
    <script src="../../scripts/modaleslogin.js" async defer></script>
    <script src="../../scripts/SumaSt.js" async defer></script>
</head>

<body>
<header id="con-header" styles="z-index:9999">
        <div id="cont-logo1">
            <img src="../../recursos/multimedia/Logos/SIA Logo.png">
            <img src="../../recursos/multimedia/Idiomas/<?php echo $img.'.png'?>">
        </div>
        <div id="cont-name">
            <h2>
                <?php echo $nombre_usuario; ?>
            </h2>
        </div>
        <div id="cont-logoipn"></div>
        <div id="cont-menu">
            <img src="../../recursos/multimedia/Logos/DII.jpg">
            <ul id="contIcoMenu">
                <li>
                        <div id="btnNotifi"><span class="gg-notifications"></span></div>
                        <ul id="menuNotifi">
                            <a><li>Noti 1</li></a>
                            <a><li>Noti 2</li></a>
                            <a><li>Noti 3</li></a>
                        </ul>
                </li>
                <li>
                <div id="btnMuser"><span class="gg-user"></span></div>
                        <ul id="menuUser">
                            <a href="cerrarSession.php"><li>Cerrar Sesion</li></a>
                            <a><li>data 2</li></a>
                            <a><li>data 3</li></a>
                        </ul>
                </li>
            </ul>
        </div>
    </header>
    <nav id="menuLateral">
        <a href="inicio.php">Inicio</a>
        <a href="Dashboard.php">Dashboard data</a>
        <a href="cargarData.php">Carga de datos</a>
        <?php
        
            if(
                $nombre_usuario === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO' 
            ){
                echo '
                    <a href="cargaProfesoresZAC.php">Carga de Profesores ZAC</a>
                ';
            }
        
            if(
                $nombre_usuario === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS' 
            ){
                echo '
                    <a href="cargaProfesoresST.php">Carga de Profesores ST</a>
                ';
            }
        ?>
        <a id="btnExcel" href="decargarData.php">Descargar Excel</a>
        <a href="status.php">status</a>
        <a href="cerrarSession.php">Cerrar sesion</a>

    </nav>
    <div id="contModal-carga">
            <img src="../../recursos/multimedia/Logos/LOGOSIAGIF.gif" alt="Logo de Carga">
            <div class="loader"></div>
    </div>
    