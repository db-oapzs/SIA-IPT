<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');

include 'menuFinal.php';
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

// Obtener el número de página actual
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$elementsPerPage = 10;
$startFrom = ($page - 1) * $elementsPerPage;

// Obtener el término de búsqueda del formulario
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Consulta base para obtener unidades académicas
$queryUnidades = "
    SELECT Desc_Nombre_Unidad_Academica 
    FROM Unidades_Academicas 
";

// Si hay un término de búsqueda, aplicar filtro
if (!empty($searchTerm)) {
    $queryUnidades .= "
        WHERE Desc_Nombre_Unidad_Academica LIKE '%$searchTerm%'
    ";
}

$queryUnidades .= "
    ORDER BY Desc_Nombre_Unidad_Academica ASC
    OFFSET $startFrom ROWS FETCH NEXT $elementsPerPage ROWS ONLY
";

$unidades = array();

$stmt = sqlsrv_prepare($connection, $queryUnidades);
if ($stmt === false) {
    die("Error al preparar la consulta de unidades académicas: " . sqlsrv_errors()[0]['message']);
}

$result = sqlsrv_execute($stmt);

if ($result === false) {
    die("Error al ejecutar la consulta de unidades académicas: " . sqlsrv_errors()[0]['message']);
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $unidades[] = $row['Desc_Nombre_Unidad_Academica'];
}

// Calcular número total de registros para la paginación
$queryTotal = "SELECT COUNT(*) AS total FROM Unidades_Academicas";
if (!empty($searchTerm)) {
    $queryTotal .= "
        WHERE Desc_Nombre_Unidad_Academica LIKE '%$searchTerm%'
    ";
}

$stmtTotal = sqlsrv_prepare($connection, $queryTotal);
if ($stmtTotal === false) {
    die("Error al preparar la consulta para contar el total de registros: " . sqlsrv_errors()[0]['message']);
}

$resultTotal = sqlsrv_execute($stmtTotal);
if ($resultTotal === false) {
    die("Error al ejecutar la consulta para contar el total de registros: " . sqlsrv_errors()[0]['message']);
}

$totalRows = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC)['total'];
$totalPages = ceil($totalRows / $elementsPerPage);

// Directorio de archivos
$ficheroArchivos = '../../../exelDFLE/unidades';

// Verificar si el directorio existe
if (!is_dir($ficheroArchivos)) {
    die("El directorio no existe.");
}

// Arrays para clasificar los archivos
$archivos4T = [];

// Abrir el directorio
if ($handle = opendir($ficheroArchivos)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (strpos($entry, "4 DFLE_") !== false) {
                $archivos4T[] = $entry;
            }
        }
    }
    closedir($handle);
} else {
    die("No se pudo abrir el directorio.");
}

// Función para buscar en el arreglo
function buscarEnArreglo($archivos4T, $dato) {
    foreach ($archivos4T as $archivo) {
        if (strpos($archivo, $dato) !== false) {
            return '<div class="trabajadoItem gg-check-r"></div>';
        }
    }
    return '<div class="trabajadoItem gg-close-r"></div>';
}

// Si es una solicitud AJAX, solo devolvemos los datos de la tabla
if (isset($_POST['ajax'])) {
    foreach ($unidades as $unidad) {
        echo '
            <form class="formDataUnValDesc" method="POST" action="">
                <div class="contItemFormEx">' . htmlspecialchars($unidad) . '</div>
                <div class="contItemFormEx">' . buscarEnArreglo($archivos4T, $unidad) . '</div>
                <div class="contItemFormEx">
                
                    <input type="hidden" name="Unidad" value="'.$unidad.'"/>
                    <input
                        type="submit"
                        value="Descargar"
                        class="btnFormEx btnDescargar"
                    />
                </div>
                <div class="contItemFormEx">
                    <input
                        type="submit"
                        value="Validar"
                        class="btnFormEx btnValidar"
                    />
                </div>
            </form>
        ';
    }
    exit();
}




?>

