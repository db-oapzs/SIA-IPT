<?php
include 'conexion.php';

// Iniciar sesión
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];

    $sql = '
    SELECT CE.Desc_Correo_Electronico
    FROM Usuarios_General UG
    JOIN correo_electronico CE ON UG.id_CorreoElectronico = CE.id_CorreoElectronico 
    WHERE CE.Desc_Correo_Electronico = ?
    ';

    // Preparar la consulta
    $stmt = sqlsrv_prepare($connection, $sql, array($correo));

    if ($stmt === false) {
        // Manejar error de preparación
        echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "<br>";
    } else {
        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);

        if ($result === false) {
            // Manejar error de ejecución
            echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "<br>";
        } else {
            // Verificar si se obtuvieron resultados
            if (sqlsrv_fetch($stmt)) {
                // Guardar el correo en la sesión
                $_SESSION["correo"] = $correo;
                header("Location: ../php/envioCorreo.php");
                exit();
            } else {
                header("Location: ../html/login.php?status=coreoInEXT");
                exit();
            }
        }

        // Liberar el conjunto de resultados
        sqlsrv_free_stmt($stmt);
    }
}

// Cierre de conexión
sqlsrv_close($connection);
?>