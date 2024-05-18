<?php
    include "../includes/cargar_clases.php";

    $crudcliente = new CRUDCliente();

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];

        $crudcliente->FiltrarCliente($valor);
    }
