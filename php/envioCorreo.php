<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if (isset($_SESSION["correo"])) {
    date_default_timezone_set('America/Mexico_City');
    include 'encriptado.php';
    include 'funcContraAl.php';
    include 'conexion.php';

    $correo = $_SESSION["correo"];
    $fechaActual = date('d-m-Y');

    // Consulta para verificar intentos de recuperación recientes
    $query = "
        SELECT COUNT(*) AS total
        FROM recuperacionContra RC
        JOIN correo_electronico CE ON RC.id_correo = CE.ID_CorreoElectronico 
        WHERE CE.Desc_Correo_Electronico = ?
        AND fecha = ?
        AND hora_creacion BETWEEN DATEADD(MINUTE, -10, CURRENT_TIMESTAMP) AND CURRENT_TIMESTAMP
    ";

    // Prepara la consulta con `sqlsrv_prepare` y ejecuta
    $stmt = sqlsrv_prepare($connection, $query, array($correo, $fechaActual));

    if ($stmt === false) {
        echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "<br>";
        exit();
    }

    if (sqlsrv_execute($stmt) === false) {
        echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "<br>";
        exit();
    }

    if (sqlsrv_fetch($stmt)) {
        $total = sqlsrv_get_field($stmt, 0);

        if ($total >= 3) {
            // Bloquear usuario si hay demasiados intentos
            $nuevo_valor_status_bloqueo = 0; // Estatus de bloqueo
            $sql = "
                UPDATE Usuarios_General 
                SET id_EstatusBloqueo = (SELECT ID_EstatusBloqueo FROM Estatus_Bloqueado WHERE Desc_Estatus_Bloqueo = ?)
                WHERE Desc_Correo_Electronico = ?
            ";

            $stmt_bloqueo = sqlsrv_prepare($connection, $sql, array("Bloqueado", $correo));
            if (sqlsrv_execute($stmt_bloqueo)) {
                header('Location: ../html/login.php?status=userBloq');
                exit();
            } else {
                header('Location: ../html/login.php?status=statusBloq');
                exit();
            }
        } else {
            // El envío de correos y el resto de la lógica permanece igual
 
                $gmailHost = 'smtp.gmail.com';
                $gmailPort = 587;
                $gmailUsuario = 'acerpcnitro5pz@gmail.com';
                $gmailClave = 'ncva tlqb fmbh vdtf';

            $destinatarios = [strval($correo)];

            // Generar nueva contraseña
            $contra = generarContraseñaAleatoria();
            $datosHash = passHass($contra);
            $hashGuardado = $datosHash['hash'];
            $prandGuardada = $datosHash['prand'];

            // Establecer la hora de creación y vencimiento
            $fechacreacion = date('H:i:s');
            $fechacreacion_datetime = new DateTime($fechacreacion);
            $fechavencimiento_datetime = $fechacreacion_datetime->modify('+5 minutes');
            $fechavencimiento = $fechavencimiento_datetime->format('H:i:s');
            $mensaje = '
            <div style="width:100vw; height:auto; background: #EEEEEE; diplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important; padding: 20px; overflow: hidden;" >
            <div style="background: #682444; width: 100%; height: 40px; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;"></div>
            <p style="color:#222831 !important; font-size:25px; font-weight:600;">
            <img src="https://www.ipn.mx/assets/files/imageninstitucional/uploads/logo_ipn_hor.png" alt="Logo IPN" style="width: 300px; height: auto; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="https://www.ipn.mx/assets/files/coplaneval/img/Evaluacion/LOGO%20DII.png" alt="Logo IPN" style="width: 150px; height: auto; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;">
                <br>
                Sistema de Información para la Autoevaluación - SIA
            </p>
            <h1 style="color:#222831 !important; font-size:27px; text-transform: capitalize;">¿Olvidaste tu contraseña?</h1>
            <p style="color:#222831 !important; font-size:23px;">Este es un correo de recuperación enviado desde el SIA 
            (Sistema de Información para la Autoevaluación)</p>
            <p style="color:#222831 !important; font-size:18px;">A continuación, encontrarás tu contraseña temporal 
            la cual será inservible después de 5 minutos</p>
            <ul style="width:100vw !important; height: auto !important; padding-top: 20px; padding-bottom: 20px; list-style: none;">
                <li><p style="color:#222831 !important; font-size:30px !important; font-weight:100 !important; letter-spacing:1px !important;">Contraseña : <span style="font-size:30px !important; font-weight:600 !important; letter-spacing:3px !important;">' . $contra . '</span></p></li>
                <li><p style="color:#222831 !important; font-size:30px !important; font-weight:100 !important; letter-spacing:1px !important;">Hora de creación : <span style="font-size:30px !important; font-weight:600 !important; letter-spacing:3px !important;">' . $fechacreacion . '</span></p></li>
                <li><p style="color:#222831 !important; font-size:30px !important; font-weight:100 !important; letter-spacing:1px !important;">Hora de vencimiento : <span style="font-size:30px !important; font-weight:600 !important; letter-spacing:3px !important;">' . $fechavencimiento . '</span></p></li>
            </ul>
            <div style="background: #682444; width: 100%; height: 40px; iplay:flex !important; color:#ccc !important; flex-direction: column !important; justify-content: space-around !important; align-items: center !important;"></div>
            </div>
            ';
            try{
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
                    $gmailMail->Subject = 'Correo de recuperación SIA';
                    $gmailMail->isHTML(true);
                    $gmailMail->Body = $mensaje; // Ahora el cuerpo del correo se establece como $mensaje
                    $gmailMail->send();
                    $gmailMail->clearAddresses();
                }
    
                $data = bin2hex($prandGuardada);
                // Insertar recuperación en la base de datos
                $query_insert = "
                INSERT INTO recuperacionContra (id_correo, clave_temporal, palabra_random, fecha, hora_creacion, hora_vencimiento) 
                VALUES ((SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?), ?, ?, ?, ?, ?)
                ";
    
                $stmt_insert = sqlsrv_prepare($connection, $query_insert, array($correo, $hashGuardado, bin2hex($prandGuardada), $fechaActual, $fechacreacion, $fechavencimiento));
    
                if (sqlsrv_execute($stmt_insert)) {
                    $_SESSION['paleatoria'] = $prandGuardada;
                    $_SESSION['fechacreacion'] = $fechacreacion;
                    $_SESSION['contra'] = $contra;
                    include '../html/NewPass.php';
                } else {
                    session_destroy();
                    header('Location: ../html/login.php?status=errorContTEnv');
                    exit();
                }
            } catch (Exception $e) {
                echo '<br><h2>Error al enviar el correo: ' . $e->getMessage() . "</h2>";    
                session_destroy();
                header("Location: ../html/login.php?status=correoEnvErr");
                exit();
            }
        }
    } else {
        header("Location: ../html/login.php?status=noResult");
        exit();
    }
} else {
    session_destroy();
    header("Location: ../html/login.php?status=dataError");
    exit();
}

sqlsrv_close($connection); // Cierra la conexión al final
?>
