<?php
    include "../includes/cargar_clases.php";

    $crudinscripcion = new CRUDInscripcion();

    if(isset($_GET["codinscr"])){
        $codinscr = $_GET["codinscr"];

        $crudinscripcion->BorrarInscripcionPorCodigo($codinscr);
        
        header("location: ../vista/listar_inscripcion.php");
    }
