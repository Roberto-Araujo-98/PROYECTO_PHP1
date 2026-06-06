<?php
declare(strict_types=1);

// La sesión debe arrancar ANTES de cualquier salida al navegador.
session_start();

require_once __DIR__ . '/../../helpers/sesion.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';

// Enrutamiento simple por ?accion=
$accion = $_GET['accion'] ?? 'catalogo';
$auth   = new AuthController();

switch ($accion) {

    case 'login':
        $auth->mostrarLogin();
        break;

    case 'procesar-login':
        $auth->procesarLogin();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'panel-admin':
        requiereRol('admin');
        $usuario = usuarioActual(); // Guardamos el array en una variable
        echo "<h1>Panel de administración</h1>";
        echo "<p>Bienvenido, administrador: " . htmlspecialchars($usuario['nombre']) . "</p>";
        echo "<a href='index.php'>Volver al catálogo</a>";
        break;

    case 'catalogo':
    default:
        requiereLogin();                      // sin sesión → manda al login
        (new ProductoController())->listar(); // ← llama al método REAL del controller
        break;
}