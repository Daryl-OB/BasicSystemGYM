<?php
include "../includes/cargar_clases.php";

$crudmetodo = new CRUDMetodo();

if (isset($_POST["codmet"])) {
    $codmet = $_POST["codmet"];

    $crudmetodo->ConsultarMetodoPorCodigo($codmet);
}
