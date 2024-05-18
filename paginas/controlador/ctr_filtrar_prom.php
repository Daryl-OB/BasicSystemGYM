<?php
    include "../includes/cargar_clases.php";

    $crudpromocion = new CRUDPromocion();

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];

        $crudpromocion->FiltrarPromocion($valor);
    }
