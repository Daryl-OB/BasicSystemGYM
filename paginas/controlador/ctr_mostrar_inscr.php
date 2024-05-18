<?php
include "../includes/cargar_clases.php";

if(isset($_POST["codinscr"])){
    $crudinscripcion = new CRUDInscripcion();

    $codinscr = $_POST["codinscr"];

    $rs_inscr = $crudinscripcion->MostrarInscripcionPorCodigo($codinscr);

    echo json_encode($rs_inscr);
}
