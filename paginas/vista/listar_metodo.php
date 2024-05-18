<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../..";
$titulo = "AppGYM - Lista de Metodos de Pago";
include("../includes/cabecera.php");
include("../controlador/ctr_validar_sesion.php");
?>

<body>
    <?php
    include("../includes/menu.php");
    include "../includes/cargar_clases.php";
    $crudmetodo = new CRUDMetodo();
    $rs_met = $crudmetodo->ListarMetodo();
    ?>
    <div class="container mt-3">
        <header>
            <h1><i class="fas fa-list-alt"></i>Lista de Metodos de Pago</h1>
        </header>

        <nav>
            <div class="btn-group col-md-5" role="group">
                <a href="#" class="btn_registrar btn btn-primary ">
                    <i class="fas fa-plus-circle"></i> Registrar
                </a>
                <a href="consultar_metodo.php" class="btn btn-success">
                    <i class="fas fa-search"></i> Consultar
                </a>
                <a href="filtrar_metodo.php" class="btn btn-danger">
                    <i class="fas fa-filter"> </i> Filtrar
                </a>
            </div>
        </nav>

        <section>
            <article>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-10" id="tablaMetodos">
                        <table class="table table-hover table-sm table-success table-striped">
                            <tr class="table-primary">
                                <th>Nº</th>
                                <th>Codigo</th>
                                <th>Metodo de Pago</th>
                                <th>Descripcion</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($rs_met as $met) {
                                $i++;
                            ?>
                                <tr class="reg_metodo">
                                    <td><?= $i ?></td>
                                    <td class="codmet"><?= $met->codigo_metodo ?></td>
                                    <td class="met"><?= $met->nombre ?></td>
                                    <td class="descr"><?= $met->descripcion ?></td>
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
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i> Borrar Metodo de Pago</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5 class="card-title">¿Seguro que deseas eliminar este registro?</h5>
                        <p class="card-text">
                            <span class="lbl_met"></span> (<span class="lbl_codmet"></span>)
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
                                                <label for="txt_codmet" class="form-label">Codigo:</label>
                                                <input type="text" class="form-control" id="txt_codmet" name="txt_codmet" placeholder="Codigo" maxlength="5" autofocus />
                                            </div>
                                            <div class="col-md-8">
                                                <label for="txt_nom" class="form-label">Metodo de Pago:</label>
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
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-info-circle"></i> Información del Metodo de Pago</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center mt-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <h5 class="card-title">Codigo:</h5>
                                        <p class="card-text codmet"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Servicio:</h5>
                                        <p class="card-text met"></p>
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