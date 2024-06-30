<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "conexion.php";
include "encriptado.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["correo"]) && isset($_POST["clave"])) {
    $correo = $_POST["correo"];
    $clave_ingresada = $_POST["clave"];
    
    //$queryPerfil = 'SELECT clave_usuario, palabra_random, status_bloqueo, status_desactivado FROM usuarios WHERE correo = ?';
    $queryPerfil = '
        SELECT 
        CH.Desc_Contrasena_Hash,
        PA.Desc_Palabra_Aleatoria,
        EB.Desc_Estatus_Bloqueo,
        ED.Desc_Estatus_Deshabilitado
        FROM Usuarios_General UG
        JOIN Contrasena_Hash CH ON UG.id_ContrasenaHash = CH.ID_ContrasenaHash
        JOIN Palabra_Aleatoria PA ON UG.id_PalabraAleatoria = PA.ID_PalabraAleatoria
        JOIN Estatus_Bloqueado EB ON UG.id_EstatusBloqueo = EB.ID_EstatusBloqueo
        JOIN Estatus_Deshabilitado ED ON UG.id_EstatusDeshabilitado = ED.ID_EstatusDeshabilitado
        JOIN Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
        WHERE CE.Desc_Correo_Electronico = ? 
        ';
        $params = array($correo);
        $stmt = sqlsrv_prepare($connection, $queryPerfil, $params);

        if ($stmt === false) {
            // Manejar el error de la consulta preparada
            //echo "Error en la preparación de la consulta.";
            $_POST["correo"] = 'null';
            $_POST["clave"] = 'null';
            header("Location: ../html/login.php?status=colsultaPrep");
            exit();  
        } else {
            // Ejecutar la consulta
            $result = sqlsrv_execute($stmt);
    
            if ($result === false) {
                // Manejar el error de la ejecución de la consulta
                //echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                //echo "No se encontró ningún usuario con el correo electrónico proporcionado.";
                session_destroy();
                header("Location: ../html/login.php?status=errorConsulta");
                $_POST["correo"] = 'null';
                $_POST["clave"] = 'null';
                exit();
            } else {
                // Mostrar los resultados
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    //echo "<br>";
                    //print_r($row);
                    //echo "<br>";
                    $datosEncontrados = $row;
                }
                //var_dump($datosEncontrados);
                if($datosEncontrados['Desc_Estatus_Bloqueo'] === 0){
                    //echo "<h3>Maximo de intentos alcanzados, usuario bloqueado</h3>";
                    //echo "<h3>Comunicate con el administrador</h3>";
                    $_POST["correo"] = 'null';
                    $_POST["clave"] = 'null';
                    //header("Location: ../html/login.php?status=userBloqueado");
                    //exit(); 
                }else{
                    if($datosEncontrados['Desc_Estatus_Deshabilitado'] != 0){
                        echo "<h3>Usuario Desabilitado</h3>";  
                        $_POST["correo"] = 'null';
                        $_POST["clave"] = 'null';
                        //header("Location: ../html/login.php?status=userDesabilitado");
                        //exit(); 
                    }else{
                        $hashGuardado1 = $datosEncontrados['Desc_Contrasena_Hash'];
                        $prandGuardada1 = $datosEncontrados['Desc_Palabra_Aleatoria'];
                        if (verificarContraseña($clave_ingresada,$hashGuardado1,$prandGuardada1 )) {
                            //echo "<br>La contraseña es correcta.";
                            //$queryDtaUsr = 'SELECT nombre_usuario FROM usuarios WHERE correo = ?';
                            $queryDtaUsr = '
                                SELECT UA.Desc_Nombre_Unidad_Academica
                                FROM Usuarios_General UG
                                JOIN unidades_academicas UA ON UG.id_UnidadAcademica = UA.ID_UnidadAcademica
                                JOIN Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
                                WHERE CE.Desc_Correo_Electronico = ?
                                ';
                                $params = array($correo);
                                $stmt = sqlsrv_prepare($connection, $queryDtaUsr, $params);
                                if ($stmt === false) {
                                    // Manejar el error de la consulta preparada
                                    //echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                                    session_destroy();
                                    header("Location: ../html/login.php?status=errPrepConsult");
                                    exit();
                                } else {
                                    // Ejecutar la consulta
                                    $result = sqlsrv_execute($stmt);
                            
                                    if ($result === false) {
                                        // Manejar el error de la ejecución de la consulta
                                        //echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                                    } else {
                                        // Mostrar los resultados
                                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                            //echo "<br>";
                                            //print_r($row);
                                            $datosEncontrados = $row;
                                        }

                                        $queryPerfilUser = '
                                            SELECT 
                                                CE.Desc_Correo_Electronico, RD.Desc_Rol
                                            FROM Usuarios_General UG
                                            JOIN Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
                                            JOIN Rol_Dentro_Del_Sistema RD ON UG.id_Rol = RD.ID_Rol
                                            WHERE CE.Desc_Correo_Electronico = ?
                                        ';

                                        $params = array($correo);
                                        $datoda2 = '';

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
                                                    $datoda2 = $row['Desc_Rol'];
                                                }
                                            }
                                        }
                                        //--- guardo los datos en una session
                                        if(
                                            $datoda2 === 'Administrador SIA' || 
                                            $datoda2 === 'DII-Jefe_Analista' || 
                                            $datoda2 === 'DFLE-Administrado'
                                        ){
                                            $_SESSION['correo'] = $correo;
                                            $_SESSION['roll'] = $datoda2;
                                            $_SESSION['nombre_usuario'] = $datosEncontrados['Desc_Nombre_Unidad_Academica'];
                                            header("Location: ../php/dataAreas/adminDFLE/php/Bienvenida.php?status=success&correo=".$correo);
                                            exit(); 
                                        }
                                        if($datoda2 === 'DFLE-Dependencia-Unidades'){
                                            $_SESSION['correo'] = $correo;
                                            $_SESSION['roll'] = $datoda2;
                                            $_SESSION['nombre_usuario'] = $datosEncontrados['Desc_Nombre_Unidad_Academica'];
                                            header("Location: ../php/dataAreas/inicio.php?status=success&correo=".$correo);
                                            exit(); 
                                        }
                                        //var_dump($datosEncontrados);
                                    }
                                    // Liberar el conjunto de resultados
                                    sqlsrv_free_stmt($stmt);
                                }
                                // Cierra la conexión
                                sqlsrv_close($connection);
                        } else {
                            //echo "<br>La contraseña es incorrecta.";
                            $_POST["correo"] = 'null';
                            $_POST["clave"] = 'null';
                            header("Location: ../html/login.php?status=userPass");
                            exit(); 
                        }                    
                    }
                }
            }
        }
} else {
    //echo "Se esperaba recibir el correo electrónico y la clave.";
    $_POST["correo"] = 'null';
    $_POST["clave"] = 'null';
    header("Location: ../html/login.php?status=dtaError");
    exit();  
}


?>
