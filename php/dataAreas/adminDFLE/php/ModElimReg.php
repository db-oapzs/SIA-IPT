<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$queryUsers = '
    SELECT 
        nu.Desc_Nombre_Usuario,
        ch.Desc_Contrasena_Hash,
        eb.Desc_Estatus_Bloqueo,
        ed.Desc_Estatus_Deshabilitado,
        ua.Desc_Nombre_Unidad_Academica,
        c.Desc_Cargo,
        nt.Desc_Numero_Telefono,
        r.Desc_Rol,
        dc.Desc_Correo_Electronico
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
    ';
$arrayDt1 = array();
$arrayDt2 = array();
$arrayDt3 = array();

$arrayDt4 = array();
$arrayDt5 = array();
$arrayDt6 = array();
$arrayDt7 = array();
$dtoTodo = array();
// Preparar la consulta
$stmt = sqlsrv_prepare($connection, $queryUsers);
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
        // Mostrar los resultados
        $statusEnvio = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $arrayDt1[] = $row['Desc_Nombre_Unidad_Academica'];
            $arrayDt2[] = $row['Desc_Nombre_Usuario'];
            $arrayDt3[] = $row['Desc_Cargo'];

            $arrayDt4[] = $row['Desc_Estatus_Bloqueo'];
            $arrayDt5[] = $row['Desc_Estatus_Deshabilitado'];
            $arrayDt6[] = $row['Desc_Numero_Telefono'];
            $arrayDt7[] = $row['Desc_Correo_Electronico'];
            $dtoTodo[] = $row;
        }
    }

    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);
    //var_dump($arrayDt1);
    //echo "<br><br><br>";
    //var_dump($arrayDt2);
    //echo "<br><br><br>";
    //var_dump($arrayDt3);
    //echo "<br><br><br>";
    //var_dump($dtoTodo);
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


    include 'menu.php';

