<?php
include "../includes/cargar_clases.php";

$crudmetodo = new CRUDMetodo();

if (isset($_POST["btn_registrar_met"])) {
    $metodo = new Metodo();

    $metodo->codigo_metodo = $_POST["codmet"];
    $metodo->nombre = $_POST["nombre"];
    $metodo->descripcion = $_POST["descripcion"];

    $tipo = $_POST["tipo"];

    if ($tipo == "r") {
        $crudmetodo->RegistrarMetodo($metodo);
    } else if ($tipo == "e") {
        $crudmetodo->EditarMetodo($metodo);
    }
    //header("location: ../vista/listar_metodo.php");
}
