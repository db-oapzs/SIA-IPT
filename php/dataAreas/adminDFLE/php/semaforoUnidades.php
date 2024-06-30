<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include 'menuFinal.php';

// Obtener el número de página actual
$page = isset($_POST['page']) ? $_POST['page'] : 1;

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

$unidadesDatos = array();

$stmt = sqlsrv_prepare($connection, $queryUnidades);
if ($stmt === false) {
    die("Error al preparar la consulta de unidades académicas: " . sqlsrv_errors()[0]['message']);
}

$result = sqlsrv_execute($stmt);

if ($result === false) {
    die("Error al ejecutar la consulta de unidades académicas: " . sqlsrv_errors()[0]['message']);
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $unidadesDatos[] = $row['Desc_Nombre_Unidad_Academica'];
}

// Calcular número total de registros para la paginación
$queryTotal = "SELECT COUNT(*) AS total FROM Unidades_Academicas";

// Si hay término de búsqueda, ajustar la consulta total
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

/**
 * Función para obtener información específica de una unidad académica.
 * Utiliza una consulta preparada para mayor seguridad.
 *
 * @param string $_unidad Nombre de la unidad académica a buscar.
 * @param resource $connection Conexión activa a la base de datos.
 * @return string|null Devuelve el ID de la unidad académica si se encuentra, o NULL si no hay resultados.
 */
function dataUnidad($_unidad, $connection)
{
    $queryInfoUnidad = "
        SELECT DISTINCT id_UnidadAcademica
        FROM Cantidades_Alumnos_Temporal
        WHERE id_UnidadAcademica = (
            SELECT ID_UnidadAcademica
            FROM Unidades_Academicas
            WHERE Desc_Nombre_Unidad_Academica = ?
        )
    ";
    $params = [$_unidad];
    $dto1 = null;
    $stmt = sqlsrv_prepare($connection, $queryInfoUnidad, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto1;
    }
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto1;
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dto1 = $row['id_UnidadAcademica'];
    }



    $queryInfoUnidad2 = "
        SELECT DISTINCT id_UnidadAcademica
        FROM Cantidades_Alumnos
        WHERE id_UnidadAcademica = (
            SELECT ID_UnidadAcademica
            FROM Unidades_Academicas
            WHERE Desc_Nombre_Unidad_Academica = ?
        )
    ";

    $dto2 = null;
    $stmt = sqlsrv_prepare($connection, $queryInfoUnidad2, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto2;
    }
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto2;
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dto2 = $row['id_UnidadAcademica'];
    }

    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);

    // Primer bloque condicional
    if (empty($dto1) && empty($dto2)) {
        return '<div class="trabajadoItem gg-close-r"></div>';
    }else{
        return '<div class="trabajadoItem gg-check-r"></div>';
    }
}
function dataUnidad2($_unidad, $connection)
{
    $queryInfoUnidad = "
        SELECT DISTINCT id_UnidadAcademica
        FROM Cantidades_Alumnos_Temporal
        WHERE id_UnidadAcademica = (
            SELECT ID_UnidadAcademica
            FROM Unidades_Academicas
            WHERE Desc_Nombre_Unidad_Academica = ?
        )
    ";
    $params = [$_unidad];
    $dto1 = null;
    $stmt = sqlsrv_prepare($connection, $queryInfoUnidad, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto1;
    }
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto1;
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dto1 = $row['id_UnidadAcademica'];
    }



    $queryInfoUnidad2 = "
        SELECT DISTINCT id_UnidadAcademica
        FROM Cantidades_Alumnos
        WHERE id_UnidadAcademica = (
            SELECT ID_UnidadAcademica
            FROM Unidades_Academicas
            WHERE Desc_Nombre_Unidad_Academica = ?
        )
    ";

    $dto2 = null;
    $stmt = sqlsrv_prepare($connection, $queryInfoUnidad2, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto2;
    }
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return $dto2;
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dto2 = $row['id_UnidadAcademica'];
    }

    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);

    // Primer bloque condicional
    if (!empty($dto1) && empty($dto2)) {
        return '<div class="trabajadoItem gg-check-r"></div>';
    }else{
        return '<div class="trabajadoItem gg-close-r"></div>';
    }
}




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
            return $archivo;
        }
    }
    return 'false';
}
function dataUniExcel($connection, $archivos4T, $dato,$stadoQ) {
    if($stadoQ === 1){
        $queryVerifi = '
            SELECT COALESCE(MAX(CASE WHEN ValidadoAnalista = 1 THEN 1 ELSE 0 END), 0) AS ValidadoAnalista
            FROM [DFLE_Desarrollo].[dbo].[RegistroValidaciones] RV
            JOIN [DFLE_Desarrollo].[dbo].[Unidades_Academicas] UA ON RV.id_UnidadAcademica = UA.ID_UnidadAcademica
            WHERE UA.Desc_Nombre_Unidad_Academica = ?
            AND RV.NombreDelExcel = ?
        ';
    } 
    if($stadoQ === 2){
        $queryVerifi = '
            SELECT COALESCE(MAX(CASE WHEN [ValidadoJefeAnalistas] = 1 THEN 1 ELSE 0 END), 0) AS ValidadoAnalista
            FROM [DFLE_Desarrollo].[dbo].[RegistroValidaciones] RV
            JOIN [DFLE_Desarrollo].[dbo].[Unidades_Academicas] UA ON RV.id_UnidadAcademica = UA.ID_UnidadAcademica
            WHERE UA.Desc_Nombre_Unidad_Academica = ?
            AND RV.NombreDelExcel = ?;
        ';
    }

    $params = [$dato, buscarEnArreglo($archivos4T, $dato)];

    $stmt = sqlsrv_prepare($connection, $queryVerifi, $params);
    if ($stmt === false) {
        echo "Error al preparar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return '<div class="trabajadoItem gg-close-r"></div>'; // Devolver HTML de error en caso de fallo
    }

    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta para obtener información de la unidad académica: " . sqlsrv_errors()[0]['message'] . "\n";
        return '<div class="trabajadoItem gg-close-r"></div>'; // Devolver HTML de error en caso de fallo
    }

    $registroExiste = false; 
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $registroExiste = $row['ValidadoAnalista']; 
    }

    sqlsrv_free_stmt($stmt);

    if ($registroExiste === 1) {
        return '<div class="trabajadoItem gg-check-r"></div>';
    } else {
        return '<div class="trabajadoItem gg-close-r"></div>'; 
    }
}



