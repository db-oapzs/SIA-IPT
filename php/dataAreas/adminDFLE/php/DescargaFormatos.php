<?php


    //include 'menu.php';
    include 'menuFinal.php';

// Directorio de archivos
$ficheroArchivos = '../../../exelDFLE/unidades';

// Verificar si el directorio existe
if (!is_dir($ficheroArchivos)) {
    die("El directorio no existe.");
}

// Año actual
$anio = (string)date('Y');

// Nombres de los archivos a buscar
$archivosEstadisticos = [
    "1 DFLE_4T_".$anio." Unid Acad CELEX obs gfl 2",
    "2 DFLE_4T_".$anio." IDIOMAS POR NIVEL gf",
    "3 DFLE_4T_".$anio." ACUMULADO Y COMPARATIVO",
    "5 DFLE_4T_".$anio." ACCIONES DE FORMACION DOCENTE"
];

// Arrays para clasificar los archivos
$archivos4T = [];
$otrosArchivos = [];

// Abrir el directorio
if ($handle = opendir($ficheroArchivos)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if (strpos($entry, "4 DFLE_4T_".$anio." ") !== false) {
                $archivos4T[] = $entry;
            } else {
                foreach ($archivosEstadisticos as $archivoEstadistico) {
                    if (strpos($entry, $archivoEstadistico) !== false) {
                        $otrosArchivos[] = $entry;
                        break;
                    }
                }
            }
        }
    }
    closedir($handle);
} else {
    die("No se pudo abrir el directorio.");
}

?>

<div class="contenedor-general">
    <h1>Descarga de Archivos Excel</h1>
    
    <div class="contenedor-padre">
        <div class="card" style="width: 400px; margin: 20px;">
            <div class="card-header">
                Formatos por Centro/Unidad Académica
            </div>
            <div class="card-body">
                <p class="card-text">Selecciona y descarga los formatos disponibles por Centro/Unidad Académica.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUnidades" style="background-color: #6c1d45; color: #ffffff; border: none;">
                    Seleccionar Formatos
                </button>
            </div>
        </div>

        <div class="card" style="width: 400px; margin: 20px;">
            <div class="card-header">
                Formatos de la DFLE
            </div>
            <div class="card-body">
                <p class="card-text">Selecciona y descarga los formatos disponibles de la DFLE.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalDFLE" style="background-color: #6c1d45; color: #ffffff; border: none;">
                    Seleccionar Formatos
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Unidades -->
<div class="modal fade" id="ModalUnidades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="descargaExcelUnidades.php">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formatos por Centro/Unidad Académica</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-check-input me-1" type="checkbox" id="selectAllU">
                <label class="form-check-label" for="selectAllU">Seleccionar todo</label>
                <ul class="list-group">
                    <?php foreach ($archivos4T as $archivo): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1 U" type="checkbox" name="archivosUnidades[]" value="<?= $archivo ?>">
                        <label class="form-check-label"><?= $archivo ?></label>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Descargar" style="background-color: #6c1d45; color: #ffffff; border: none;"></input>
            </div>
        </form>
    </div>
</div>

<!-- Modal DFLE -->
<div class="modal fade" id="ModalDFLE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="descargaExcelDFLE.php">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formatos de la DFLE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-check-input me-1" type="checkbox" id="selectAllDFLE">
                <label class="form-check-label" for="selectAllDFLE">Seleccionar todo</label>
                <ul class="list-group">
                    <?php foreach ($otrosArchivos as $archivo): ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1 DFLE" type="checkbox" name="archivosDFLE[]" value="<?= $archivo ?>">
                        <label class="form-check-label"><?= $archivo ?></label>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Descargar" style="background-color: #6c1d45; color: #ffffff; border: none;"></input>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#selectAllU").change(function() {
        $(".form-check-input.U").prop('checked', $(this).prop("checked"));
    });

    $(".form-check-input.U").change(function() {
        if (!$(this).prop("checked")) {
            $("#selectAllU").prop("checked", false);
        }
        if ($(".form-check-input.U:checked").length == $(".form-check-input.U").length) {
            $("#selectAllU").prop("checked", true);
        }
    });

    $("#selectAllDFLE").change(function() {
        $(".form-check-input.DFLE").prop('checked', $(this).prop("checked"));
    });

    $(".form-check-input.DFLE").change(function() {
        if (!$(this).prop("checked")) {
            $("#selectAllDFLE").prop("checked", false);
        }
        if ($(".form-check-input.DFLE:checked").length == $(".form-check-input.DFLE").length) {
            $("#selectAllDFLE").prop("checked", true);
        }
    });
});
</script>

</body>
</html>
