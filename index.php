<!DOCTYPE html>
<html lang="es">
<?php
$ruta = ".";
$titulo = "App GYM";
include("paginas/includes/cabecera.php");
?>
<body>
    <style>
        .active-button {
            background-color: #007bff;
            /* Cambia este color según tus preferencias */
            color: #fff;
            /* Cambia el color del texto para que sea legible */
        }
    </style>

    <!-- Pills navs -->
    <div class="container mt-3">
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item m-1" role="presentation">
                <a class="nav-link " id="tab-login" data-mdb-pill-init href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Iniciar sesión</a>
            </li>
            <li class="nav-item m-1" role="presentation">
                <a class="nav-link" id="tab-register" data-mdb-pill-init href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Recuperar mi cuenta</a>
            </li>
        </ul>
    </div>
    <!-- Pills navs -->
    <!-- Pills content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-primary-subtle rounded-3 p-5">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form class="col-md-12" name="frm_iniciar_sesion" id="frm_iniciar_sesion" method="POST" action="paginas/controlador/ctr_iniciar_sesion.php">
                            <div class="text-center mb-5">
                                 <h3><i class="fa fa-lg fa-fw fa-user"></i> INICIAR SESION</h3>
                            </div>
                            <input type="hidden" id="tipo" name="tipo" value="is">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="txt_user">Codigo de usuario:</label>
                                <input type="text" id="txt_user" name="txt_user" class="form-control" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-5">
                                <label class="form-label" for="txt_contra">Contraseña:</label>
                                <input type="password" id="txt_contra" name="txt_contra" class="form-control" />
                            </div>

                            <!-- Submit button -->
                            <button type="submit" id="btn_iniciar_sesion" name="btn_iniciar_sesion" class="col-12 btn btn-primary btn-block mb-4">Iniciar sesión</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form class="col-md-12" id="frm_recuperar_cuenta" name="frm_recuperar_cuenta" method="POST" action="paginas/controlador/ctr_recuperar_cuenta.php">
                            <div class="text-center mb-5">
                                <h3><i class="fa fa-lg fa-fw fa-lock"></i> ¿OLVIDASTE TU CONTRASEÑA?</h3>
                            </div>

                            <input type="hidden" id="tipo" name="tipo" value="rc">

                            <!-- Codigo input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="txt_user">Ingresa tu codigo de usuario:</label>
                                <input type="text" id="txt_user" name="txt_user" class="form-control" />
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="txt_mail">Ingresa tu correo electronico:</label>
                                <input type="email" id="txt_mail" name="txt_mail" class="form-control" />
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="btn_recuperar_cuenta" id="btn_recuperar_cuenta" class="col-12 btn btn-primary btn-block mb-3">Recuperar mi cuenta</button>
                        </form>
                    </div>
                </div>
                <!-- Pills content -->
            </div>
        </div>
    </div>
    <script>
        // Función para cambiar entre pestañas y resaltar el botón activo
        function cambiarPestana(pestana) {
            // Ocultar todas las pestañas
            var pestanas = document.getElementsByClassName('tab-pane');
            for (var i = 0; i < pestanas.length; i++) {
                pestanas[i].classList.remove('show', 'active');
            }

            // Mostrar la pestaña seleccionada
            var pestanaSeleccionada = document.getElementById(pestana);
            pestanaSeleccionada.classList.add('show', 'active');

            // Resaltar el botón activo
            var botones = document.querySelectorAll('.nav-link');
            for (var j = 0; j < botones.length; j++) {
                botones[j].classList.remove('active-button');
            }
            document.querySelector('[data-mdb-pill-init][href="#' + pestana + '"]').classList.add('active-button');

            // Despintar el otro botón
            var otroBoton = (pestana === 'pills-login') ? 'pills-register' : 'pills-login';
            document.querySelector('[data-mdb-pill-init][href="#' + otroBoton + '"]').classList.remove('active-button');
        }

        // Event listener para los enlaces de navegación
        document.addEventListener('DOMContentLoaded', function() {
            var enlacesNavegacion = document.querySelectorAll('[data-mdb-pill-init]');
            enlacesNavegacion.forEach(function(enlace) {
                enlace.addEventListener('click', function(event) {
                    event.preventDefault();
                    var destino = this.getAttribute('href').substring(1); // Eliminar el símbolo #
                    cambiarPestana(destino);
                });
            });
        });
    </script>