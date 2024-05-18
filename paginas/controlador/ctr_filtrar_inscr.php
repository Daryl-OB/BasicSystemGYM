<?php
    include "../includes/cargar_clases.php";

    $crudinscripcion = new CRUDInscripcion();

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];

        $crudinscripcion->FiltrarInscripcion($valor);
    }
