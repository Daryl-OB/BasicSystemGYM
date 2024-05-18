<!DOCTYPE html>
<html lang="es">
<?php
$ruta = "../..";
$titulo = "App GYM - Consultar Metodo";
include("../includes/cabecera.php");
include("../controlador/ctr_validar_sesion.php");
?>

<body>
    <?php
    include("../includes/menu.php");
    ?>
    <div class="container mt-3">
        <header>
            <h1><i class="fas fa-search"></i> Consultar Metodo</h1>
        </header>

        <nav>
            <a href="listar_metodo.php" class="btn btn-outline-secondary btn-sm">
                <li class="fas fa-arrow-circle-left"></li> Regresar
            </a>
        </nav>

        <section>
            <article>
                <div class="row justify-content-center mt-3">
                    <div class="card col-md-6">
                        <div class="card-body">
                            <form id="frm_consultar_met" name="frm_consultar_met" method="post">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="txt_codmet" class="frm-label">Código</label>
                                        <input type="text" class="form-control" id="txt_codmet" name="txt_codmet" placeholder="Código a buscar" maxlength="5" autofocus />
                                    </div>

                                    <div class="col-md-8"></div>

                                    <div class="col-md-12">
                                        <div class="row align-items-start">
                                            <div class="col">
                                                <h5 class="card-title">Metodo de pago</h5>
                                                <p class="met card-text">&nbsp;</p>
                                            </div>
                                            <div class="col">
                                                <h5 class="card-title">Descripcion</h5>
                                                <p class="descr card-text">&nbsp;</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a type="submit" href="consultar_metodo.php" class="btn btn-outline-primary">
                                    <i class="fas fa-file"></i> Nueva consulta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>


        <div class="modal fade" id="md_consulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Advertencia</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../includes/pie.php");
        ?>

    </div>
</body>

</html>