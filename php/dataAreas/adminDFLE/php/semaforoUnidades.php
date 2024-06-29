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

// Consulta base
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
    die("Error al preparar la consulta: " . sqlsrv_errors()[0]['message']);
}

$result = sqlsrv_execute($stmt);

if ($result === false) {
    die("Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message']);
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

?>
    <div class="flex-contStatus">
        <form class="search-barSemaforo" id="searchForm" method="POST" action="">
            <input type="text" id="searchInputSemaforo" name="search" placeholder="Buscar unidad...">
            <button id="btnclearTable" class="btnBusquedaSemaforo" onclick="clearSearch()">Limpiar Búsqueda</button>
        </form>

        <table id="TablaSemaforo">
            <thead>
                <tr>
                    <th></th>
                    <th class="HEstadoProceso" colspan="5">Estado del Proceso</th>
                </tr>
                <tr>
                    <th class="HUnidadesSemaforo">Nombre de la Unidad</th>
                    <th class="SHEstadoNoTrab">No Trabajado</th>
                    <th class="SHEstadoEnProceso">En Proceso</th>
                    <th class="SHEstadoFinPUnidad">Finalizado por Unidad</th>
                    <th class="SHEstadoRevAnalista">Revisado por Analista</th>
                    <th class="SHEstadoRevPJefe">Final (Revisado por Jefe)</th>
                </tr>
            </thead>
            <tbody id="SemaforoBody">
                <?php
                    foreach ($unidadesDatos as $unidad) {
                        echo '
                            <tr>
                                <td class="VUnidadesSemaforo">' . $unidad . '</td>
                                <td class="VEstadoProcesoNo-trabajado"></td>
                                <td class="VEstadoProcesoEn-proceso"></td>
                                <td class="VEstadoProcesoFinalizado"></td>
                                <td class="VEstadoProcesoRevisado-analista"></td>
                                <td class="VEstadoProcesoRevisado-jefe"></td>
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
        $(document).ready(function() {
            // Manejar cambios en el campo de búsqueda
            $('#searchInputSemaforo').on('input', function() {
                var searchTerm = $(this).val();
                loadTable(1, searchTerm);
            });

            // Manejar clics en los elementos de paginación
            $(document).on('click', '.itempag', function() {
                var page = $(this).text();
                var searchTerm = $('#searchInputSemaforo').val();
                loadTable(page, searchTerm);
            });

            function loadTable(page, searchTerm) {
                $.ajax({
                    url: 'semaforoUnidades.php',
                    type: 'POST',
                    data: { page: page, search: searchTerm },
                    success: function(response) {
                        $('#TablaSemaforo').html($(response).find('#TablaSemaforo').html());
                        $('.paginacionSemaforo').html($(response).find('.paginacionSemaforo').html());
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los datos:', error);
                    }
                });
            }

            // Función para limpiar búsqueda (implementa si es necesario)
            $("#btnclearTable").on("click", function() {
                $("#searchInputSemaforo").val("");
                loadTable(1, "");
            });

            // Cargar la tabla con la página 1 y sin búsqueda al iniciar
            loadTable(1, "");
        });
    </script>
</body>
</html>
