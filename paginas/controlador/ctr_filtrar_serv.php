<?php
    include "../includes/cargar_clases.php";

    $crudservicio = new CRUDServicio();

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];

        $crudservicio->FiltrarServicio($valor);
    }