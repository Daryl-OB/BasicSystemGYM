<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <h3 class="navbar-brand">App GYM</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>/servicio">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>/metodo">Metodos de Pago</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>/promocion">Promociones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>/cliente">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>/inscripcion">Inscripciones</a>
                </li>
            </ul>
        </div>
        <form class="d-flex" method="post" action="../controlador/ctr_validar_sesion.php">
            <button class="btn btn-outline-danger" type="submit" name="logout">Cerrar Sesión</button>
        </form>
    </div>
</nav>