<?php
include "../includes/cargar_clases.php";

$crudinscripcion = new CRUDInscripcion();

if (isset($_POST["btn_registrar_inscr"])) {
    $inscripcion = new Inscripcion();

    $inscripcion->codigo_inscripcion = $_POST["codinscr"];
    $inscripcion->numboleta = $_POST["numboleta"];
    $inscripcion->inscripcion_codigo_cliente = $_POST["cliente"];
    $inscripcion->inscripcion_codigo_servicio = $_POST["servicio"];
    $inscripcion->inscripcion_codigo_promocion = $_POST["promocion"];
    $inscripcion->emision = $_POST["emision"];
    $inscripcion->caducidad = $_POST["caducidad"];
    $inscripcion->precio = $_POST["precio"];
    $inscripcion->pago = $_POST["pago"];
    $inscripcion->inscripcion_codigo_metodo = $_POST["metodo"];
    $inscripcion->deuda = $_POST["deuda"];
    $inscripcion->estado = $_POST["estado"];
    
    $tipo = $_POST["tipo"];

    if ($tipo == "r") {
        $crudinscripcion->RegistrarInscripcion($inscripcion);
    } else if ($tipo == "e") {
        $crudinscripcion->EditarInscripcion($inscripcion);
    }
    //header("location: ../vista/listar_inscripcion.php");
}
