<?php
include "../includes/cargar_clases.php";

$crudmetodo = new CRUDMetodo();

$rs_met = $crudmetodo->ListarMetodo();

/* echo "<select class='form-select form-select-lg mb-3' name='cbo_met' id='cbo_met'>";
    echo "<option value='' selected>";
        echo "[Selecciona un metodo de pago]";
    echo "</option>";
    foreach($rs_met as $met){
        echo "<option value='$met->codigo_metodo'>";
            echo $met->nombre;
        echo "</option>";
    }
echo "</select>"; */

echo json_encode($rs_met);