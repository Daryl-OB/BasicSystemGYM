<?php
class CRUDMetodo extends Conexion
{
    public function ListarMetodo()
    {
        $arr_metod = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarMetodo()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_metod = $snt->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $arr_metod;
    }

    //Mostrar metodo por codigo
    public function MostrarMetodoPorCodigo($codmet)
    {
        $arr_metod = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarMetodoPorCodigo(:codmet)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codmet", $codmet, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_metod = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_metod;
    }

    //Mostrar metodo por codigo en JSON
    public function MostrarMetodoPorCodigoJSON($codmet)
    {
        $arr_met = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarMetodoPorCodigo(:codmet)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codmet", $codmet, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_met = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_met);
    }

    //Registrar servicio
    public function RegistrarMetodo(Metodo $metodo)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_RegistrarMetodo(:codmet, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codmet", $metodo->codigo_metodo);
            $snt->bindParam(":nom", $metodo->nombre);
            $snt->bindParam(":descr", $metodo->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Editar Metodo
    public function EditarMetodo(Metodo $metodo)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_EditarMetodo(:codmet, :nom, :descr)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codmet", $metodo->codigo_metodo);
            $snt->bindParam(":nom", $metodo->nombre);
            $snt->bindParam(":descr", $metodo->descripcion);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }


    // Buscar metodo por código
    public function BuscarMetodoPorCodigo($codmet)
    {
        $arr_met = null;
        $cn = $this->Conectar();
        $sql = "call sp_BuscarMetodoPorCodigo(:codmet)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codmet", $codmet, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_met = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_met;
    }


    //Borrar metodo por codigo
    public function BorrarMetodoPorCodigo($codmet){
        try{
            $cn = $this->Conectar();
            $sql = "call sp_BorrarMetodoPorCodigo(:codmet)";
            $snt = $cn->prepare($sql);
            $snt->bindParam(":codmet", $codmet, PDO::PARAM_STR, 5);
            $snt->execute();
            $cn = null;
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }


    // Consultar metodo por código (JSON)
    public function ConsultarMetodoPorCodigo($codmet)
    {
        $arr_met = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarMetodoPorCodigo(:codmet)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codmet", $codmet, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_met = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_met);
    }


    //Filtrar metodo
    public function FiltrarMetodo($valor)
    {
        $arr_met = null;
        $cn = $this->Conectar();
        $sql = "call sp_FiltrarMetodo(:valor)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 5);
        $snt->execute();
        $arr_met = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();
        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Metodo de Pago</th>";
                    echo "<th>Descripcion</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_met as $met) {
                $i++;
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$met->codigo_metodo</td>";
                    echo "<td>$met->nombre</td>";
                    echo "<td>$met->descripcion</td>";
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
        $arr_met = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarMetodo()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_met = $snt->fetchAll(PDO::FETCH_OBJ);
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

            foreach ($arr_met as $met) {
                $i++;
                echo "<tr class='reg_metodo'>";
                    echo "<td>$i</td>";
                    echo "<td class='codmet'>$met->codigo_metodo</td>";
                    echo "<td class='met'>$met->nombre</td>";
                    echo "<td class='descr'>$met->descripcion</td>";
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


