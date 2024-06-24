<?php

var_dump($_POST);
$datosVaraibles = ' 
    INSERT INTO FAES_DFLE_Indicadores(
    Clave_Indicador, 
    Variable, 
    PRIMER_TRIM, 
    SEGUNDO_TRIM, 
    TERCER_TRIM, 
    CUARTO_TRIM, 
    Fecha)
    VALUES(?, ?, ?, ?, ?, ?, ?)
';
$fecha = date('d-m-Y H:i:s');
?>