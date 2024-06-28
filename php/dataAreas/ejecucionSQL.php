<?php
include '../conexion.php';
include 'objetoDatosTemp.php';
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}
$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$arrayDataSQL_M = array();
$arrayDataSQL_H = array();
$arrayDataDecNivCom = array();
$arrayDataDecNivEd = array();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && isset($_POST["idioma"]) && $_POST['idioma'] != "") {

    $sql = '
    SELECT TOP 24 *
    FROM (
        SELECT * ,
            ROW_NUMBER() OVER (PARTITION BY id_UnidadAcademica, id_Idioma ORDER BY Fecha DESC) AS RowNum
        FROM Cantidades_Alumnos_Temporal
        WHERE id_UnidadAcademica = (
            SELECT ID_UnidadAcademica 
            FROM Unidades_Academicas 
            WHERE Desc_Nombre_Unidad_Academica = ?
        )
        AND id_Idioma = (
            SELECT ID_Idioma 
            FROM Idiomas 
            WHERE Desc_Idioma = ?
        )
    ) AS Ranked
    WHERE RowNum <= 24
    ORDER BY Fecha DESC;
    ';
    $idioma = $_POST['idioma'];
    $params = array($nombre_usuario,$idioma);
    $stmt = sqlsrv_prepare($connection, $sql, $params);

    if ($stmt === false) {
    $img = '';
    //echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
    } else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        $img = '';
    } else {
        // Mostrar los resultados
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $arrayDataSQL_H[] = $row['Desc_Hombres'];
            $arrayDataSQL_M[] = $row['Desc_Mujeres'];
            $arrayDataDecNivCom[] = $row['id_Competencia'];
            $arrayDataDecNivEd[] = $row['id_NivelEducativo'];
        }
    }
    sqlsrv_free_stmt($stmt);
    }

    /*
    var_dump($arrayDataSQL);

    foreach ($arrayDataSQL as $row) {
    echo '<br> ---------------------------------------------------------------';
    foreach ($row as $key => $value) {
        echo '<br><h3>'.$key.' --- '.$value.'</h3>';
    }
    }
    echo '<br> ---------------------------------------------------------------';

    var_dump($arrayDataSQL_H);
    foreach ($arrayDataSQL_H as $key => $value) {
    echo '<br><h3>'.' --- '.$value.'</h3>';
    }
    echo "<br><br><br><br><br>";
    var_dump($arrayDataSQL_M);
    foreach ($arrayDataSQL_M as $key => $value) {
    echo '<br><h3>'.' --- '.$value.'</h3>';
    }
    echo "<br><br><br><br><br>";
    var_dump($arrayDataDecNivCom);
    foreach ($arrayDataDecNivCom as $key => $value) {
    echo '<br><h3>'.' --- '.$value.'</h3>';
    }
    echo "<br><br><br><br><br>";
    var_dump($arrayDataDecNivEd);
    foreach ($arrayDataDecNivEd as $key => $value) {
    echo '<br><h3>'.' --- '.$value.'</h3>';
    }
    */
    $DataPasado = new datosTemp(
        $arrayDataSQL_H,
        $arrayDataSQL_M,
        $idioma
    );

    sqlsrv_close($connection);
    $_SESSION['arrayDataSQL_H'] = $arrayDataSQL_H;
    $_SESSION['arrayDataSQL_M'] = $arrayDataSQL_M;
    $_SESSION['idiomaRecolectado'] = $idioma;

    if(
        isset($_SESSION['arrayDataSQL_H']) 
        && 
        isset($_SESSION['arrayDataSQL_M']) 
        && 
        isset($_SESSION['idiomaRecolectado'])){
        header("Location: cargarData.php?status=DataComplete&idioma=".$idioma);
    }
}else{
    $arrayDataSQL_H[] = 0;
    for($i = 0 ; $i < 24 ; $i++){
        $arrayDataSQL_H[$i] = 0;
        $arrayDataSQL_M[$i] = 0;
    }
    $idiomaRecolectado = '';
    header("Location: cargarData.php?status=IdiomamErr");
    exit();
}
?>