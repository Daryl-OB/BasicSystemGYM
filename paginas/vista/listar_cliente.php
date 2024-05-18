<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../..";
$titulo = "AppGYM - Lista de Clientes";
include("../includes/cabecera.php");
include("../controlador/ctr_validar_sesion.php");
?>

<body>
    <?php
    include("../includes/menu.php");
    include "../includes/cargar_clases.php";
    $crudcliente = new CRUDCliente();
    $rs_cli = $crudcliente->ListarCliente();
    ?>
    <div class="container mt-3">
        <header>
            <h1><i class="fas fa-list-alt"></i>Lista de Clientes</h1>
        </header>

        <nav>
            <div class="btn-group col-md-5" role="group">
                <a href="#" class="btn_registrar btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Registrar
                </a>
                <a href="consultar_cliente.php" class="btn btn-success">
                    <i class="fas fa-search"></i> Consultar
                </a>
                <a href="filtrar_cliente.php" class="btn btn-danger">
                    <i class="fas fa-filter"> </i> Filtrar
                </a>
            </div>
        </nav>

        <section>
            <article>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-10" id="tablaClientes">
                        <table class="table table-hover table-sm table-success table-striped">
                            <tr class="table-primary">
                                <th>Nº</th>
                                <th>Codigo</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Telefono</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($rs_cli as $cli) {
                                $i++;
                            ?>
                                <tr class="reg_cliente">
                                    <td><?= $i ?></td>
                                    <td class="codcli"><?= $cli->codigo_cliente ?></td>
                                    <td class="ident"><?= $cli->identificacion ?></td>
                                    <td class="cli"><?= $cli->nombre ?></td>
                                    <td class="telef"><?= $cli->telefono ?></td>
                                    <td>
                                        <a href="#" class="btn_mostrar btn btn-warning m-1"><i class="fas fa-info-circle"></i>
                                        <a href="#" class="btn_editar btn btn-success m-1"><i class="fas fa-edit"></i>
                                        <a href="#" class="btn_borrar btn btn-danger m-1"><i class="fas fa-trash"></i>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </article>
        </section>
        <?php
        include("../includes/pie.php");
        ?>
    </div>


    <!-- Modal  Borrar -->
    <div class="modal fade" id="md_borrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i> Borrar Cliente</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5 class="card-title">¿Seguro que deseas eliminar este registro?</h5>
                        <p class="card-text">
                            <span class="lbl_cli"></span> (<span class="lbl_codcli"></span>)
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="#" class="btn_confirmar_borrar btn btn-outline-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal registrar y editar -->
    <div class="modal fade" id="md_action" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-white fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!--INICIO DEL FORMULARIO-->
                                    <form id="frm_action" name="frm_action" method="POST" autocomplete="off">
                                        <input type="hidden" id="txt_tipo" name="txt_tipo" value="" />

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="txt_codcli" class="form-label">Codigo:</label>
                                                <input type="text" class="form-control" id="txt_codcli" name="txt_codcli" placeholder="Codigo" maxlength="5" autofocus />
                                            </div>
                                            <div class="col-md-8">
                                                <label for="txt_ident" class="form-label">N° Identificacion (DNI):</label>
                                                <input type="text" class="form-control" id="txt_ident" name="txt_ident" placeholder="Numero de DNI" maxlength="20" />
                                            </div>
                                            <div class="col-md-12">
                                                <label for="txt_nom" class="form-label">Nombre Completo:</label>
                                                <input type="text" class="form-control" id="txt_nom" name="txt_nom" placeholder="Nombre completo" maxlength="100"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txt_telef" class="form-label">Telefono:</label>
                                                <input type="text" class="form-control" id="txt_telef" name="txt_telef" placeholder="Telefono del cliente" maxlength="20"/>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="text-end mt-4">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-outline-primary" id="btn_action" name="">
                                                <i class="fas fa-save"></i> Grabar Informacion
                                            </button>
                                        </div>
                                    </form>
                                    <!--FIN DEL FORMULARIO-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL MOSTRAR INFORMACION -->
    <div class="modal fade" id="md_mostrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-info-circle"></i> Información de la Promocion</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="card-title">Codigo:</h5>
                                        <p class="card-text codcli"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="card-title">N° Identificacion (DNI):</h5>
                                        <p class="card-text ident"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Cliente:</h5>
                                        <p class="card-text cli"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Telefono:</h5>
                                        <p class="card-text telef"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>