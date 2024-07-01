<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectIdioma']) && !empty($_POST['selectIdioma'])) {
        //echo "<br><h2>  Datos por enviar </h2><br>";
        //var_dump($_POST);

        // Extraer el primer elemento
        $selectIdioma = $_POST['selectIdioma'];
        unset($_POST['selectIdioma']);

        // Colocar el resto de los datos en un nuevo arreglo
        $nuevosDatos = array();
        foreach ($_POST as $key => $value) {
            $nuevosDatos[$key] = $value;
        }

        // Depuración para verificar los resultados
        //echo "<br><h2>  selectIdioma </h2><br>";
        //var_dump($selectIdioma);

        //echo "<br><h2>  Nuevos Datos </h2><br>";
        //var_dump($nuevosDatos);

        foreach ($nuevosDatos as $key => $value) {
            //echo "<br><br><br>";
            //echo "  -- key : " . $key . "   valor  : ";
            //print_r($value); // O var_dump($value);
        }

        for ($i = 1; $i <= count($nuevosDatos); $i++) {
            //echo "<br>";
            // var_dump($nuevosDatos['dato'.$i]);
        }
        //!---------------------------------------------------------------------------------------
        function trimestreAct()
        {
            $mes = date('n'); // Obtener el número del mes actual
            $ano = date('Y'); // Obtener el año actual

            // Definir los nombres de los meses
            $nombres_meses = array(
                1 => 'ENERO',
                2 => 'FEBRERO',
                3 => 'MARZO',
                4 => 'ABRIL',
                5 => 'MAYO',
                6 => 'JUNIO',
                7 => 'JULIO',
                8 => 'AGOSTO',
                9 => 'SEPTIEMBRE',
                10 => 'OCTUBRE',
                11 => 'NOVIEMBRE',
                12 => 'DICIEMBRE'
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
            $rango_meses_trimestre_actual = reset($meses_trimestre_actual) . ' - ' . end($meses_trimestre_actual);

            // Devolver el formato de rango
            return $rango_meses_trimestre_actual;
        }

        function subirData($connection, $params)
        {
            $queryData = '
            INSERT INTO Formato12DFLE_Temporal (Desc_Trimestre, Desc_Tipo_Accion, Desc_AccionFormativa, 
            Desc_Modalidad, id_Idioma, id_UnidadAcademica, Desc_Hombres, Desc_Mujeres, Fecha)
            VALUES (?, ?, ?, ?, 
            (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?), 
            (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?), 
            ?, ?, ?);
            ';

            // Preparar la consulta
            $stmt = sqlsrv_prepare($connection, $queryData, $params);

            // Verificar si la preparación de la consulta falló
            if ($stmt === false) {
                echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
                return false; // Salir de la función si hay un error
            }

            // Ejecutar la consulta
            $result = sqlsrv_execute($stmt);

            // Verificar si la ejecución de la consulta falló
            if ($result === false) {
                echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
                return false; // Salir de la función si hay un error
            }

            // Si todo va bien, imprimir un mensaje de éxito
            //echo "<br><h1>Datos insertados</h1>";
            return true; // Indicar que la operación fue exitosa
        }


        $no_filas = (int) count($nuevosDatos['dato1']);
        $trimestre = trimestreAct();

        for ($i = 0; $i < $no_filas; $i++) {
            for ($j = 1; $j <= count($nuevosDatos); $j++) {
                if (isset($nuevosDatos['dato' . $j][$i])) {


                    $params = [
                        (string) $trimestre,
                        (string) ($nuevosDatos['dato1'][$i]),
                        (string) ($nuevosDatos['dato2'][$i]),
                        (string) ($nuevosDatos['dato3'][$i]),
                        (string) ($nuevosDatos['dato4'][$i]),
                        (string) ($nuevosDatos['dato5'][$i]),
                        (string) ($nuevosDatos['dato6'][$i]),
                        (string) ($nuevosDatos['dato7'][$i]),
                        (string) date('Y-m-d H:i:s')
                    ];

                    subirData($connection, $params);

                    header("Location: CargaActiv.php?status=DatosInsertados");
                    exit();
                }
            }
        }
    } else {
        echo "<br><h2>Error: El campo 'selectIdioma' no está establecido o está vacío.</h2><br>";
        header("Location: CargaActiv.php?status=TrimErrSelect");
        exit();
    }
} else {
    echo "<br><h2>Error: La solicitud no se realizó por el método POST.</h2><br>";
}
?>