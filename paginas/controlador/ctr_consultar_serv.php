<?php
include "../includes/cargar_clases.php";

$crudservicio = new CRUDServicio();

if (isset($_POST["codserv"])) {
    $codserv = $_POST["codserv"];

    $crudservicio->ConsultarServicioPorCodigo($codserv);
}
