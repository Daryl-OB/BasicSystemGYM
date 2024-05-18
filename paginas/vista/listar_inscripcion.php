<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../..";
$titulo = "AppGYM - Lista de Inscripciones";
include("../includes/cabecera.php");
include("../controlador/ctr_validar_sesion.php");
?>

<body>
    <?php
    include("../includes/menu.php");
    include "../includes/cargar_clases.php";
    $crudinscripcion = new CRUDInscripcion();
    $rs_inscr = $crudinscripcion->ListarInscripcion();
    ?>
    <div class="container mt-3">
        <header>
            <h1><i class="fas fa-list-alt"></i>Lista de Inscripciones</h1>
        </header>

        <nav>
            <div class="btn-group col-md-5" role="group">
                <a href="#" class="btn_registrar btn btn-success">
                    <i class="fas fa-plus-circle"></i> Registrar
                </a>
                <a href="consultar_inscripcion.php" class="btn btn-primary">
                    <i class="fas fa-search"></i> Consultar
                </a>
                <a href="filtrar_inscripcion.php" class="btn btn-danger">
                    <i class="fas fa-filter"> </i> Filtrar
                </a>
            </div>
        </nav>

        <section>
            <article>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12" id="tablaInscripciones">
                        <table class="table table-hover table-sm table-success table-striped">
                            <tr class="table-primary">
                                <th>Nº</th>
                                <th>Codigo</th>
                                <th>N° Boleta</th>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Emision</th>
                                <th>Caducidad</th>
                                <th>Estado</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($rs_inscr as $inscr) {
                                $i++;
                            ?>
                                <tr class="reg_inscripcion">
                                    <td><?= $i ?></td>
                                    <td class="codinscr"><?= $inscr->codigo_inscripcion ?></td>
                                    <td class="numbol"><?= $inscr->numboleta ?></td>
                                    <td class="cli"><?= $inscr->nombre_cliente ?></td>
                                    <td class="serv"><?= $inscr->nombre_servicio ?></td>
                                    <td class="emi"><?= $inscr->emision ?></td>
                                    <td class="cad"><?= $inscr->caducidad ?></td>
                                    <td class="est">
                                        <?php
                                        if ($inscr->estado == 'Vigente') {
                                            echo '<span class="badge rounded-pill bg-success text-white">Vigente</span>';
                                        } elseif ($inscr->estado == 'Próximo' or $inscr->estado == 'Proximo') {
                                            echo '<span class="badge rounded-pill bg-warning text-white">Próximo</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-danger text-white">Vencido</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><a href="#" class="btn_mostrar btn btn-warning"><i class="fas fa-info-circle"></i></td>
                                    <td><a href="#" class="btn_editar btn btn-success"><i class="fas fa-edit"></i></td>
                                    <td><a href="#" class="btn_borrar btn btn-danger"><i class="fas fa-trash"></i></td>
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
                    <h4 class="modal-title text-white" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i> Borrar Inscripcion</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5 class="card-title">¿Seguro que deseas eliminar este registro?</h5>
                        <p class="card-text">
                            <span class="lbl_inscr"></span> (<span class="lbl_codinscr"></span>)
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
                                                <label for="txt_codinscr" class="form-label">Codigo:</label>
                                                <input type="text" class="form-control" id="txt_codinscr" name="txt_codinscr" placeholder="Codigo" maxlength="5" autofocus />
                                            </div>

                                            <div class="col-md-8">
                                                <label for="txt_numbol" class="form-label">N° Boleta:</label>
                                                <input type="text" class="form-control" id="txt_numbol" name="txt_numbol" placeholder="Numero de boleta" maxlength="11" />
                                            </div>

                                            <div class="col-md-12">
                                                <label for="cbo_cli" class="form-label">Cliente:</label>
                                                <select class="form-select form-select-lg mb-3" name="cbo_cli" id="cbo_cli">

                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="cbo_serv" class="form-label">Servicio:</label>
                                                <select class="form-select form-select-lg mb-3" name="cbo_serv" id="cbo_serv">

                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="cbo_prom" class="form-label">Promocion:</label>
                                                <select class="form-select form-select-lg mb-3" name="cbo_prom" id="cbo_prom">

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_emi" class="form-label">Fecha de emision:</label>
                                                <input type="date" class="form-control" id="txt_emi" name="txt_emi" placeholder="Fecha de emision" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_cad" class="form-label">Fecha de caducidad:</label>
                                                <input type="date" class="form-control" id="txt_cad" name="txt_cad" placeholder="Fecha de caducidad" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_prec" class="form-label">Precio de la Inscripcion (S/.):</label>
                                                <input type="number" step="0.01" class="form-control" id="txt_prec" name="txt_prec" placeholder="Precio de inscripcion" />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_pag" class="form-label">Monto Pagado (S/.):</label>
                                                <input type="number" step="0.01" class="form-control" id="txt_pag" name="txt_pag" placeholder="Monto cancelado" />
                                            </div>

                                            <div class="col-md-12">
                                                <label for="cbo_met" class="form-label">Metodo de Pago:</label>
                                                <select class="form-select form-select-lg mb-3" name="cbo_met" id="cbo_met">

                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="cbo_est" class="form-label">Estado de Inscripcion:</label>
                                                <select class="form-select form-select-lg mb-3" name="cbo_est" id="cbo_est">
                                                    <option value="" selected>[Selecciona un estado]</option>
                                                    <option value="Vigente">Vigente</option>
                                                    <option value="Proximo">Proximo</option>
                                                    <option value="Vencido">Vencido</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="txt_deu" class="form-label">Monto de Deuda (S/.):</label>
                                                <input type="number" step="0.01" class="form-control" id="txt_deu" name="txt_deu" placeholder="Deuda" />
                                            </div>
                                        </div>
                                        <div class="text-end modal-footer">
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
                                        <p class="card-text codinscr"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">N° Boleta:</h5>
                                        <p class="card-text numbol"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Cliente:</h5>
                                        <p class="card-text cli"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Servicio:</h5>
                                        <p class="card-text serv"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Promocion:</h5>
                                        <p class="card-text prom"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Fecha de Emision:</h5>
                                        <p class="card-text emi"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Fecha de Caducidad:</h5>
                                        <p class="card-text cad"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Dias restantes:</h5>
                                        <p class="card-text dias_rest"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Precio de la Inscripcion (S/.):</h5>
                                        <p class="card-text prec"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Monto Pagado (S/.):</h5>
                                        <p class="card-text pag"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Metodo de Pago:</h5>
                                        <p class="card-text met"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Estado de Inscripcion:</h5>
                                        <p class="card-text est"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Monto de Deuda (S/.):</h5>
                                        <p class="card-text deu"></p>
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