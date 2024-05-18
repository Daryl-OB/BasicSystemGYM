<?php
    include "../includes/cargar_clases.php";

    $crudservicio = new CRUDServicio();

    if(isset($_GET["codserv"])){
        $codserv = $_GET["codserv"];

        $crudservicio->BorrarServicioPorCodigo($codserv);
        
        //header("location: ../vista/listar_servicio.php");
    }
