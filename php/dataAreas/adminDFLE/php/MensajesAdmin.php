<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$perPage = 5; 
$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

$offset = ($page - 1) * $perPage;

$queryUsers = "
    SELECT 
        g.Desc_Grado,
        nu.Desc_Nombre_Usuario,
        ch.Desc_Contrasena_Hash,
        eb.Desc_Estatus_Bloqueo,
        ed.Desc_Estatus_Deshabilitado,
        ua.Desc_Nombre_Unidad_Academica,
        c.Desc_Cargo,
        nt.Desc_Numero_Telefono,
        r.Desc_Rol,
        ce.Desc_Correo_Electronico
    FROM 
        Usuarios_General ug
    LEFT JOIN
        Grado g ON ug.id_Grado = g.ID_Grado
    LEFT JOIN 
        Nombre_Usuarios nu ON ug.id_NombreUsuario = nu.ID_NombreUsuario
    LEFT JOIN 
        Contrasena_Hash ch ON ug.id_ContrasenaHash = ch.ID_ContrasenaHash
    LEFT JOIN 
        Estatus_Bloqueado eb ON ug.id_EstatusBloqueo = eb.ID_EstatusBloqueo
    LEFT JOIN 
        Estatus_Deshabilitado ed ON ug.id_EstatusDeshabilitado = ed.ID_EstatusDeshabilitado
    LEFT JOIN 
        Unidades_Academicas ua ON ug.id_UnidadAcademica = ua.ID_UnidadAcademica
    LEFT JOIN 
        Cargos c ON ug.id_Cargo = c.ID_Cargo
    LEFT JOIN 
        Numero_Telefono nt ON ug.id_NumeroTelefono = nt.ID_NumeroTelefono
    LEFT JOIN 
        Rol_Dentro_Del_Sistema r ON ug.id_Rol = r.ID_Rol
    LEFT JOIN
        Correo_Electronico ce ON ug.id_CorreoElectronico = ce.ID_CorreoElectronico
    WHERE 
        nu.Desc_Nombre_Usuario LIKE ? OR 
        ua.Desc_Nombre_Unidad_Academica LIKE ? OR 
        c.Desc_Cargo LIKE ? OR
        nt.Desc_Numero_Telefono LIKE ? OR
        ce.Desc_Correo_Electronico LIKE ?
    ORDER BY 
        nu.Desc_Nombre_Usuario
    OFFSET ? ROWS FETCH NEXT ? ROWS ONLY
";

$params = [
    "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%",
    $offset, $perPage
];

$stmt = sqlsrv_prepare($connection, $queryUsers, $params);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    exit;
}
$result = sqlsrv_execute($stmt);
if ($result === false) {
    echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    exit;
}

$users = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $users[] = $row;
}

sqlsrv_free_stmt($stmt);

$queryCount = "
    SELECT COUNT(*) as total
    FROM 
        Usuarios_General ug
    LEFT JOIN 
        Nombre_Usuarios nu ON ug.id_NombreUsuario = nu.ID_NombreUsuario
    LEFT JOIN 
        Contrasena_Hash ch ON ug.id_ContrasenaHash = ch.ID_ContrasenaHash
    LEFT JOIN 
        Estatus_Bloqueado eb ON ug.id_EstatusBloqueo = eb.ID_EstatusBloqueo
    LEFT JOIN 
        Estatus_Deshabilitado ed ON ug.id_EstatusDeshabilitado = ed.ID_EstatusDeshabilitado
    LEFT JOIN 
        Unidades_Academicas ua ON ug.id_UnidadAcademica = ua.ID_UnidadAcademica
    LEFT JOIN 
        Cargos c ON ug.id_Cargo = c.ID_Cargo
    LEFT JOIN 
        Numero_Telefono nt ON ug.id_NumeroTelefono = nt.ID_NumeroTelefono
    LEFT JOIN 
        Rol_Dentro_Del_Sistema r ON ug.id_Rol = r.ID_Rol
    LEFT JOIN 
        Correo_Electronico ce ON ug.id_CorreoElectronico = ce.ID_CorreoElectronico
    WHERE 
        nu.Desc_Nombre_Usuario LIKE ? OR 
        ua.Desc_Nombre_Unidad_Academica LIKE ? OR 
        c.Desc_Cargo LIKE ? OR
        nt.Desc_Numero_Telefono LIKE ? OR
        ce.Desc_Correo_Electronico LIKE ?
";

$paramsCount = [
    "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%", "%$searchQuery%"
];

