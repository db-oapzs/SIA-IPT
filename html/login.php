<!DOCTYPE html>
<html>
<?php
    session_start();
    session_destroy();
    
    if(isset($_GET['status'])){
        include '../php/errors.php';
        $status = $_GET["status"];
        if(array_key_exists($status, $statusErrors)) {
            echo '
            <nav id="cont-modalCorreo">
                <ul id="modalCorreo">
                    <li id="cont-btnclose"><p id="btncloss"><span class="gg-close"></span></p></li>
                    <li id="cont-datamodal">
                        <p>' . $status . ': ' . $statusErrors[$status] . '</p>
                    </li>
                </ul>
            </nav>
            ';
        }
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/iconos.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/modaleslogin.css">
    <link rel="icon" href="../recursos/multimedia/Logos/SIA Logo.png" type="image/png">

    <script src="../scripts/script.js" async defer></script>
    <script src="../scripts/modaleslogin.js" async defer></script>
</head>
<body>
    <header id="header-bar">
        <div id="logo-secGob">
            <img src="../recursos/multimedia/img/logos/Logo_128x50.svg">
        </div>
        <div id="menuheader">
            <ul id="menuGob">
                <a href="#trámites"><li>trámites</li></a>
                <a href="#gobierno"><li>gobierno</li></a>
                <a href="#search"><li><span class="gg-search"></span></li></a>
                <li id="btnMenu"><span id="icobtn" class="gg-menu"></span></li>
            </ul>
        </div>
    </header>
    <ul id="menuGob_r">
        <a href="#trámites"><li>trámites</li></a>
        <a href="#gobierno"><li>gobierno</li></a>
        <a href="#search"><li><span class="gg-search"></span></li></a>
    </ul>
    <ul id="logosresponsive">
        <li id="secGob_R">
            <img src="../recursos/multimedia/img/logos/logo-sep.png">
        </li>
        <li id="poli_R">
            <img src="../recursos/multimedia/img/logos/logo-poli.svg">
        </li>
    </ul>
    <section id="Cont-principal">
        <ul id="img_logos">
            <li id="secGob">
                <img src="../recursos/multimedia/img/logos/logo-sep.png">
            </li>
            <li id="sia">
                <img src="../recursos/multimedia/img/logos/SIA Logo.png">
            </li>
            <li id="poli">
                <img src="../recursos/multimedia/img/logos/logo-poli.svg">
            </li>
        </ul>
        <ul id="contDiiItp">
            <li>
                <img src="../recursos/multimedia/img/logos/LOGO DII.png">
            </li>
            <li>
                <form id="form-login" method="POST" action="../php/ingresaPerfil.php">
                    <h1>Inicio de sesión</h1>
                    <label for="Correo">Correo</label>
                    <input type="email"
                           id = "inputEmail"
                           name="correo"
                           placeholder="Id usuario"
                           required
                    />
                    <label for="Correo">Contraseña</label>
                    <input type="password"
                           name="clave"
                           placeholder=" * * * * * * * "
                           minlength="8"
                           required
                    />
                    <input type="submit"
                           value="Entrar"
                    />
                    <a href="CorreoRec.php">¿Olvidaste tu contraseña?</a>
                </form>
            </li>
            <li>
                <img src="../recursos/multimedia/img/logos/logoItp.png">
            </li>
        </ul>
    </section>
    <footer id="cont-footer">
        <div id="cont-infofooter">
            <ul id="cont-infoF">
                <li id="gobmex-logos">
                    <img src="../recursos/multimedia/img/logos/Logo_128x50.svg"/>
                </li>
                <li id="enlaces">
                    <h1>Enlaces</h1>
                    <ul id="enlaces-gob">
                        <a><li>Participa</li></a>
                        <a><li>Publicaciones Oficiales</li></a>
                        <a><li>Marco Jurídico</li></a>
                        <a><li>Plataforma Nacional de Transparencia</li></a>
                        <a><li>Alerta</li></a>
                        <a><li>Denuncia</li></a>
                    </ul>
                </li>
                <li id="gobmx">
                    <h1>¿Qué es gob.mx?</h1>
                    <p>
                        Es el portal único de trámites, información y participación ciudadana. 
                        <a href="#">Leer más</a>
                    </p>
                    <ul id="cont-gob">
                        <a href="#"><li>Portal de datos abiertos</li></a>
                        <a href="#"><li>Declaración de accesibilidad</li></a>
                        <a href="#"><li>Aviso de privacidad integral</li></a>
                        <a href="#"><li>Aviso de privacidad simplificado</li></a>
                        <a href="#"><li>Términos y Condiciones</li></a>
                        <a href="#"><li>Política de seguridad</li></a>
                        <a href="#"><li>Mapa de sitio</li></a>
                    </ul>
                </li>
                <li id="siguenos">
                    <ul>
                        <a><li>Denuncia contra servidores públicos</li></a>
                        <a><li>Síguenos en</li></a>
                    </ul>
                    <div>
                        <div><span class="gg-facebook"></span></div>
                        <div><span class="gg-twitter"></span></div>
                
                </li>
            </ul>
        </div>
        <div id="pie-pag"></div>
    </footer>
</body>
</html>