echo '
    <div id="contModal-3">
        <div class="hijo3">
            <div id="contbtn3">
                <span class="material-symbols-outlined" id="btnCloseModal">close</span>
            </div>
            <form id="formData">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombreNew" name="nombreNew">
                <label for="password">Contraseña</label>
                <input type="text" id="passwordNew" name="passwordNew">
                <label for="unidad">Centro o Unidad</label>
                <select id="unidadNew" name="unidadNew" style="width:300px;">
                <option disabled selected>Selecciona una opcion</option>
                ';
                    foreach ($uniAcademicas as $uniAcademica) {
                        $nombreUnidad = $uniAcademica['Desc_Nombre_Unidad_Academica'];
                        echo "<option class='optionIdiomas' value=\"$nombreUnidad\">$nombreUnidad</option>";
                    }
                echo '
                </select>
                <label for="cargo">Cargo</label>
                <select id="cargoNew" name="cargoNew" style="width:300px;">
                <option disabled selected>Selecciona una opcion</option>
                ';
                foreach ($ListCargos as $ListCargo) {
                    $cargos = $ListCargo['Desc_Cargo'];
                    echo "<option  value=\"$cargos\">$cargos</option>";
                }
                
                echo '
                </select>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefonoNew" name="telefonoNew">
                <label for="correo">Email</label>
                <input type="text" id="correoNew" name="correoNew">
            </form>
            <input type="submit" id="btnGuardar" value="Agregar registro">
        </div>
        </div>
    </div>
    ';
    ?>

    <div class="container-tabla" style="margin-top: 100px; padding-bottom: 100px;">
        <p>PANEL DE CONTRL DE REGISTROS</p>
        <table class="Table">
            <thead>
            <tr>
            <th class="TUnidad">Unidad</th>
            <th class="TNombre">Nombre</th>
            <th class="TCargo">Cargo</th>
            <th class="BtnAgreg">
                <div class="AgregCont">
                    <button id="Btn-AgregarReg">Nuevo Registro</button>
                </div></th>
            </tr>
            </thead>
                <tbody>
            <?php
                for ($i = 0; $i < count($arrayDt1); $i++) {
                    echo '   
                    
                <div id="contModal-1" class="formUsur-'.$i.'">
                <div id="hijo">
                    <div id="contbtn" class="closeBtn-'.$i.'">
                        <span class="material-symbols-outlined" id="btnCloseModal">close</span>
                    </div>
                    <form id="formData" method="POST" action="userModif.php">
                        <input type="hidden" value="'.$arrayDt7[$i].'" id="correo" name="correo" readonly>

                        <label for="nombre">Nombre</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt2[$i].'" id="nombreOld" name="nombreOld" disabled>
                            <input type="text" id="nombreNew" name="nombreNew">
                        </div>

                        <label for="statusBloqOld">Estado bloqueo</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt4[$i].'" id="statusBloqOld" name="statusBloqOld" disabled>
                            <input type="text" id="statusBloqNew" name="statusBloqNew">
                        </div>
                            
                        <label for="statusDesh">Estado deshabilitado</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt5[$i].'"  id="statusDeshOld" name="statusDeshOld" disabled>
                            <input type="text" id="statusDeshNew" name="statusDeshNew">
                        </div>

                        <label for="password">Contraseña</label>
                        <input type="text" id="passwordNew" name="passwordNew">

                        <label for="unidad">Centro o Unidad</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt1[$i].'" id="unidadOld" name="unidadOld" disabled>                            
                            <select id="unidadNew" name="unidadNew" style="width:300px;">
                            <option disabled selected>Selecciona una opcion</option>
                            ';
                            foreach ($uniAcademicas as $uniAcademica) {
                                $nombreUnidad = $uniAcademica['Desc_Nombre_Unidad_Academica'];
                                echo "<option value=\"$nombreUnidad\">$nombreUnidad</option>";
                            }
                            
                            echo '
                        </select>
                        </div>
                            
                        <label for="cargo">Cargo</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt3[$i].'" id="cargoOld" name="cargoOld" disabled>
                            <select id="cargoNew" name="cargoNew" style="width:300px;">
                            <option disabled selected>Selecciona una opcion</option>
                            ';
                            foreach ($ListCargos as $ListCargo) {
                                $cargos = $ListCargo['Desc_Cargo'];
                                echo "<option  value=\"$cargos\">$cargos</option>";
                            }
                            
                            echo '
                            </select>
                        </div>

                        <label for="telefono">Teléfono</label>
                        <div class="info">
                            <input type="text" value="'.$arrayDt6[$i].'" id="telefonoOld" name="telefonoOld" disabled>
                            <input type="text" id="telefonoNew" name="telefonoNew">
                        </div>                    
                        <input type="submit" id="btnGuardar" value="Guardar cambios">
                    </form>
                </div>
            </div>

                <div id="contModal-2" class="formElim-'.$i.'"  style="height:500px;">
                    <div class="hijo2">
                        <div id="alerta">
                            <h2 style="font-size:15px;">Se eliminará Este Usuario</h2>
                            <p style="font-size:12px; margin-top:10px;">'.$arrayDt2[$i].'</p>
                        </div>
                        <form class="contbtn2" >
                            <input type="hidden" name="user" value="'.$arrayDt2[$i].'"/>
                            <input type="submit" id="btnGuardar" value="Confirmar">
                            <button id="cancelar">Cancelar</button>
                        </form>
                    </div>
                </div>

                    ';
                    echo '<tr>';
                    echo '<td class="UnidadV">' . htmlspecialchars($arrayDt1[$i], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="NombreV">' . htmlspecialchars($arrayDt2[$i], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="CargoV">' . htmlspecialchars($arrayDt3[$i], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td class="Botones">
                            <div class="BotonesC">
                                <button id="Btn-AbrirModal" class="modModif-'.$i.'">Modificar</button>
                                <button id="Btn-AbrirModalElim" class="modElim-'.$i.'">Eliminar</button>
                            </div>
                        </td>';
                    echo '</tr>';
                }
            
            ?>
                </tbody>
            </table>
            </div>
    </div>
    
</body>
</html>