$stmtCount = sqlsrv_prepare($connection, $queryCount, $paramsCount);
if ($stmtCount === false) {
    echo "Error al preparar la consulta de conteo: " . print_r(sqlsrv_errors(), true) . "\n";
    exit;
}
$resultCount = sqlsrv_execute($stmtCount);
if ($resultCount === false) {
    echo "Error al ejecutar la consulta de conteo: " . print_r(sqlsrv_errors(), true) . "\n";
    exit;
}
$totalRows = sqlsrv_fetch_array($stmtCount, SQLSRV_FETCH_ASSOC)['total'];
$totalPages = ceil($totalRows / $perPage);
sqlsrv_free_stmt($stmtCount);

// Enviar datos como JSON en una solicitud AJAX
if (isset($_POST['ajax']) && $_POST['ajax'] == 1) {
    echo json_encode([
        'users' => $users,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ]);
    exit;
}

$queryListUniAc = 'SELECT Desc_Nombre_Unidad_Academica FROM Unidades_Academicas';

$uniAcademicas = [];
$stmt = sqlsrv_prepare($connection, $queryListUniAc);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $uniAcademicas[] = $row;
        }
    }
}

$querySelectRoll = 'SELECT Desc_Rol FROM Rol_Dentro_Del_Sistema';
$rolesSistema = [];
$stmt = sqlsrv_prepare($connection, $querySelectRoll);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rolesSistema[] = $row;
        }
    }
}

$QueryListCargo = 'SELECT Desc_Cargo FROM Cargos';
$ListCargos = [];
$stmt = sqlsrv_prepare($connection, $QueryListCargo);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $ListCargos[] = $row;
        }
    }
}

$queryGrados = 'SELECT Desc_Grado FROM Grado';
$listaGrados = [];
$stmt = sqlsrv_prepare($connection, $queryGrados);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $listaGrados[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Mensajes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
    //include 'menu.php';
    include 'menuFinal.php';
?>

<div class="flex-container">
    <p>PANEL DE MENSAJES</p>
    <form id="searchForm">
        <input type="text" id="searchInput" name="search" placeholder="Buscar...">
        <button type="button" id="clearSearch">Limpiar</button>
    </form>
    <table class="tablaMsj">
        <thead>
            <tr>
                <th scope="col">Unidad</th>
                <th scope="col">Encargado</th>
                <th scope="col">Mensaje</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Aquí se insertarán las filas de datos con AJAX -->
        </tbody>
    </table>
    <div id="pagination">
        <!-- Aquí se insertarán los botones de paginación con AJAX -->
    </div>
</div>

<script>
$(document).ready(function() {
    function loadTable(page, searchQuery) {
        $.post("<?php echo $_SERVER['PHP_SELF']; ?>", {
            page: page,
            search: searchQuery,
            ajax: 1
        }, function(data) {
            var response = JSON.parse(data);
            var users = response.users;
            var totalPages = response.totalPages;
            var currentPage = response.currentPage;

            var tableBody = $("#tableBody");
            tableBody.empty();

            $.each(users, function(index, user) {
                tableBody.append(
                    `<tr>
                        <td id="UnidadMsj">${user.Desc_Nombre_Unidad_Academica}</td>
                        <td id="EncargadoMsj">${user.Desc_Grado}   ${user.Desc_Nombre_Usuario}</td>
                        <td>
                            <form class="MsjInput" method="POST" action="msjUnidadAd.php">
                                <input type="hidden" name="unidad" value="${user.Desc_Correo_Electronico}"/>
                                <textarea type="text" id="TextMsj" name="Mensaje" placeholder="Ingrese su mensaje..." required></textarea>
                                <div class="btnEnviar"><button id="Enviar-Mensaje">Enviar</button></div>
                            </form>
                        </td>
                    </tr>`
                );
            });

            var pagination = $("#pagination");
            pagination.empty();
            for (var i = 1; i <= totalPages; i++) {
                var activeClass = i === currentPage ? 'class="active"' : '';
                pagination.append(`<button ${activeClass} data-page="${i}">${i}</button>`);
            }
        });
    }

    $("#searchInput").on("input", function() {
        var searchQuery = $(this).val();
        loadTable(1, searchQuery);
    });

    $(document).on("click", "#pagination button", function() {
        var page = $(this).data("page");
        var searchQuery = $("#searchInput").val();
        loadTable(page, searchQuery);
    });

    $("#clearSearch").on("click", function() {
        $("#searchInput").val("");
        loadTable(1, "");
    });

    // Cargar la tabla con la página 1 y sin búsqueda al iniciar
    loadTable(1, "");
});
</script>

</body>
</html>