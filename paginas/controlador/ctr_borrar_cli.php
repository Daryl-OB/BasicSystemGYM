<?php
    include "../includes/cargar_clases.php";

    $crudcliente = new CRUDCliente();

    if(isset($_GET["codcli"])){
        $codcli = $_GET["codcli"];

        $crudcliente->BorrarClientePorCodigo($codcli);
        
        header("location: ../vista/listar_cliente.php");
    }
