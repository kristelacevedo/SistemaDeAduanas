<?php
// ajax/buscar_personas.php
require_once("../config/conexion.php");

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ajax') ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
    // Escapar cadena de búsqueda para evitar problemas
    $q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    
    // Construir consulta SQL dinámica
    $aColumns = array("documento", "nombre", "apellido"); // Columnas de búsqueda
    $sTable = "personas";
    $sWhere = "";
    
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    
    $sql = "SELECT * FROM $sTable $sWhere ORDER BY id_persona DESC";
    $query = mysqli_query($conexion, $sql);
    
    // Si hay resultados, armamos la tabla
    if ($query && mysqli_num_rows($query) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Documento</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        $id = $row['id_persona'];
                        $documento = $row['documento'];
                        $nombre = $row['nombre'] . " " . $row['apellido'];
                        $telefono = !empty($row['telefono']) ? $row['telefono'] : '<span class="text-muted">N/A</span>';
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><strong><?php echo $documento; ?></strong></td>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $telefono; ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" onclick="editar('<?php echo $id; ?>')"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" onclick="eliminar('<?php echo $id; ?>')"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-warning text-center m-3 mb-3">
            <i class="fas fa-info-circle"></i> No se encontraron personas registradas.
        </div>
        <?php
    }
}
?>