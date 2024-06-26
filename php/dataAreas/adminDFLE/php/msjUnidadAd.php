<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../phpmailer/src/Exception.php';
require '../../../phpmailer/src/PHPMailer.php';
require '../../../phpmailer/src/SMTP.php';
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';



if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)&& !empty($_POST['unidad']) && isset($_POST['unidad'])){
    //var_dump($_POST);
    $correo = $_POST['unidad'];
    $mensaje = $_POST['Mensaje'];
    $fechaActual = date('d-m-Y H:i:s');

    
        // El envío de correos y el resto de la lógica permanece igual

        $gmailHost = 'smtp.gmail.com';
        $gmailPort = 587;
        $gmailUsuario = 'acerpcnitro5pz@gmail.com';
        $gmailClave = 'ncva tlqb fmbh vdtf';

        $destinatarios = [strval($correo)];



        $mensaje = '
        <div style="width:70vw; height:auto; background: #EEEEEE; diplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important; padding: 20px; overflow: hidden;" >
        <div style="background: #682444; width: 100%; height: 40px; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;"></div>
            <img src="https://www.ipn.mx/assets/files/main/img/template/logo_ipn_guinda.svg" alt="Logo IPN" style="width: 300px; height: auto; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="https://www.ipn.mx/assets/files/coplaneval/img/Evaluacion/LOGO%20DII.png" alt="Logo DII" style="width: 150px; height: auto; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;">
                
        <p style="color:#222831 !important; font-size:25px; font-weight:600;">
            Sistema de Información para la Autoevaluación - SIA
        </p>
        <h1 style="color:#222831 !important; font-size:27px; text-transform: capitalize;">DFLE</h1>
        <p style="color:#222831 !important; font-size:23px;">Este es un correo enviado desde el SIA por la DFLE</p>
        <p style="color:#222831 !important; font-size:18px;">'.$mensaje.'</p>
        <p style="color:#222831 !important; font-size:13px;">No Responder. Este Correo Solo Es Un Aviso</p>
        <div style="background: #682444; width: 100%; height: 40px; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;"></div>
        </div>
        ';
            // Crear una instancia de PHPMailer para Gmail
            $gmailMail = new PHPMailer(true);
            $gmailMail->isSMTP();
            $gmailMail->CharSet = 'UTF-8';
            $gmailMail->Host = $gmailHost;
            $gmailMail->SMTPAuth = true;
            $gmailMail->Username = $gmailUsuario;
            $gmailMail->Password = $gmailClave;
            $gmailMail->SMTPSecure = 'tls';
            $gmailMail->Port = $gmailPort;

            foreach ($destinatarios as $destinatario) {
                $gmailMail->addAddress($destinatario);
                $gmailMail->Subject = 'Notificación SIA';
                $gmailMail->isHTML(true);
                $gmailMail->Body = $mensaje; // Ahora el cuerpo del correo se establece como $mensaje
                $gmailMail->send();
                $gmailMail->clearAddresses();
            }

            //echo "<h2> Correo enviado </h2>";

            header("Location: ../php/MensajesAdmin.php?status=correoEnviado");
            exit();
        }else{
            //echo "<br><h2> No Correo </h2>";
            header("Location: ../php/MensajesAdmin.php?status=correoEnvErr");
            exit();
        }

?>