<?php
include "../includes/cargar_clases.php";

$crudcliente = new CRUDCliente();

if (isset($_POST["codcli"])) {
    $codcli = $_POST["codcli"];

    $crudcliente->ConsultarClientePorCodigo($codcli);
}