?>

    <div class="flex-contStatus">
        <form class="search-barSemaforo" id="searchForm" method="POST" action="">
            <input type="text" id="searchInputSemaforo" name="search" placeholder="Buscar unidad...">
            <button id="btnclearTable" class="btnBusquedaSemaforo">Limpiar Búsqueda</button>
        </form>

        <table id="TablaSemaforo">
            <thead>
                <tr>
                    <th></th>
                    <th class="HEstadoProceso" colspan="5">Estado del Proceso</th>
                </tr>
                <tr>
                    <th class="HUnidadesSemaforo">Nombre de la Unidad</th>
                    <th class="SHEstadoNoTrab">Trabajado</th>
                    <th class="SHEstadoEnProceso">En Proceso</th>
                    <th class="SHEstadoFinPUnidad">Finalizado por Unidad</th>
                    <th class="SHEstadoRevAnalista">Revisado por Analista</th>
                    <th class="SHEstadoRevPJefe">Revisado por Jefe</th>
                </tr>
            </thead>
            <tbody id="SemaforoBody">
                <?php
                foreach ($unidadesDatos as $unidad) {
                    echo '
                        <tr>
                            <td class="VUnidadesSemaforo">' . $unidad . '</td>
                            <td class="VEstadoProcesoNo-trabajado">' . dataUnidad($unidad, $connection) . '</td>
                            <td class="VEstadoProcesoEn-proceso">' . dataUnidad($unidad, $connection) . '</td>
                            <td class="VEstadoProcesoFinalizado">' . dataUnidad2($unidad, $connection) . '</td>
                            <td class="VEstadoProcesoRevisado-analista">'.dataUniExcel($connection, $archivos4T, $unidad, 1).'</td>
                            <td class="VEstadoProcesoRevisado-jefe">'.dataUniExcel($connection, $archivos4T, $unidad , 2).'</td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>

        <div class="paginacionSemaforo">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<div class="itempag">' . $i . '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInputSemaforo').on('input', function () {
                var searchTerm = $(this).val();
                loadTable(1, searchTerm);
            });

            $(document).on('click', '.itempag', function () {
                var page = $(this).text();
                var searchTerm = $('#searchInputSemaforo').val();
                loadTable(page, searchTerm);
            });

            function loadTable(page, searchTerm) {
                $.ajax({
                    url: 'semaforoUnidades.php',
                    type: 'POST',
                    data: { page: page, search: searchTerm },
                    success: function (response) {
                        $('#TablaSemaforo').html($(response).find('#TablaSemaforo').html());
                        $('.paginacionSemaforo').html($(response).find('.paginacionSemaforo').html());
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al cargar los datos:', error);
                    }
                });
            }

            $("#btnclearTable").on("click", function () {
                $("#searchInputSemaforo").val("");
                loadTable(1, "");
            });

            loadTable(1, "");
        });
    </script>
</body>
</html>
