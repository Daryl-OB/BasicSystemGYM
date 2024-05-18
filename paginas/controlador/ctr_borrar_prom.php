<?php
    include "../includes/cargar_clases.php";

    $crudpromocion = new CRUDPromocion();

    if(isset($_GET["codprom"])){
        $codprom = $_GET["codprom"];

        $crudpromocion->BorrarPromocionPorCodigo($codprom);
        
        header("location: ../vista/listar_promocion.php");
    }
