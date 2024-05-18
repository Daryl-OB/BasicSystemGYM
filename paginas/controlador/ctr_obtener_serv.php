<?php
include "../includes/cargar_clases.php";

$crudservicio = new CRUDServicio();

$rs_serv = $crudservicio->ListarServicio();

echo json_encode($rs_serv);