<style>
    .ContValiExcelHola { padding: 20px; }
    .formContDtEx, .formDataUnValDesc { margin-bottom: 10px; }
    .contTableItems { margin-top: 20px; }
    .contItemFormEx { margin: 5px; display: inline-block; }
    .itemPag { display: inline-block; margin: 5px; cursor: pointer; }
</style>
<div class="ContValiExcelHola">
    <div class="textExcelDt">
        <p>Verificación de Excel por Unidad Académica</p>
    </div>
    <div class="formContDtEx">
        <form class="formDExelVal" onsubmit="return false;">
            <input 
                type="text"
                placeholder="Buscar Unidad"
                name="search"
                class="barrBuscarExcel"
                id="searchInputSemaforo"
            />
            <button id="btnLimpiarBarrEx" type="button" name="BotonLimpiar">Limpiar</button>
        </form>
    </div>
    <ul id="cabTableEx">
        <li>Unidad Academica</li>
        <li>Excel</li>
        <li>Descargar</li>
        <li>Validar</li>
    </ul>
    <div class="contTableItems">
        <?php
        foreach ($unidades as $unidad) {
            echo '
                <form class="formDataUnValDesc" method="POST" action="">
                    <div class="contItemFormEx">' . htmlspecialchars($unidad) . '</div>
                    <div class="contItemFormEx">' . buscarEnArreglo($archivos4T, $unidad) . '</div>
                    <div class="contItemFormEx">
                        <input type="hidden" name="Unidad" value="'.$unidad.'"/>
                        <input
                            type="submit"
                            value="Descargar"
                            class="btnFormEx btnDescargar"
                        />
                    </div>
                    <div class="contItemFormEx">
                        <input
                            type="submit"
                            value="Validar"
                            class="btnFormEx btnValidar"
                        />
                    </div>
                </form>
            ';
        }
        ?>
    </div>
    <div class="paginasData">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<div class="itemPag" data-page="' . $i . '">' . $i . '</div>';
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        function fetchResults(query = '', page = 1) {
            $.ajax({
                url: 'excelesVerificacion.php',
                method: 'POST',
                data: { search: query, page: page, ajax: true },
                success: function(data) {
                    $('.contTableItems').html(data);
                    updatePagination(query, page);
                }
            });
        }

        $('#searchInputSemaforo').on('keyup', function() {
            const query = $(this).val();
            fetchResults(query);
        });

        $('#btnLimpiarBarrEx').on('click', function() {
            $('#searchInputSemaforo').val('');
            fetchResults();
        });

        $(document).on('click', '.itemPag', function() {
            const page = $(this).data('page');
            const query = $('#searchInputSemaforo').val();
            fetchResults(query, page);
        });

        function updatePagination(query, currentPage) {
            $.ajax({
                url: 'excelesVerificacion.php',
                method: 'POST',
                data: { search: query },
                success: function(data) {
                    const totalPages = $(data).find('.itemPag').length;
                    $('.paginasData').html('');
                    for (let i = 1; i <= totalPages; i++) {
                        $('.paginasData').append('<div class="itemPag" data-page="' + i + '">' + i + '</div>');
                    }
                    $('.itemPag[data-page="' + currentPage + '"]').addClass('active');
                }
            });
        }

        fetchResults();

        $(document).on('mouseover', '.btnDescargar', function() {
            let form = $(this).closest('form');
            form.attr('action', 'descargarExUa.php');
            console.log("Nuevo action del formulario:", form.attr('action'));
        });

        $(document).on('mouseout', '.btnDescargar', function() {
            let form = $(this).closest('form');
            form.attr('action', 'indefinido');
            console.log("Nuevo action del formulario:", form.attr('action'));
        });

        $(document).on('mouseover', '.btnValidar', function() {
            let form = $(this).closest('form');
            form.attr('action', 'validarExUa.php');
            console.log("Nuevo action del formulario:", form.attr('action'));
        });

        $(document).on('mouseout', '.btnValidar', function() {
            let form = $(this).closest('form');
            form.attr('action', 'indefinido');
            console.log("Nuevo action del formulario:", form.attr('action'));
        });
    });
</script>
</html>
