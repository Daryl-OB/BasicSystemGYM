<?php
class CRUDPromocion extends Conexion
{
    public function ListarPromocion()
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarPromocion()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_prom = $snt->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $arr_prom;
    }

    //Mostrar promocion por codigo
    public function MostrarPromocionPorCodigo($codprom)
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarPromocionPorCodigo(:codprom)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codprom", $codprom, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_prom = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_prom;
    }

    //Mostrar promocion por codigo en JSON
    public function MostrarPromocionPorCodigoJSON($codprom)
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarPromocionPorCodigo(:codprom)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codprom", $codprom, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_prom = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_prom);
    }

    //Registrar promocion
    public function RegistrarPromocion(Promocion $promocion)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_RegistrarPromocion(:codprom, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codprom", $promocion->codigo_promocion);
            $snt->bindParam(":nom", $promocion->nombre);
            $snt->bindParam(":descr", $promocion->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Editar Promocion
    public function EditarPromocion(Promocion $promocion)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_EditarPromocion(:codprom, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codprom", $promocion->codigo_promocion);
            $snt->bindParam(":nom", $promocion->nombre);
            $snt->bindParam(":descr", $promocion->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    // Buscar promocion por código
    public function BuscarPromocionPorCodigo($codprom)
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_BuscarPromocionPorCodigo(:codprom)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codprom", $codprom, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_prom = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_prom;
    }


    //Borrar promocion por codigo
    public function BorrarPromocionPorCodigo($codprom){
        try{
            $cn = $this->Conectar();
            $sql = "call sp_BorrarPromocionPorCodigo(:codprom)";
            $snt = $cn->prepare($sql);
            $snt->bindParam(":codprom", $codprom, PDO::PARAM_STR, 5);
            $snt->execute();
            $cn = null;
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }


    // Consultar promocion por código (JSON)
    public function ConsultarPromocionPorCodigo($codprom)
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarPromocionPorCodigo(:codprom)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codprom", $codprom, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_prom = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_prom);
    }


    //Filtrar Promocion
    public function FiltrarPromocion($valor)
    {
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_FiltrarPromocion(:valor)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 5);
        $snt->execute();
        $arr_prom = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();
        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Promocion</th>";
                    echo "<th>Descripcion</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_prom as $prom) {
                $i++;
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$prom->codigo_promocion</td>";
                    echo "<td>$prom->nombre</td>";
                    echo "<td>$prom->descripcion</td>";
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
    public function ActualizarContenido(){
        $arr_prom = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarPromocion()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_prom = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();

        if($nr > 0){
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Promocion</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>Acciones</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_prom as $prom) {
                $i++;
                echo "<tr class='reg_promocion'>";
                    echo "<td>$i</td>";
                    echo "<td class='codprom'>$prom->codigo_promocion</td>";
                    echo "<td class='prom'>$prom->nombre</td>";
                    echo "<td class='descr'>$prom->descripcion</td>";
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
