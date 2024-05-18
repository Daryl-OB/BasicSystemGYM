<?php
include "../includes/cargar_clases.php";

$crudservicio = new CRUDServicio();

if($_GET["codserv"]){
    $codserv = $_GET["codserv"];
    $crudservicio->MostrarServicioPorCodigoJSON($codserv);
}
