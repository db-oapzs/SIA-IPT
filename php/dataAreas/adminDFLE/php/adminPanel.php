<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$perPage = 10; 
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



    $arrayDataNombre = array();
    $arrayDataBloqueo = array();
    $arrayDataDeshabilitado = array();
    $arrayDataUnidad = array();
    $arrayDataCargo = array();
    $arrayDataExtencion = array();
    $arrayDataCorreo = array();

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
    $arrayDataNombre[] = $row['Desc_Nombre_Usuario'];
    $arrayDataBloqueo[] = $row['Desc_Estatus_Bloqueo'];
    $arrayDataDeshabilitado[] = $row['Desc_Estatus_Deshabilitado'];
    $arrayDataUnidad[] = $row['Desc_Nombre_Unidad_Academica'];
    $arrayDataCargo[] = $row['Desc_Cargo'];
    $arrayDataExtencion[] = $row['Desc_Numero_Telefono'];
    $arrayDataCorreo[] = $row['Desc_Correo_Electronico'];
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
        Correo_Electronico dc ON ug.id_CorreoElectronico = dc.ID_CorreoElectronico
    WHERE 
        nu.Desc_Nombre_Usuario LIKE ? OR 
        ua.Desc_Nombre_Unidad_Academica LIKE ? OR 
        c.Desc_Cargo LIKE ? OR
        nt.Desc_Numero_Telefono LIKE ? OR
        dc.Desc_Correo_Electronico LIKE ?
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

$uniAcademicas = array();
$stmt = sqlsrv_prepare($connection, $queryListUniAc);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $uniAcademicas[] = $row;
        }
    }
}

$querySelectRoll = 'SELECT Desc_Rol FROM Rol_Dentro_Del_Sistema';
$rolesSistema = array();
$stmt = sqlsrv_prepare($connection, $querySelectRoll);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rolesSistema[] = $row;
        }
    }
}


$QueryListCargo = 'SELECT Desc_Cargo FROM cargos ';

$ListCargos = array();
$stmt = sqlsrv_prepare($connection, $QueryListCargo);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $ListCargos[] = $row;
        }
    }
}

$queryGrados = 'SELECT Desc_Grado FROM Grado';

$listaGrados = array();
$stmt = sqlsrv_prepare($connection, $queryGrados);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $listaGrados[] = $row;
        }
    }
}

    //include 'menu.php';
    include 'menuFinal.php';
?>
<script src="../scripts/scriptPanelAdmin.js" async defer></script>
<div id="modalAgUsr">
    <div id="contBtnCerrarModAgrAdm">
        <div id="btnAgrCrmod">
            <span id="btnMdclose" class="gg-close"></span>
        </div>
    </div>
    <form id="formModAgrUsNew" method="POST" action="agrNewUsr.php">
        <label>Grado Academico</label>
        <select id="slectUnidAc" name="opcGradoAc" required>
            <option value=" " disabled selected> Selecciona una Opción</option>
            <?php
                foreach ($listaGrados as $listaGrado) {
                    $grado = $listaGrado['Desc_Grado'];
                    echo "<option class='optionIdiomas' value=\"$grado\">$grado</option>";
                }
            ?>
        </select>
        <label>Nombre</label>
        <input 
            type="text"
            name="nombreUrs"
            placeholder = "Nombre de usuario"
            required
        />
        <label>Contraseña</label>
        <input 
            type="password"
            name="claveUrs"
            placeholder = "Contraseña de usuario"
            required
        />
        <label>Correo Electronico</label>
        <input 
            type="email"
            name="correoEmail"
            placeholder = "Email de usuario"
            required
        />
        <label>Unidad Academica</label>
        <select id="slectUnidAc" name="opcCentroUnidad" required>
            <option value=" " disabled selected> Selecciona una Opción</option>
            <?php
                foreach ($uniAcademicas as $uniAcademica) {
                    $nombreUnidad = $uniAcademica['Desc_Nombre_Unidad_Academica'];
                    echo "<option class='optionIdiomas' value=\"$nombreUnidad\">$nombreUnidad</option>";
                }
            ?>
        </select>
        <label>Cargo</label>
        <select id="slectCargo" name="opcCargo" required>
            <option value=" " disabled selected> Selecciona una Opción</option>
            <?php 
                foreach ($ListCargos as $ListCargo) {
                    $cargos = $ListCargo['Desc_Cargo'];
                    echo "<option  value=\"$cargos\">$cargos</option>";
                }
            ?>
        </select>
        <label>Roll</label>
        <select id="slectCargo" name="opcRoll" required>
            <option value=" " disabled selected> Selecciona una Opción</option>
            <?php 
                foreach ($rolesSistema as $rooll) {
                    $rol = $rooll['Desc_Rol'];
                    echo "<option  value=\"$rol\">$rol</option>";
                }
            ?>
        </select>
        <label>Telefono Extención</label>
        <input 
            type="tel"
            name="telefono"
            placeholder = "Ext de usuario"
            required
        />
        <input type="submit" value="Agregar Usuario"/>
    </form>
