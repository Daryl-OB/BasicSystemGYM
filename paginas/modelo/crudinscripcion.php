<?php
class CRUDInscripcion extends Conexion
{
    public function ListarInscripcion()
    {
        $arr_insc = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarInscripcion()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_insc = $snt->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $arr_insc;
    }

    //Mostrar inscripcion por codigo
    public function MostrarInscripcionPorCodigo($codinsc)
    {
        $arr_insc = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarInscripcionPorCodigo(:codinsc)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codinsc", $codinsc, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_insc = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_insc;
    }

    //Registrar Inscripcion
    public function RegistrarInscripcion(Inscripcion $inscripcion)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_RegistrarInscripcion(:codinsc, :numbol, :codcli, :codserv, :codprom, :emi, :cad, :prec, :pag, :codmet, :deu, :est)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codinsc", $inscripcion->codigo_inscripcion);
            $snt->bindParam(":numbol", $inscripcion->numboleta);
            $snt->bindParam(":codcli", $inscripcion->inscripcion_codigo_cliente);
            $snt->bindParam(":codserv", $inscripcion->inscripcion_codigo_servicio);
            $snt->bindParam(":codprom", $inscripcion->inscripcion_codigo_promocion);
            $snt->bindParam(":emi", $inscripcion->emision);
            $snt->bindParam(":cad", $inscripcion->caducidad);
            $snt->bindParam(":prec", $inscripcion->precio);
            $snt->bindParam(":pag", $inscripcion->pago);
            $snt->bindParam(":codmet", $inscripcion->inscripcion_codigo_metodo);
            $snt->bindParam(":deu", $inscripcion->deuda);
            $snt->bindParam(":est", $inscripcion->estado);

            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    //Editar Inscripcion
    public function EditarInscripcion(Inscripcion $inscripcion)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_EditarInscripcion(:codinscr, :numbol, :codcli, :codserv, :codprom, :emi, :cad, :prec, :pag, :codmet, :deu, :est)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codinscr", $inscripcion->codigo_inscripcion);
            $snt->bindParam(":numbol", $inscripcion->numboleta);
            $snt->bindParam(":codcli", $inscripcion->inscripcion_codigo_cliente);
            $snt->bindParam(":codserv", $inscripcion->inscripcion_codigo_servicio);
            $snt->bindParam(":codprom", $inscripcion->inscripcion_codigo_promocion);
            $snt->bindParam(":emi", $inscripcion->emision);
            $snt->bindParam(":cad", $inscripcion->caducidad);
            $snt->bindParam(":prec", $inscripcion->precio);
            $snt->bindParam(":pag", $inscripcion->pago);
            $snt->bindParam(":codmet", $inscripcion->inscripcion_codigo_metodo);
            $snt->bindParam(":deu", $inscripcion->deuda);
            $snt->bindParam(":est", $inscripcion->estado);

            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Buscar inscripcion por código
    public function BuscarInscripcionPorCodigo($codinscr)
    {
        $arr_inscr = null;
        $cn = $this->Conectar();
        $sql = "call sp_BuscarInscripcionPorCodigo(:codinscr)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codinscr", $codinscr, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_inscr = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_inscr;
    }

    //Borrar inscripcion por codigo
    public function BorrarInscripcionPorCodigo($codinscr)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_BorrarInscripcionPorCodigo(:codinscr)";
            $snt = $cn->prepare($sql);
            $snt->bindParam(":codinscr", $codinscr, PDO::PARAM_STR, 5);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    // Consultar inscripcion por código (JSON)
    public function ConsultarInscripcionPorCodigo($codinscr)
    {
        $arr_inscr = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarInscripcionPorCodigo(:codinscr)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codinscr", $codinscr, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_inscr = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_inscr);
    }


