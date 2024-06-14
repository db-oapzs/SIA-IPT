<?php

include 'funcContraAl.php';
include '../../../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo'])) {
    echo "<br><br><br>";
    var_dump($_POST);  // Mostrar todos los datos de $_POST para depuración

    function verificarContraseña($contraseña, $hashGuardado, $saltGuardado)
    {
        $contraseñaConSalt = $contraseña . $saltGuardado;
        $hash1 = hash('sha512', $contraseñaConSalt);
        $hash2 = hash('sha3-512', $hash1);
        $hash3 = hash('sha3-384', $hash2);
        $hash4 = hash('sha256', $hash3);
        return ($hash4 === $hashGuardado);
    }

    // Asegúrate de que los índices existen antes de asignarlos
    $dato = [
        'correo' => $_POST['correo'] ?? '',
        'nombreNew' => $_POST['nombre'] ?? '',
        'statusBloqNew' => $_POST['opcEstadoBloq'] ?? '',
        'statusDeshNew' => $_POST['opcEstadoDesh'] ?? '',
        'passwordNew' => $_POST['claseNueva'] ?? '',
        'unidadNew' => (string)$_POST['opcCentroUnidad'],
        'cargoNew' => $_POST['opcCargo'] ?? '',
        'telefonoNew' => $_POST['extencionTel'] ?? '',
        'roll' => $_POST['opcRoll'] ?? '',
        'grado' => $_POST['opcGrado'] ?? ''
    ];

    // Verificación de los valores de status
    $dato['statusDeshNew'] = ($dato['statusDeshNew'] === "deshabilitado") ? 1 : 0;
    $dato['statusBloqNew'] = ($dato['statusBloqNew'] === "bloqueado") ? 1 : 0;

    // Concatenar la contraseña con el valor aleatorio generado
    $correo = $dato['correo'];
    $nombreNew = $dato['nombreNew'];
    $nuevaClave = $dato['passwordNew'];
    $unidadNew = $dato['unidadNew'];
    $statusBloqNew = $dato['statusBloqNew'];
    $statusDeshNew = $dato['statusDeshNew'];
    $cargoNew = $dato['cargoNew'];
    $telefonoNew = $dato['telefonoNew'];
    $grado = $dato['grado'];
    $roll = $dato['roll'];

    // Asegúrate de que la función generarContraseñaAleatoria está definida
    if (!function_exists('generarContraseñaAleatoria')) {
        die("La función generarContraseñaAleatoria no está definida.");
    }

    $pRandomAl = generarContraseñaAleatoria();
    $password = $nuevaClave . $pRandomAl;

    // Generar el hash de la contraseña
    $hash1 = hash('sha512', $password);
    $hash2 = hash('sha3-512', $hash1);
    $hash3 = hash('sha3-384', $hash2);
    $hash4 = hash('sha256', $hash3);
    $nuevaPassHass = $hash4;

    // Mostrar los datos antes de devolver los hashes
    echo "<br><br><br>";
    var_dump($nuevaPassHass);
    echo "<br><br><br>";
    var_dump($pRandomAl);

    // Imprimir los datos enviados si existen
    echo "<h2>Datos recibidos:</h2>";
    if (!empty($dato['correo'])) {
        echo "<p>Correo: " . htmlspecialchars($dato['correo']) . "</p>";

        if (!empty($dato['nombreNew'])) {
            echo "<p>Nombre Nuevo: " . htmlspecialchars($dato['nombreNew']) . "</p>";
            
            $queryNewNombre = '
            UPDATE Nombre_Usuarios 
            SET Desc_Nombre_Usuario = ?
            WHERE (ID_NombreUsuario = 
            (SELECT id_NombreUsuario FROM Usuarios_General WHERE id_CorreoElectronico =
                (SELECT id_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?)
            ))
            ';
            $params = [$dato['nombreNew'], $correo];
            $stmt = sqlsrv_prepare($connection, $queryNewNombre, $params);
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
                    echo "<h2>Actualización de nombre exitosa</h2>";
                }
            }
        }

        if (isset($_POST['opcEstadoBloq'])) {
            echo "<p>statusBloqNew Nueva: " . htmlspecialchars($dato['statusBloqNew']) . "</p>";
            $querrModiStBloq = '
                UPDATE Usuarios_General 
                SET id_EstatusBloqueo = 
                (
                    SELECT ID_EstatusBloqueo FROM Estatus_Bloqueado
                    WHERE 
                    (
                        Desc_Estatus_Bloqueo = ?
                    )
                )
                WHERE id_CorreoElectronico =
                (
                    SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
                )
            ';
            $params = [$dato['statusBloqNew'], $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de stBloq exitosa</h2>";
                }
            }
        }

        if (isset($_POST['opcEstadoDesh'])) {
            echo "<p>statusDes Nueva: " . htmlspecialchars($dato['statusDeshNew']) . "</p>";
            $querrModiStBloq = '
                UPDATE Usuarios_General 
                SET id_EstatusDeshabilitado = 
                (
                    SELECT ID_EstatusDeshabilitado FROM Estatus_Deshabilitado
                    WHERE 
                    (
                        Desc_Estatus_Deshabilitado = ?
                    )
                )
                WHERE id_CorreoElectronico =
                (
                    SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
                )
            ';
            $params = [$dato['statusDeshNew'], $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de stDesha exitosa</h2>";
                }
            }
        }

        if (!empty($dato['passwordNew'])) {
            echo "<p>Contraseña Nueva: " . htmlspecialchars($dato['passwordNew']) . "</p>";
            $querrModiStBloq = '
            UPDATE Contrasena_Hash 
            SET Desc_Contrasena_Hash = ?
            WHERE 
            (
                ID_ContrasenaHash = 
                (
                    SELECT id_ContrasenaHash FROM Usuarios_General WHERE id_CorreoElectronico =
                        (SELECT id_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?)
                )
            )
        
            ';
            $params = [$nuevaPassHass, $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de contraseña exitosa</h2>";
                }
            }
            $querrModiStBloq = '
            UPDATE Palabra_Aleatoria 
            SET Desc_Palabra_Aleatoria = ?
            WHERE 
            (
                ID_PalabraAleatoria = 
                (
                    SELECT id_PalabraAleatoria FROM Usuarios_General WHERE id_CorreoElectronico =
                        (SELECT id_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?)
                )
            )
            ';
            $params = [$pRandomAl, $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de prand exitosa</h2>";
                }
            }
        }
        if (!empty($dato['unidadNew'])) {
            echo "<p>Unidad Nueva: " . htmlspecialchars($dato['unidadNew']) . "</p>";
            $querrModiStBloq = '
            UPDATE Usuarios_General 
            SET id_UnidadAcademica = 
            (
                SELECT ID_UnidadAcademica FROM Unidades_Academicas
                WHERE 
                (
                    Desc_Nombre_Unidad_Academica = ?
                )
            )
            WHERE id_CorreoElectronico =
            (
                SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
            )
        
            ';
            $params = [(string)$_POST['opcCentroUnidad'], $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de unidad exitosa</h2>";
                }
            }
        }
        if (!empty($dato['cargoNew'])) {
            echo "<p>Cargo Nuevo: " . htmlspecialchars($dato['cargoNew']) . "</p>";
            $querrModiStBloq = '
            UPDATE Usuarios_General 
            SET id_Cargo = 
            (
                SELECT ID_Cargo FROM Cargos
                WHERE 
                (
                    Desc_Cargo = ?
                )
            )
            WHERE id_CorreoElectronico =
            (
                SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
            )
            ';
            $params = [$dato['cargoNew'], $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de unidad exitosa</h2>";
                }
            }
        }
        if (!empty($dato['telefonoNew'])) {
            echo "<p>Teléfono Nuevo: " . htmlspecialchars($dato['telefonoNew']) . "</p>";
            $querrModiStBloq = '
            UPDATE Numero_Telefono 
            SET Desc_Numero_Telefono = ?
            WHERE 
            (
                ID_NumeroTelefono = 
                (
                    SELECT id_NumeroTelefono FROM Usuarios_General WHERE id_CorreoElectronico =
                        (SELECT id_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?)
                )
            )
        
            ';
            $params = [$dato['telefonoNew'], $correo];
            $stmt = sqlsrv_prepare($connection, $querrModiStBloq, $params);
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
                    echo "<h2>Actualización de telefono exitosa</h2>";
                }
            }
        }
        if (!empty($dato['grado'])) {
            echo "<p>grado nuevo: " . htmlspecialchars($dato['grado']) . "</p>";
            $queryModifGrado = '
            UPDATE Usuarios_General 
            SET id_Grado = 
            (
                SELECT ID_Grado FROM Grado
                WHERE 
                (
                    Desc_Grado = ?
                )
            )
            WHERE id_CorreoElectronico =
            (
                SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
            )
        
            ';
            $params = [$dato['grado'], $correo];
            $stmt = sqlsrv_prepare($connection, $queryModifGrado, $params);
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
                    echo "<h2>Actualización de grado exitosa</h2>";
                }
            }
        }
        if (!empty($dato['roll'])) {
            echo "<p>grado nuevo: " . htmlspecialchars($dato['roll']) . "</p>";
            $queryModifGrado = '
            UPDATE Usuarios_General 
            SET id_Rol = 
            (
                SELECT ID_Rol FROM Rol_Dentro_Del_Sistema
                WHERE 
                (
                    Desc_Rol = ?
                )
            )
            WHERE id_CorreoElectronico =
            (
                SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?
            )
        
            ';
            $params = [$dato['roll'], $correo];
            $stmt = sqlsrv_prepare($connection, $queryModifGrado, $params);
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
                    echo "<h2>Actualización de grado exitosa</h2>";
                }
            }
        }
    } else {
        echo "<h2>No existe correo</h2>";
    }
    
    header("Location: adminPanel.php?status=successData");
}
?>