<?php
class CRUDCliente extends Conexion
{
    public function ListarCliente()
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarCliente()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_cli = $snt->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $arr_cli;
    }

    //Mostrar cliente por codigo
    public function MostrarClientePorCodigo($codcli)
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarClientePorCodigo(:codcli)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codcli", $codcli, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_cli = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_cli;
    }

    //Mostrar cliente por codigo en JSON
    public function MostrarClientePorCodigoJSON($codcli)
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarClientePorCodigo(:codcli)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codcli", $codcli, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_cli = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_cli);
    }

    //Registrar cliente
    public function RegistrarCliente(Cliente $cliente)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_RegistrarCliente(:codcli, :ident, :nom, :telef)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codcli", $cliente->codigo_cliente);
            $snt->bindParam(":ident", $cliente->identificacion);
            $snt->bindParam(":nom", $cliente->nombre);
            $snt->bindParam(":telef", $cliente->telefono);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Editar Cliente
    public function EditarCliente(Cliente $cliente)
    {
        try {
            $cn = $this->Conectar();
            $sql = "call sp_EditarCliente(:codcli, :ident, :nom, :telef)";
            $snt = $cn->prepare($sql);

            $snt->bindParam(":codcli", $cliente->codigo_cliente);
            $snt->bindParam(":ident", $cliente->identificacion);
            $snt->bindParam(":nom", $cliente->nombre);
            $snt->bindParam(":telef", $cliente->telefono);
            $snt->execute();
            $cn = null;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    // Buscar cliente por código
    public function BuscarClientePorCodigo($codcli)
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_BuscarClientePorCodigo(:codcli)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codcli", $codcli, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_cli = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        return $arr_cli;
    }


    //Borrar cliente por codigo
    public function BorrarClientePorCodigo($codcli){
        try{
            $cn = $this->Conectar();
            $sql = "call sp_BorrarClientePorCodigo(:codcli)";
            $snt = $cn->prepare($sql);
            $snt->bindParam(":codcli", $codcli, PDO::PARAM_STR, 5);
            $snt->execute();
            $cn = null;
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }


    // Consultar cliente por código (JSON)
    public function ConsultarClientePorCodigo($codcli)
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_MostrarClientePorCodigo(:codcli)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":codcli", $codcli, PDO::PARAM_STR, 5);
        $snt->execute();
        $nr = $snt->rowCount();
        if ($nr > 0) {
            $arr_cli = $snt->fetch(PDO::FETCH_OBJ);
        }
        $cn = null;
        echo json_encode($arr_cli);
    }


    //Filtrar Cliente
    public function FiltrarCliente($valor)
    {
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_FiltrarCliente(:valor)";
        $snt = $cn->prepare($sql);
        $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 5);
        $snt->execute();
        $arr_cli = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();
        if ($nr > 0) {
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>Identificacion (DNI)</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Telefono</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_cli as $cli) {
                $i++;
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$cli->codigo_cliente</td>";
                    echo "<td>$cli->identificacion</td>";
                    echo "<td>$cli->nombre</td>";
                    echo "<td>$cli->telefono</td>";
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
        $arr_cli = null;
        $cn = $this->Conectar();
        $sql = "call sp_ListarCliente()";
        $snt = $cn->prepare($sql);
        $snt->execute();
        $arr_cli = $snt->fetchAll(PDO::FETCH_OBJ);
        $nr = $snt->rowCount();

        if($nr > 0){
            echo "<table class='table table-hover table-sm table-success table-striped'>";
                echo "<tr class='table-primary'>";
                    echo "<th>N°</th>";
                    echo "<th>Codigo</th>";
                    echo "<th>DNI</th>";
                    echo "<th>Nombres</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Acciones</th>";
                echo "</tr>";
            $i = 0;

            foreach ($arr_cli as $cli) {
                $i++;
                echo "<tr class='reg_cliente'>";
                    echo "<td>$i</td>";
                    echo "<td class='codcli'>$cli->codigo_cliente</td>";
                    echo "<td class='ident'>$cli->identificacion</td>";
                    echo "<td class='cli'>$cli->nombre</td>";
                    echo "<td class='telef'>$cli->telefono</td>";
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
