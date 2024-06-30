<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/iconos.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/Styles_Rec.css">
    <link rel="stylesheet" href="../styles/modaleslogin.css">
    <link rel="stylesheet" href="../styles/stylesCarga.css">
    <link rel="icon" href="../recursos/multimedia/Logos/SIA Logo.png" type="image/png">
    <script src="../scripts/script.js" async defer></script>
    <script src="../scripts/scriptRecu.js" async defer></script>
    <script src="../scripts/modaleslogin.js" async defer></script>
    <script src="../scripts/ScriptModalCarga.js" async defer></script>
</head>
<body>
    <div id="contModal-carga">
            <img src="../recursos/multimedia/Logos/LOGOSIAGIF.gif" alt="LogoCarga">
    </div>
    <nav id="cont-modalCorreo">
            <ul id="modalCorreo">
                <li id="cont-btnclose"><p id="btncloss"><span class="gg-close"></p></span></li>
                <li id="cont-datamodal">
                <p>Por favor, introduce tu correo electrónico 
                   para recibir una contraseña temporal. 
                   Con esta podrás cambiar 
                   tu contraseña actual y acceder al sistema SIA.</p>
                </li>
            </ul>
    </nav>
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


<div id="contpadre">
    <div id="conthijo">
        <div id="reset-password-container">
            <form id="form-reset-password" method="POST" action="../php/compruebaCorreo.php">
                <h1 align="center">Recuperar Contraseña</h1>
                <div id="padredata">
                    <div id="cont-leablel">
                        <label for="Correo">Correo Electrónico</label>
                        <label for="Confirmacion">Confirmar Correo Electrónico</label>
                    </div>
                    <div id="cont-imput">
                        <input id="intCorreo1" type="email" name="correo" placeholder="correo@example.com" required />
                        <input id="intCorreo2"type="email" name="confirmar_correo" placeholder="Confirmar correo@example.com" required />
                    </div>
                </div>

                    <input id="btnEnviar" style="display: none;" align="center" type="submit" value="Recuperar Contraseña" />
            </form>
        </div>
    </div>
</div>

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