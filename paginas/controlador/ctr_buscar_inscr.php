<?php
include "../includes/cargar_clases.php";

$crudinscripcion = new CRUDInscripcion();

if($_POST["codinscr"]){
    $codinscr = $_POST["codinscr"];
    $rs_inscr = $crudinscripcion->BuscarInscripcionPorCodigo($codinscr);
    echo json_encode($rs_inscr);
}
