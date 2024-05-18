<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../..";
$titulo = "AppGYM - Lista de Servicios";
include("../includes/cabecera.php");
include("../controlador/ctr_validar_sesion.php");
?>

<body>
    <?php
    include("../includes/menu.php");
    include "../includes/cargar_clases.php";

    $crudservicio = new CRUDServicio();
    $rs_serv = $crudservicio->ListarServicio();
    ?>
    <div class="container mt-3">
        <header>
            <h1><i class="fas fa-list-alt"></i>Lista de Servicios</h1>
        </header>

        <nav>
            <div class="btn-group col-md-5" role="group">
                <a href="#" class="btn_registrar btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Registrar
                </a>
                <a href="consultar_servicio.php" class="btn btn-success">
                    <i class="fas fa-search"></i> Consultar
                </a>
                <a href="filtrar_servicio.php" class="btn btn-danger">
                    <i class="fas fa-filter"> </i> Filtrar
                </a>
            </div>
        </nav>

        <section>
            <article>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-10" id="tablaServicios">
                        <table id="table" class="table table-hover table-sm table-success table-striped">
                            <tr class="table-primary">
                                <th>Nº</th>
                                <th>Codigo</th>
                                <th>Servicio</th>
                                <th>Descripcion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($rs_serv as $serv) {
                                $i++;
                            ?>
                                <tr class="reg_servicio">
                                    <td><?= $i ?></td>
                                    <td class="codserv"><?= $serv->codigo_servicio ?></td>
                                    <td class="serv"><?= $serv->nombre ?></td>
                                    <td class="descr"><?= $serv->descripcion ?></td>
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


    <!-- Modal Borrar -->
    <div class="modal fade" id="md_borrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i> Borrar Servicio</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5 class="card-title">¿Seguro que deseas eliminar este registro?</h5>
                        <p class="card-text">
                            <span class="lbl_serv"></span> (<span class="lbl_codserv"></span>)
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
                                                <label for="txt_codserv" class="form-label">Codigo:</label>
                                                <input type="text" class="form-control" id="txt_codserv" name="txt_codserv" placeholder="Codigo" maxlength="5" autofocus />
                                            </div>
                                            <div class="col-md-8">
                                                <label for="txt_nom" class="form-label">Servicio:</label>
                                                <input type="text" class="form-control" id="txt_nom" name="txt_nom" placeholder="Nombre del servicio" maxlength="100" />
                                            </div>
                                            <div class="col-md-12">
                                                <label for="txt_descr" class="form-label">Descripcion:</label>
                                                <textarea class="form-control" id="txt_descr" name="txt_descr" placeholder="Descripcion" maxlength="100" rows="4" cols="25"></textarea>
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
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-info-circle"></i> Información de Servicio</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="card-title">Codigo:</h5>
                                        <p class="card-text codserv"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Servicio:</h5>
                                        <p class="card-text serv"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Descripcion:</h5>
                                        <p class="card-text descr"></p>
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