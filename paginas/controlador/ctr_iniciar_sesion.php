<?php 
include "../includes/cargar_clases.php";

$crudcliente = new CRUDCliente();

if(isset($_POST["btn_iniciar_sesion"])){
    $codcli = $_POST["txt_user"];
    $clave = $_POST["txt_contra"];
    
    if($codcli == $clave){
        $rs_cli = $crudcliente->BuscarClientePorCodigo($codcli);
        if($rs_cli != null){
            session_start();
            $_SESSION["cliente"] = $rs_cli;
            header("location: ../vista/listar_servicio.php");
            exit();
        }
        else{
            header("location: ../../");
            exit();
        }
    }else{
        header("location: ../../");
        exit();
    }
}