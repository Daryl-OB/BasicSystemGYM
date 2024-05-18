<?php
include "../includes/cargar_clases.php";

$crudmetodo = new CRUDMetodo();

if($_GET["codmet"]){
    $codmet = $_GET["codmet"];
    $crudmetodo->MostrarMetodoPorCodigoJSON($codmet);
}
