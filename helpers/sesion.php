<?php
declare(strict_types=1);

function requiereLogin(): void {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?accion=login');
        exit;
    }
}

function usuarioActual(): ?array {
    return $_SESSION['usuario'] ?? null;
}

function requiereRol(string $rol): void {
    // 1. Primero verificamos si hay sesión activa
    $usuario = usuarioActual();
    
    if (!$usuario) {
        // Si no hay sesión, mandamos al login
        header('Location: index.php?accion=login');
        exit;
    }

    // 2. Comparamos el rol del usuario logueado con el rol requerido
    if ($usuario['rol'] !== $rol) {
        // Si no tiene el rol, bloqueamos (puedes redirigir o mostrar mensaje)
        die("Acceso denegado: No tienes permisos para esta sección.");
    }
}