    //Filtrar Inscripcion
    public function FiltrarInscripcion($valor)
    {
        $arr_inscr = null;
        $cn = $this->Conectar();
        $sql = "call sp_FiltrarInscripcion(:valor)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 5);
        $snt->execute();
        $arr_inscr = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();
        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
            echo "<tr class='table-primary'>";
            echo "<th>N°</th>";
            echo "<th>Codigo</th>";
            echo "<th>N° Boleta</th>";
            echo "<th>Cliente</th>";
            echo "<th>Servicio</th>";
            echo "<th>Promocion</th>";
            echo "<th>Fecha de Emision</th>";
            echo "<th>Fecha de Caducidad</th>";
            echo "<th>Precio (S/.)</th>";
            echo "<th>Monto pagado (S/.)</th>";
            echo "<th>Metodo de pago</th>";
            echo "<th>Deuda (S/.)</th>";
            echo "<th>Estado</th>";
            echo "</tr>";
            $i = 0;

            foreach ($arr_inscr as $inscr) {
                $i++;
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$inscr->codigo_inscripcion</td>";
                echo "<td>$inscr->numboleta</td>";
                echo "<td>$inscr->nombre_cliente</td>";
                echo "<td>$inscr->nombre_servicio</td>";
                echo "<td>$inscr->nombre_promocion</td>";
                echo "<td>$inscr->emision</td>";
                echo "<td>$inscr->caducidad</td>";
                echo "<td>$inscr->precio</td>";
                echo "<td>$inscr->pago</td>";
                echo "<td>$inscr->nombre_metodo_pago</td>";
                echo "<td>$inscr->deuda</td>";
                if ($inscr->estado == "Vigente") {
                    echo '<td>
                                <span class="badge rounded-pill bg-success text-white">Vigente</span>
                            </td>';
                } else if ($inscr->estado == "Proximo" || $inscr->estado == "Proximo") {
                    echo '<td>
                                <span class="badge rounded-pill bg-warning text-white">Proximo</span>
                            </td>';
                } else {
                    echo '<td>
                                <span class="badge rounded-pill bg-danger text-white">Vencido</span>
                            </td>';
                }

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
            echo "<b>No existen registros</b>";
            echo "</div>";
        }
        $cn = null;
    }

    //ACTUALIZAR CONTENIDO 
    public function ActualizarContenido()
    {
        $arr_inscr = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarInscripcion()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_inscr = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();

        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
            echo "<tr class='table-primary'>";
            echo "<th>N°</th>";
            echo "<th>Codigo</th>";
            echo "<th>N° Boleta</th>";
            echo "<th>Cliente</th>";
            echo "<th>Servicio</th>";
            echo "<th>Emision</th>";
            echo "<th>Caducidad</th>";
            echo "<th>Estado</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            $i = 0;

            foreach ($arr_inscr as $inscr) {
                $i++;
                echo "<tr class='reg_inscripcion'>";
                echo "<td>$i</td>";
                echo "<td class='codinscr'>$inscr->codigo_inscripcion</td>";
                echo "<td class='numbol'>$inscr->numboleta</td>";
                echo "<td class='cli'>$inscr->nombre_cliente</td>";
                echo "<td class='serv'>$inscr->nombre_servicio</td>";
                echo "<td class='emi'>$inscr->emision</td>";
                echo "<td class='cad'>$inscr->caducidad</td>";
                echo "<td class='est'>";
                    if ($inscr->estado == 'Vigente') {
                        echo '<span class="badge rounded-pill bg-success text-white">Vigente</span>';
                    } elseif ($inscr->estado == 'Próximo' or $inscr->estado == 'Proximo') {
                        echo '<span class="badge rounded-pill bg-warning text-white">Próximo</span>';
                    } else {
                        echo '<span class="badge rounded-pill bg-danger text-white">Vencido</span>';
                    }
                echo "</td>";
                echo "<td>
                            <a href='#' class='btn_mostrar btn btn-warning m-1'><i class='fas fa-info-circle'></i>
                            <a href='#' class='btn_editar btn btn-success m-1'><i class='fas fa-edit'></i>
                            <a href='#' class='btn_borrar btn btn-danger m-1'><i class='fas fa-trash'></i>
                    </td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        $cn = null;
    }
}
