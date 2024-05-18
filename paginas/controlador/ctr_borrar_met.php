<?php
    include "../includes/cargar_clases.php";

    $crudmetodo = new CRUDMetodo();

    if(isset($_GET["codmet"])){
        $codmet = $_GET["codmet"];

        $crudmetodo->BorrarMetodoPorCodigo($codmet);
        
        header("location: ../vista/listar_metodo.php");
    }
