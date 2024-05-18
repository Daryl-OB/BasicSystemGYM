<?php
    include "../includes/cargar_clases.php";

    $crudmetodo = new CRUDMetodo ();

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];

        $crudmetodo->FiltrarMetodo($valor);
    }
