<?php


function generarContraseñaAleatoria() {
    // Expresiones regulares para validar si la contraseña cumple con los requisitos
    $regexNumero = '/[0-9]/';
    $regexMinuscula = '/[a-z]/';
    $regexMayuscula = '/[A-Z]/';
    $regexEspecial = '/[#$&%]/';

    // Lista de caracteres posibles para cada tipo
    $caracteresNumeros = '0123456789';
    $caracteresMinusculas = 'abcdefghijklmnopqrstuvwxyz';
    $caracteresMayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caracteresEspeciales = '#$&%';

    // Inicializa la contraseña como una cadena vacía
    $contraseña = '';

    // Genera la contraseña aleatoria asegurando al menos un carácter de cada tipo
    $contraseña .= $caracteresNumeros[random_int(0, strlen($caracteresNumeros) - 1)];
    $contraseña .= $caracteresMinusculas[random_int(0, strlen($caracteresMinusculas) - 1)];
    $contraseña .= $caracteresMayusculas[random_int(0, strlen($caracteresMayusculas) - 1)];
    $contraseña .= $caracteresEspeciales[random_int(0, strlen($caracteresEspeciales) - 1)];

    // Completa la contraseña hasta alcanzar la longitud deseada
    $longitudContraseña = 8;
    for ($i = 4; $i < $longitudContraseña; $i++) {
        // Selecciona aleatoriamente un tipo de carácter
        $tipoCaracter = random_int(0, 3);
        switch ($tipoCaracter) {
            case 0:
                // Número
                $contraseña .= $caracteresNumeros[random_int(0, strlen($caracteresNumeros) - 1)];
                break;
            case 1:
                // Letra minúscula
                $contraseña .= $caracteresMinusculas[random_int(0, strlen($caracteresMinusculas) - 1)];
                break;
            case 2:
                // Letra mayúscula
                $contraseña .= $caracteresMayusculas[random_int(0, strlen($caracteresMayusculas) - 1)];
                break;
            case 3:
                // Carácter especial
                $contraseña .= $caracteresEspeciales[random_int(0, strlen($caracteresEspeciales) - 1)];
                break;
        }
    }

    // Mezcla los caracteres de la contraseña
    $contraseña = str_shuffle($contraseña);

    // Verifica si la contraseña cumple con los requisitos utilizando expresiones regulares
    $cumpleNumero = preg_match($regexNumero, $contraseña);
    $cumpleMinuscula = preg_match($regexMinuscula, $contraseña);
    $cumpleMayuscula = preg_match($regexMayuscula, $contraseña);
    $cumpleEspecial = preg_match($regexEspecial, $contraseña);

    // Si la contraseña no cumple con los requisitos, genera una nueva
    if (!($cumpleNumero && $cumpleMinuscula && $cumpleMayuscula && $cumpleEspecial)) {
        return generarContraseñaAleatoria();
    }

    return $contraseña;
}

?>