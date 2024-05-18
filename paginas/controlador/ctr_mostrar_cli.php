<?php
include "../includes/cargar_clases.php";

$crudcliente = new CRUDCliente();

if($_GET["codcli"]){
    $codcli = $_GET["codcli"];
    $crudcliente->MostrarClientePorCodigoJSON($codcli);
}
