<?php
session_start();

// Verificar si se ha hecho clic en el botón "Cerrar Sesión"
if (isset($_POST['logout'])) {
    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio
    header("location: ../../");
    exit();
}

// Verificar si la variable de sesión está definida y no está vacía
if (!isset($_SESSION['cliente']) || empty($_SESSION['cliente'])) {
    // Si no hay una sesión de cliente iniciada, redirigir al usuario a la página de inicio de sesión
    header("location: ../../");
    exit();
}

