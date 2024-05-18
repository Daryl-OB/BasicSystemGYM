<?php
include "../includes/cargar_clases.php";

$crudcliente = new CRUDCliente();

$rs_cli = $crudcliente->ListarCliente();

/* echo "<select class='form-select form-select-lg mb-3' name='cbo_cli' id='cbo_cli'>";
    echo "<option value='' selected>";
        echo "[Selecciona un cliente]";
    echo "</option>";
    foreach($rs_cli as $cli){
        echo "<option value='$cli->codigo_cliente'>";
            echo $cli->nombre;
        echo "</option>";
    }
echo "</select>"; */

echo json_encode($rs_cli);
