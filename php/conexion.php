<?php
// Información de la conexión
$serverName_1 = "localhost"; 
$serverName_2 = "148.204.107.14"; 
//$serverName_2 = "10.102.161.208"; 
$database_1 = "DFLE_Desarrollo"; 
$database_2 = "DFLE_Desarrollo"; 
//$database_2 = "DFLE_Produccion";
$username = "sa";
$password_1 = "3912";
$password_2 = "!TP@951DII";
//$password_2 = "12345";

$status = true;

//casa -> true
//servicio -> false

$connectionOptions = array(
    "Database" => $status ? $database_1 : $database_2,
    "UID" => $username,
    "PWD" => $status ? $password_1 : $password_2,
    "CharacterSet" => "UTF-8"
);

// Selecciona el servidor basado en el estado
$serverName = $status ? $serverName_1 : $serverName_2;

// Realiza la conexión
$connection = sqlsrv_connect($serverName, $connectionOptions);

// Verifica si la conexión fue exitosa
if ($connection === false) {
    echo "Error al conectar con SQL Server: ";
    foreach (sqlsrv_errors() as $error) {
        echo $error['message'] . "<br>";
    }
    exit(); // Salir si la conexión falla
} else {
    // La conexión fue exitosa
    //echo "Conexión con SQL Server exitosa<br>";
}
?>
