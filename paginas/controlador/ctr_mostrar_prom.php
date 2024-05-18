<?php
include "../includes/cargar_clases.php";

$crudpromocion = new CRUDPromocion();

if($_GET["codprom"]){
    $codprom = $_GET["codprom"];
    $crudpromocion->MostrarPromocionPorCodigoJSON($codprom);
}
