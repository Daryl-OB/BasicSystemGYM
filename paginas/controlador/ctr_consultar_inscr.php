<?php
include "../includes/cargar_clases.php";

$crudinscripcion = new CRUDInscripcion();

if (isset($_POST["codinscr"])) {
    $codinscr = $_POST["codinscr"];

    $crudinscripcion->ConsultarInscripcionPorCodigo($codinscr);
}
