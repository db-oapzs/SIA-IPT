<?php

function passHass($contra){
    $prandom = random_bytes(24); 
    $password = $contra . $prandom;
    $hash1 = hash('sha512', $password);
    $hash2 = hash('sha3-512', $hash1);
    $hash3 = hash('sha3-384', $hash2);
    $hash4 = hash('sha256', $hash3);
    return array('hash' => $hash4, 'prand' => $prandom);
}
function verificarContraseña($contraseña, $hashGuardado, $saltGuardado) {
    $contraseñaConSalt = $contraseña . $saltGuardado;
    $hash1 = hash('sha512', $contraseñaConSalt);
    $hash2 = hash('sha3-512', $hash1);
    $hash3 = hash('sha3-384', $hash2);
    $hash4 = hash('sha256', $hash3);
    return ($hash4 === $hashGuardado);
}
/*
$contraseña = "hola";

$datosHash = passHass($contraseña);

$hashGuardado = $datosHash['hash'];
$prandGuardada = $datosHash['prand'];

echo "Hash guardado: $hashGuardado<br>";
echo "Prand guardado: " . bin2hex($prandGuardada) . "<br>";

$contraseñaUsuario = "hola";


echo "Contraseña ingresada: " . ($contraseñaUsuario) . "<br>";


if (verificarContraseña($contraseñaUsuario, $hashGuardado, $prandGuardada)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}

*/

?>