</div>
<div id="contPpadmin">
    <p id="txtBinvPa">Sistema de Información para la Autoevaluación
    <br>Panel de Administración de Usuarios DFLE</p>
    <div id="contBtnAgrUser">
        <p class="btnPadm" id="txtAgU">Agregar Nuevo Usuario</p>
    </div>

    <form id="searchForm" method="POST" action="">
        <input type="search" name="search" id="barrSearch" placeholder="Dato a buscar" value="<?php echo htmlspecialchars($searchQuery); ?>"/>
        <button type="button" id="clearButton">Limpiar</button>
    </form>
    
    <ul id="contCab">
        <li style="width: 5%;">Grado</li>
        <li style="width: 25%;">Nombre de Usuario</li>
        <li style="width: 30%;">Unidad Académica</li>
        <li style="width: 10%;">Cargo</li>
        <li style="width: 10%;">Extención</li>
        <li style="width: 20%;">Modificar Usuario</li>
    </ul>
    <div id="contTableData">
        <table id="contTable">
            <tbody id="tableBody">
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td style="width: 5%;"><?php echo htmlspecialchars($user['Desc_Grado']); ?></td>
                        <td style="width: 25%;"><?php echo htmlspecialchars($user['Desc_Nombre_Usuario']); ?></td>
                        <td style="width: 30%;"><?php echo htmlspecialchars($user['Desc_Nombre_Unidad_Academica']); ?></td>
                        <td style="width: 10%;"><?php echo htmlspecialchars($user['Desc_Cargo']); ?></td>
                        <td style="width: 10%;"><?php echo htmlspecialchars($user['Desc_Numero_Telefono']); ?></td>
                        <td style="width: 20%;">
                            <form method="POST" action="modificarUrA.php">
                                <input type="hidden" name="ustUMA" value="<?php echo htmlspecialchars($user['Desc_Correo_Electronico']); ?>">
                                <input class="btnPadm" type="submit" value="Modificar" class="gg-clapper-board">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <ul id="pginacion">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="itemPag" href="#" onclick="fetchData(<?php echo $i; ?>, '<?php echo urlencode($searchQuery); ?>');">
                <?php echo $i; ?>
                <li id="btn<?php echo $i; ?>pg" class="itemPag"></li>
            </a>
        <?php endfor; ?>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('barrSearch');
    const clearButton = document.getElementById('clearButton');
    const tableBody = document.getElementById('tableBody');
    const pagination = document.getElementById('pginacion');
    let currentPage = <?php echo $page; ?>;

    function fetchData(page = 1, search = '') {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
        formData.append('page', page);
        formData.append('search', search);
        formData.append('ajax', 1);

        xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                renderTable(response.users);
                renderPagination(response.totalPages, response.currentPage);
            }
        };
        xhr.send(formData);
    }

    function renderTable(users) {
        tableBody.innerHTML = '';
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td style="width: 5%;">${user.Desc_Grado}</td>
                <td style="width: 25%;">${user.Desc_Nombre_Usuario}</td>
                <td style="width: 30%;">${user.Desc_Nombre_Unidad_Academica}</td>
                <td style="width: 10%;">${user.Desc_Cargo}</td>
                <td style="width: 10%; text-align:center;">${user.Desc_Numero_Telefono}</td>
                <td style="width: 20%;">
                    <form method="POST" action="modificarUrA.php">
                        <input type="hidden" name="ustUMA" value="${user.Desc_Correo_Electronico}">
                        <input class="btnPadm" type="submit" value="Modificar">
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function renderPagination(totalPages, currentPage) {
        pagination.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = 'itemPag';
            pageItem.textContent = i;
            if (i === currentPage) {
                pageItem.classList.add('active');
            }
            pageItem.addEventListener('click', function() {
                fetchData(i, searchInput.value);
            });
            pagination.appendChild(pageItem);
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    searchInput.addEventListener('input', debounce(function() {
        fetchData(1, searchInput.value);
    }, 300)); 

    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        fetchData(1, '');
    });

    fetchData(currentPage);                                                     
});
</script>

</body>
</html>
