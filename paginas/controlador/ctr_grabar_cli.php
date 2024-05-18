<?php
include "../includes/cargar_clases.php";

$crudcliente = new CRUDCliente();

if (isset($_POST["btn_registrar_cli"])) {
    $cliente = new Cliente();

    $cliente->codigo_cliente = $_POST["codcli"];
    $cliente->identificacion = $_POST["identificacion"];
    $cliente->nombre = $_POST["nombre"];
    $cliente->telefono = $_POST["telefono"];

    $tipo = $_POST["tipo"];

    if ($tipo == "r") {
        $crudcliente->RegistrarCliente($cliente);
    } else if ($tipo == "e") {
        $crudcliente->EditarCliente($cliente);
    }
    //header("location: ../vista/listar_cliente.php");
}
