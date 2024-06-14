<?php
function obtenerRangoMesesTrimestre() {
    $mes = date('n'); // Obtener el número del mes actual
    $ano = date('Y'); // Obtener el año actual

    // Definir los nombres de los meses
    $nombres_meses = array(
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    );

    // Definir los trimestres y sus meses
    $trimestres = array(
        1 => array(1, 2, 3), // Enero - Marzo
        2 => array(4, 5, 6), // Abril - Junio
        3 => array(7, 8, 9), // Julio - Septiembre
        4 => array(10, 11, 12) // Octubre - Diciembre
    );
    // Determinar el trimestre actual
    if ($mes >= 1 && $mes <= 3) {
        $trimestre_actual = 1;
    } elseif ($mes >= 4 && $mes <= 6) {
        $trimestre_actual = 2;
    } elseif ($mes >= 7 && $mes <= 9) {
        $trimestre_actual = 3;
    } else {
        $trimestre_actual = 4;
    }

    // Obtener los nombres de los meses del trimestre actual
    $meses_trimestre_actual = array();
    foreach ($trimestres[$trimestre_actual] as $num_mes) {
        $meses_trimestre_actual[] = $nombres_meses[$num_mes];
    }

    // Crear el formato de rango
    $rango_meses_trimestre_actual = reset($meses_trimestre_actual) . ' - ' . end($meses_trimestre_actual) . ' ' . $ano;

    // Devolver el formato de rango
    return $rango_meses_trimestre_actual;
}
?>
