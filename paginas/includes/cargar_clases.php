<?php
    spl_autoload_register("cargarClases");

    function CargarClases($clase)
    {
        $ruta = "../modelo/";
        $extension = ".php";

        $ruta_completa = $ruta . $clase . $extension;

        include_once $ruta_completa;
    }
