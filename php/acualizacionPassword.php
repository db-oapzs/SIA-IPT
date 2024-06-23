<?php
include 'encriptado.php'; 
include 'funcContraAl.php';
include 'conexion.php';

header('Content-Type: text/html; charset=utf-8');
session_start();

$correo = $_SESSION['correo'];
$contra = $_SESSION['contra'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($contra === $_POST['clave']) {
        $claveTemporal = $_POST['clave'];
        $nuevaClave = $_POST['nueva_clave']; 
        $confirma_newClave = $_POST['confimar_clave']; 
        $fechacreacion = $_POST['fechacreacion']; 
        $fechaActual = date('d-m-Y');

        if ($nuevaClave === $confirma_newClave) {

            $pRandomAl = generarContraseñaAleatoria();
            $password = $nuevaClave . $pRandomAl;
            $hash1 = hash('sha512', $password);
            $hash2 = hash('sha3-512', $hash1);
            $hash3 = hash('sha3-384', $hash2);
            $hash4 = hash('sha256', $hash3);

            $querybusqueda = "
                SELECT clave_temporal, palabra_random, hora_vencimiento 
                FROM recuperacionContra 
                WHERE id_correo = ( 
                    SELECT ID_CorreoElectronico 
                    FROM Correo_Electronico 
                    WHERE Desc_Correo_Electronico = ? 
                ) 
                AND hora_creacion = ?
            ";
            $stmt_busqueda = sqlsrv_prepare($connection, $querybusqueda, array(&$correo, &$fechacreacion));
            if (!$stmt_busqueda) {
                echo "Error en la preparación de la consulta: " . print_r(sqlsrv_errors(), true);
                exit();
            }
            if (sqlsrv_execute($stmt_busqueda)) {
                $datosEncontrados = array(); 
                while ($fila = sqlsrv_fetch_array($stmt_busqueda, SQLSRV_FETCH_ASSOC)) {
                    $datosEncontrados[] = $fila;
                }
                if (count($datosEncontrados) > 0) {
                    if ($datosEncontrados[0]['hora_vencimiento'] >= date('H:i:s')) {
                        echo "<br><h1>hora valida</h1>";
                        $query = "
                            UPDATE Contrasena_Hash
                            SET Desc_Contrasena_Hash = ?
                            WHERE ID_ContrasenaHash = (
                                SELECT Usuarios_General.id_ContrasenaHash 
                                FROM Usuarios_General 
                                INNER JOIN Correo_Electronico 
                                ON Usuarios_General.id_CorreoElectronico = Correo_Electronico.ID_CorreoElectronico 	
                                WHERE Correo_Electronico.Desc_Correo_Electronico = ? 
                            );
                        ";
                        $params = array($hash4,$correo);
                        $stmt = sqlsrv_prepare($connection, $query, $params);

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
                                echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";  
                                session_destroy();
                                header("Location: ../html/login.php?status=errorConsulta");  
                                exit();
                            } else {
                                $queryPRand = "
                                UPDATE Palabra_Aleatoria 
                                SET Desc_Palabra_Aleatoria = ? 
                                WHERE ID_PalabraAleatoria = ( 
                                    SELECT Usuarios_General.id_PalabraAleatoria 	
                                    FROM Usuarios_General 
                                    INNER JOIN Correo_Electronico 
                                    ON Usuarios_General.id_CorreoElectronico = Correo_Electronico.ID_CorreoElectronico 	
                                    WHERE Correo_Electronico.Desc_Correo_Electronico = ? 
                                )
                                ";  
                                $params = array($pRandomAl,$correo);
                                $stmt = sqlsrv_prepare($connection, $queryPRand, $params);
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
                                        session_destroy();
                                        header("Location: ../html/login.php?status=errPrepConsult");
                                        exit();
                                    } else {
                                        echo "<br><h2>contraseña actualizada</h2>";
                                        header("Location: ../html/login.php?status=complete");
                                    }
                                    // Liberar el conjunto de resultados
                                    sqlsrv_free_stmt($stmt);
                                }
                                // Cierra la conexión
                                sqlsrv_close($connection);
                            }
                        }
                    } else {
                        session_destroy();
                        header("Location: ../html/login.php?status=contraCaducada");
                        exit();  
                    }
                } else {
                    session_destroy();
                    header("Location: ../html/login.php?status=errorUsuario");
                    exit();
                }
            } else {
                echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true);  
                session_destroy();
                header("Location: ../html/login.php?status=errorConsulta");
                exit();
            }
        } else {
            session_destroy();
            header("Location: ../html/login.php?status=contraDiferentes");
            exit();  
        }
    } else {
        header("Location: ../html/login.php?status=contraTemporalError");
        session_destroy();
        exit();  
    }
} else {
    header("Location: ../html/login.php?status=SinData");
    session_destroy();
    exit();
}
// Cierra la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($connection);
?>
