<?php
include "../includes/cargar_clases.php";

$crudpromocion = new CRUDPromocion();

$rs_prom = $crudpromocion->ListarPromocion();

/* echo "<select class='form-select form-select-lg mb-3' name='cbo_prom' id='cbo_prom'>";
    echo "<option value='' selected>";
        echo "[Selecciona una promocion]";
    echo "</option>";
    foreach($rs_prom as $prom){
        echo "<option value='$prom->codigo_promocion'>";
            echo $prom->nombre;
        echo "</option>";
    }
echo "</select>"; */

echo json_encode($rs_prom);