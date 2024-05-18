<?php
include "../includes/cargar_clases.php";

$crudpromocion = new CRUDPromocion();

if (isset($_POST["btn_registrar_prom"])) {
    $promocion = new Promocion();

    $promocion->codigo_promocion = $_POST["codprom"];
    $promocion->nombre = $_POST["nombre"];
    $promocion->descripcion = $_POST["descripcion"];

    $tipo = $_POST["tipo"];

    if ($tipo == "r") {
        $crudpromocion->RegistrarPromocion($promocion);
    } else if ($tipo == "e") {
        $crudpromocion->EditarPromocion($promocion);
    }
    //header("location: ../vista/listar_promocion.php");
}
