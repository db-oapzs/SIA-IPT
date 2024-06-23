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
    <link rel="stylesheet" href="adminDFLE/styles/bootstrap.css">
    <link rel="stylesheet" href="adminDFLE/styles/stylesmenu.css">
    <script src="adminDFLE/scripts/bootstrap.js" async defer></script>


    <link rel="stylesheet" href="../../styles/stylesmenuSIA.css">
</head>
<body>
    
    <div class="sidebarSIA">
            <div class="logo_contenidoSIA">
                <div class="logoSIA">
                    <img style="width:50px; height: 50px;" src="../../recursos/multimedia/Logos/LogoFondoGuinda.png" alt="logo">
                    <div class="logo_nombreSIA">Sistema de Información de Autoevaluación</div>
                </div>
            </div>

            <div class="cont-menuSIA" id="btn-menuSIA">
                <i class="gg-menu" id="btnggmenu"></i>
            </div>
            <i class="gg-close" id="btn-closeSIA" style="display: none;"></i>
            

            <div class="nav-listSIA">
                <div class="cont-linksSIA">
                    <a href="inicio.php" id="btnesNavSIA">
                        <div class="contenedor-icoSIA">
                            <i class="gg-home-alt"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Inicio</span>
                        </div>
                    </a>
                </div>

        
                <div class="cont-linksSIA">
                    <a href="Dashboard.php" id="btnesNavSIA">
                        <div class="contenedor-icoSIA">
                            <i class="gg-insights"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Dashboard</span>
                        </div>
                    </a>
                </div>
                
                <div class="cont-linksSIA">
                    <a href="cargarData.php" id="btnesNavSIA">
                        <div class="contenedor-icoSIA">
                            <i class="gg-file-document"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">FAE</span>
                        </div>
                    </a>
                </div>

                <div class="cont-linksSIA">
                    <a href="decargarData.php" id="btnesNavSIA">
                        <div class="contenedor-icoSIA">
                            <i class="gg-software-download"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Descarga de Archivos</span>
                        </div>
                    </a>
                </div>
    
                <div class="cont-linksSIA">
                    <a href="status.php" id="btnesNavSIA">
                        <div class="contenedor-icoSIA">
                            <i class="gg-extension-add"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Carga de Datos</span>
                        </div>
                    </a>
                </div>

                <div class="cont-linksSIA">
                    <div class="dropdownSIA">
                    <div id="btnesNavSIA" class="dropbtnSIA" style="cursor: pointer;">
                        <div class="contenedor-icoSIA">
                            <i class="gg-extension"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Carga de Profesores</span>
                            <i class="gg-chevron-down"></i>
                        </div>
                    </div> 
                    <div class="dropdown-contentSIA">       
                        <?php
                        
                        if(
                            $nombre_usuario === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO' 
                        ){
                            echo '
                                <a id="btnesDropSIA" href="cargaProfesoresZAC.php">Zacatenco</a>
                            ';
                        }
                    
                        if(
                            $nombre_usuario === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS' 
                        ){
                            echo '
                                <a id="btnesDropSIA" href="cargaProfesoresST.php">Santo Tomás</a>
                            ';
                        }
                    ?>
                      </div>
                    </div>
                </div>


                </div>
                
                <div class="cont-logoutSIA">
                    <a href="cerrarSession.php">
                        <div class="contenedor-icoSIA">
                            <i class="gg-log-out"></i>
                        </div>
                        <div class="contenedor-txticoSIA">
                            <span class="links_nombresSIA">Cerrar Sesión</span>
                        </div>
                    </a>
                </div>

            </div>


    <script>
        let btnMenu = document.querySelector("#btn-menuSIA");
        let sidebar = document.querySelector(".sidebarSIA");
        let btnClose = document.querySelector("#btn-closeSIA");

        btnMenu.onclick = function() {
            sidebar.classList.add("active");
            btnMenu.style.display = "none";
            btnClose.style.display = "block";
        }

        btnClose.onclick = function() {
            sidebar.classList.remove("active");
            btnMenu.style.display = "block";
            btnClose.style.display = "none";
        }

    </script>

</body>
</html>