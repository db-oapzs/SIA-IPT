
<?php
    date_default_timezone_set('America/Mexico_City');
    session_start();
    if (!isset($_SESSION['correo'])) {
        header("Location: ../../../../html/login.php?status=sessionCad");
        exit();
    }
    require '../../../vendor/autoload.php';
    header('Content-Type: text/html; charset=utf-8');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    include '../../../conexion.php';
    
    $correo = $_SESSION['correo'];
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $roll = $_SESSION['roll'];
    //var_dump($_SESSION);

    $fecha = date('Y'); 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
        //var_dump($_POST);
        header('Location: llenadoEx1F6.php');
        exit();
    }
?>