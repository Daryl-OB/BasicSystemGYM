<?php
class CRUDServicio extends Conexion
{
    //Listar servicio
    public function ListarServicio()
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarServicio()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_serv = $snt->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $arr_serv;
    }

    //Mostrar servicio por codigo
    public function MostrarServicioPorCodigo($codserv)
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarServicioPorCodigo(:codserv)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codserv", $codserv, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_serv = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_serv;
    }

    //Mostrar servicio por codigo en JSON
    public function MostrarServicioPorCodigoJSON($codserv)
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarServicioPorCodigo(:codserv)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codserv", $codserv, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_serv = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_serv);
    }

    //Registrar servicio
    public function RegistrarServicio(Servicio $servicio)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_RegistrarServicio(:codserv, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codserv", $servicio->codigo_servicio);
            $snt->bindParam(":nom", $servicio->nombre);
            $snt->bindParam(":descr", $servicio->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Editar Servicio
    public function EditarServicio(Servicio $servicio)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_EditarServicio(:codserv, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codserv", $servicio->codigo_servicio);
            $snt->bindParam(":nom", $servicio->nombre);
            $snt->bindParam(":descr", $servicio->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Buscar servicio por código
    public function BuscarServicioPorCodigo($codserv)
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_BuscarServicioPorCodigo(:codserv)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codserv", $codserv, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_serv = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_serv;
    }
   
    //Borrar servicio por codigo
    public function BorrarServicioPorCodigo($codserv){
        try{
            $cn = $this->Conectar();
            $sql = "call sp_BorrarServicioPorCodigo(:codserv)";
            $snt = $cn->prepare($sql);
            $snt->bindParam(":codserv", $codserv, PDO::PARAM_STR, 5);
            $snt->execute();
            $cn = null;
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }

    // Consultar servicio por código (JSON)
    public function ConsultarServicioPorCodigo($codserv)
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarServicioPorCodigo(:codserv)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codserv", $codserv, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_serv = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_serv);
    }

    //Filtrar servicio
    public function FiltrarServicio($valor)
    {
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_FiltrarServicio(:valor)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 5);
        $snt->execute();
        $arr_serv = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();
        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Servicio</th>";
                    echo "<th>Descripcion</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_serv as $serv) {
                $i++;
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$serv->codigo_servicio</td>";
                    echo "<td>$serv->nombre</td>";
                    echo "<td>$serv->descripcion</td>";
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

    public function ActualizarContenido(){
        $arr_serv = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarServicio()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_serv = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();

        if($nr > 0){
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Servicio</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>Acciones</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_serv as $serv) {
                $i++;
                echo "<tr class='reg_servicio'>";
                    echo "<td>$i</td>";
                    echo "<td class='codserv'>$serv->codigo_servicio</td>";
                    echo "<td class='serv'>$serv->nombre</td>";
                    echo "<td class='descr'>$serv->descripcion</td>";
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

