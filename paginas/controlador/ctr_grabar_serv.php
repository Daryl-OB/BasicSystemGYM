<?php
include "../includes/cargar_clases.php";

$crudservicio = new CRUDServicio();

if (isset($_POST["btn_registrar_serv"])) {
    $servicio = new Servicio();

    $servicio->codigo_servicio = $_POST["codserv"];
    $servicio->nombre = $_POST["nombre"];
    $servicio->descripcion = $_POST["descripcion"];

    $tipo = $_POST["tipo"];

    if ($tipo == "r") {
        $crudservicio->RegistrarServicio($servicio);
    } else if ($tipo == "e") {
        $crudservicio->EditarServicio($servicio);
    }
   //header("location: ../vista/listar_servicio.php");
}
