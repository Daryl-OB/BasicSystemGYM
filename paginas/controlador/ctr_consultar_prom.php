<?php
include "../includes/cargar_clases.php";

$crudpromocion = new CRUDPromocion();

if (isset($_POST["codprom"])) {
    $codprom = $_POST["codprom"];

    $crudpromocion->ConsultarPromocionPorCodigo($codprom);
}
