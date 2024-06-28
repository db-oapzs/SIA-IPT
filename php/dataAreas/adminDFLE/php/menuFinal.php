<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header("Location: ../../../../html/login.php?status=sessionCad");
        exit();
    }
    $correo = $_SESSION['correo'];
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $roll = $_SESSION['roll'];
    //var_dump($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DFLE <?php echo $roll ?></title>
    <link rel="stylesheet" href="../styles/stylesmenu.css">
        <link rel="stylesheet" href="../styles/iconos.css">
        <link rel="stylesheet" href="../styles/menu.css">
        <link rel="stylesheet" href="../styles/stylesadminMsj.css">
        <link rel="stylesheet" href="../styles/stylesJustF5.css">
        <link rel="stylesheet" href="../styles/stylesJustF22.css">
        <link rel="stylesheet" href="../styles/styleGenExcel.css">
        <!--
        <link rel="stylesheet" href="../styles/stylesadmin.css">
        -->
        <link rel="stylesheet" href="../styles/DFStyles.css">
        <link rel="stylesheet" href="../styles/bootstrap.css">
        <link rel="stylesheet" href="../styles/stylesbadmin.css">
        <link rel="stylesheet" href="../styles/stylesJustF9.css">
        <link rel="stylesheet" href="../styles/UCelexS.css">

        <link rel="stylesheet" href="../styles/CargActiv.css">
        <link rel="stylesheet" href="../styles/DFStyles.css">
        <link rel="stylesheet" href="../styles/stylesPanelAdmin.css">
        <link rel="stylesheet" href="../../../../scripts/jqueryUI/jquery-ui.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="../../../scripts/menu.js" async defer></script>  
        <script src="../scripts/jquery-3.7.1.min.js" async defer></script>  
        <script src="../../../../scripts/jqueryUI/jquery-ui.js"></script>
        <script src="../scripts/ScriptModal.js" async defer></script>
        <script src="../scripts/bootstrap.js" async defer></script>
        <script src="../scripts/clock.js" async defer></script>
    
</head>
<body>
    <?php
    if($roll === 'Administrador SIA' || $roll === 'DII-Jefe_Analista'){
        echo '
            
            <div class="sidebar">
                    <div class="logo_contenido">
                        <div class="logo">
                            <img src="../recursos/media/LogoFondoGuinda.png" alt="logo">
                            <div class="logo_nombre">Sistema de Información de Autoevaluación</div>
                        </div>
                    </div>

                    <div class="cont-menu" id="btn-menu">
                        <i class="gg-menu" id="btnggmenu"></i>
                    </div>
                    <i class="gg-close" id="btn-close" style="display: none;"></i>
                    

                    <div class="nav-list">
                        <div class="cont-links">
                            <a href="Bienvenida.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-home-alt"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Inicio</span>
                                </div>
                            </a>
                        </div>
                        
                        <div class="cont-links">
                            <a href="adminPanel.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-user-list"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Panel de Usuarios</span>
                                </div>
                            </a>
                        </div>
                
                        <div class="cont-links">
                            <a href="" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-insights"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Dashboard</span>
                                </div>
                            </a>
                        </div>

                        <div class="cont-links">
                            <a href="DescargaFormatos.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-software-download"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Descarga de Archivos</span>
                                </div>
                            </a>
                        </div>
            
                        <div class="cont-links">
                            <a href="MensajesAdmin.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-comment"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Mensajes</span>
                                </div>
                            </a>
                        </div>


                        </div>
                        
                        <div class="cont-logout">
                            <a href="cerrarsesion.php">
                                <div class="contenedor-ico">
                                    <i class="gg-log-out"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Cerrar Sesión</span>
                                </div>
                            </a>
                        </div>

                    </div>
                ';
    }
    if($roll === 'DFLE-Administrado'){
        echo'
            <div class="sidebar">
                    <div class="logo_contenido">
                        <div class="logo">
                            <img src="../recursos/media/LogoFondoGuinda.png" alt="logo">
                            <div class="logo_nombre">Sistema de Información de Autoevaluación</div>
                        </div>
                    </div>

                    <div class="cont-menu" id="btn-menu">
                        <i class="gg-menu" id="btnggmenu"></i>
                    </div>
                    <i class="gg-close" id="btn-close" style="display: none;"></i>
                    

                    <div class="nav-list">
                        <div class="cont-links">
                            <a href="Bienvenida.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-home-alt"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Inicio</span>
                                </div>
                            </a>
                        </div>
                        
                
                        <div class="cont-links">
                            <a href="generarExcel.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-insights"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Generar Estadisticos</span>
                                </div>
                            </a>
                        </div>
                        
                        <div class="cont-links">
                            <a href="copia.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-file-document"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">FAE</span>
                                </div>
                            </a>
                        </div>

                        <div class="cont-links">
                            <a href="DescargaFormatos.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-software-download"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Descarga de Archivos</span>
                                </div>
                            </a>
                        </div>
            
                        <div class="cont-links">
                            <a href="MensajesAdmin.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-comment"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Mensajes</span>
                                </div>
                            </a>
                        </div>
                        <div class="cont-links">
                            <a href="CargaActiv.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-stack"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Formación de Profesores</span>
                                </div>
                            </a>
                        </div>
                        <div class="cont-links">
                            <a href="formato1.php" id="btnesNav">
                                <div class="contenedor-ico">
                                    <i class="gg-play-list-check"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Unidades Supervisadas</span>
                                </div>
                            </a>
                        </div>

                        <div class="cont-links">
                            <div class="dropdown">
                            <div id="btnesNav" class="dropbtn" style="cursor: pointer;">
                                <div class="contenedor-ico">
                                    <i class="gg-extension"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Estadísticos</span>
                                    <i class="gg-chevron-down"></i>
                                </div>
                            </div> 
                            <div class="dropdown-content">
                                <a id="btnesDrop" href="justificacionF2.php">Justificación F2</a>
                                <a id="btnesDrop" href="archivoF5Justificacion.php">Justificación F5</a>
                                <a id="btnesDrop" href="archivoF99Justificacion.php">Justificación F9</a>
                            </div>
                            </div>
                        </div>


                        </div>
                        
                        <div class="cont-logout">
                            <a href="cerrarsesion.php">
                                <div class="contenedor-ico">
                                    <i class="gg-log-out"></i>
                                </div>
                                <div class="contenedor-txtico">
                                    <span class="links_nombres">Cerrar Sesión</span>
                                </div>
                            </a>
                        </div>

                    </div>
        ';
    }
    ?>


    <script>
        let btnMenu = document.querySelector("#btn-menu");
        let sidebar = document.querySelector(".sidebar");
        let btnClose = document.querySelector("#btn-close");

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