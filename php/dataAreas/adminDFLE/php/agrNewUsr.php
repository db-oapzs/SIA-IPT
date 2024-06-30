<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../funcContraAl.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) && isset($_POST['correoEmail'])) {

    $queryVerifiCorreo = '
    SELECT CASE WHEN EXISTS (
        SELECT 1
        FROM [DFLE_Desarrollo].[dbo].[Correo_Electronico]
        WHERE Desc_Correo_Electronico = ?
    ) THEN CAST(1 AS BIT) ELSE CAST(0 AS BIT) END AS EmailExists;
';

    // Preparar los parámetros para la consulta
    $correoElectronico = $_POST['correoEmail']; // Reemplaza con el correo que deseas verificar
    $params = array($correoElectronico);

    // Preparar la consulta
    $stmt = sqlsrv_prepare($connection, $queryVerifiCorreo, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            // Obtener el resultado
            if (sqlsrv_fetch($stmt) === true) {
                $emailExists = sqlsrv_get_field($stmt, 0); // Obtener el valor de la columna EmailExists
                echo "El correo electrónico existe en la tabla: " . ($emailExists ? 'Sí' : 'No');
                if (($emailExists ? 'Si' : 'No') === 'Si') {
                    header("Location: adminPanel.php?status=errorCorreo");
                    exit();
                } else {
                    //var_dump($_POST);
                    $pRandomAl = generarContraseñaAleatoria();
                    $password = $_POST['claveUrs'] . $pRandomAl;
                    $hash1 = hash('sha512', $password);
                    $hash2 = hash('sha3-512', $hash1);
                    $hash3 = hash('sha3-384', $hash2);
                    $hash4 = hash('sha256', $hash3);
                    $clanehass = $hash4;
                    $statusBlock = 1;
                    $statusDess = 1;

                    // Verificar si los campos están definidos en el array $_POST
                    $usuario = array(
                        "nombre" => $_POST['nombreUrs'] ?? null,
                        "clave" => $clanehass,
                        "palRandom" => $pRandomAl,
                        "statusBlock" => $statusBlock,
                        "statusDess" => $statusDess,
                        "correo" => $_POST['correoEmail'] ?? null,
                        "unidad" => $_POST['opcCentroUnidad'] ?? null,
                        "cargo" => $_POST['opcCargo'] ?? null,
                        "telefono" => $_POST['telefono'] ?? null,
                        "rolls" => $_POST['opcRoll'] ?? null,
                        "grado" => $_POST['opcGradoAc'] ?? null
                    );

                    // Puedes agregar validaciones adicionales aquí, por ejemplo, si algún campo es obligatorio
                    if (in_array(null, $usuario, true)) {
                        echo "<br><h2>Error: Faltan datos requeridos</h2>";
                    } else {
                        // Inserción en tablas individuales
                        $queries = [
                            'Nombre_Usuarios' => 'INSERT INTO Nombre_Usuarios (Desc_Nombre_Usuario) VALUES (?)',
                            'Contrasena_Hash' => 'INSERT INTO Contrasena_Hash (Desc_Contrasena_Hash) VALUES (?)',
                            'Palabra_Aleatoria' => 'INSERT INTO Palabra_Aleatoria (Desc_Palabra_Aleatoria) VALUES (?)',
                            'Correo_Electronico' => 'INSERT INTO Correo_Electronico (Desc_Correo_Electronico) VALUES (?)',
                            'Numero_Telefono' => 'INSERT INTO Numero_Telefono (Desc_Numero_Telefono) VALUES (?)'
                        ];

                        $params = [
                            'Nombre_Usuarios' => [$usuario['nombre']],
                            'Contrasena_Hash' => [$usuario['clave']],
                            'Palabra_Aleatoria' => [$usuario['palRandom']],
                            'Correo_Electronico' => [$usuario['correo']],
                            'Numero_Telefono' => [$usuario['telefono']]
                        ];

                        foreach ($queries as $table => $query) {
                            $stmt = sqlsrv_prepare($connection, $query, $params[$table]);
                            if ($stmt === false) {
                                echo "Error al preparar la consulta para $table: " . print_r(sqlsrv_errors(), true) . "\n";
                                continue;
                            }

                            $result = sqlsrv_execute($stmt);
                            if ($result === false) {
                                echo "Error al ejecutar la consulta para $table: " . print_r(sqlsrv_errors(), true) . "\n";
                            }
                        }

                        // Obtener IDs insertados
                        $nombreID = sqlsrv_query($connection, "SELECT ID_NombreUsuario FROM Nombre_Usuarios WHERE Desc_Nombre_Usuario = ?", [$usuario['nombre']]);
                        $claveID = sqlsrv_query($connection, "SELECT ID_ContrasenaHash FROM Contrasena_Hash WHERE Desc_Contrasena_Hash = ?", [$usuario['clave']]);
                        $palabraID = sqlsrv_query($connection, "SELECT ID_PalabraAleatoria FROM Palabra_Aleatoria WHERE Desc_Palabra_Aleatoria = ?", [$usuario['palRandom']]);
                        $correoID = sqlsrv_query($connection, "SELECT ID_CorreoElectronico FROM Correo_Electronico WHERE Desc_Correo_Electronico = ?", [$usuario['correo']]);
                        $telefonoID = sqlsrv_query($connection, "SELECT ID_NumeroTelefono FROM Numero_Telefono WHERE Desc_Numero_Telefono = ?", [$usuario['telefono']]);

                        $queryInsertComplete = '
                        INSERT INTO Usuarios_General (id_NombreUsuario, id_ContrasenaHash, id_PalabraAleatoria, id_EstatusBloqueo, id_EstatusDeshabilitado, id_CorreoElectronico, id_UnidadAcademica, id_Cargo, id_NumeroTelefono, id_Rol, id_Grado)
                        VALUES (?, ?, ?, ?, ?, ?, 
                            (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?), 
                            (SELECT ID_Cargo FROM Cargos WHERE Desc_Cargo = ?), 
                            ?, 
                            (SELECT ID_Rol FROM Rol_Dentro_Del_Sistema WHERE Desc_Rol = ?),
                            (SELECT ID_Grado FROM Grado WHERE Desc_Grado = ?)
                            )';

                        $paramsComplete = [
                            sqlsrv_fetch_array($nombreID)['ID_NombreUsuario'],
                            sqlsrv_fetch_array($claveID)['ID_ContrasenaHash'],
                            sqlsrv_fetch_array($palabraID)['ID_PalabraAleatoria'],
                            $statusBlock,
                            $statusDess,
                            sqlsrv_fetch_array($correoID)['ID_CorreoElectronico'],
                            $usuario['unidad'],
                            $usuario['cargo'],
                            sqlsrv_fetch_array($telefonoID)['ID_NumeroTelefono'],
                            $usuario['rolls'],
                            $usuario['grado']
                        ];

                        $stmt = sqlsrv_prepare($connection, $queryInsertComplete, $paramsComplete);
                        if ($stmt === false) {
                            echo "Error al preparar la consulta final: " . print_r(sqlsrv_errors(), true) . "\n";
                        } else {
                            $result = sqlsrv_execute($stmt);
                            if ($result === false) {
                                echo "Error al ejecutar la consulta final: " . print_r(sqlsrv_errors(), true) . "\n";
                            } else {
                                //echo "Usuario insertado con éxito"; 
                                header("Location: adminPanel.php?status=succesInsertU");
                                exit();
                            }
                        }
                    }
                }
            } else {
                echo "No se encontraron resultados.";
            }
        }
        // Liberar el conjunto de resultados
        sqlsrv_free_stmt($stmt);
    }


} else {
    echo "<br><h2>Error: Datos no encontrados en el servidor</h2>";
}
?>