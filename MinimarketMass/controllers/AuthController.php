<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/UsuarioRepository.php';

class AuthController {

    private const TIEMPO_BLOQUEO_MINUTOS = 1; // Cambia aquí los minutos que quieras

    public function mostrarLogin(string $error = ''): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function procesarLogin(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Verificar si está bloqueado por tiempo
        if (isset($_SESSION['bloqueado_hasta'])) {
            if (time() < $_SESSION['bloqueado_hasta']) {
                $restante = $_SESSION['bloqueado_hasta'] - time();
                $minutos = ceil($restante / 60);
                
                $this->mostrarLogin("Demasiados intentos. Inténtalo de nuevo en {$minutos} minuto(s).");
                return;
            } else {
                // El tiempo ya pasó: liberamos el bloqueo y reiniciamos el contador
                unset($_SESSION['bloqueado_hasta']);
                $_SESSION['intentos_login'] = 0;
            }
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->mostrarLogin('Completa usuario y contraseña.');
            return;
        }

        $repo    = new UsuarioRepository();
        $usuario = $repo->buscarPorUsername($username);

        // 2. Credenciales incorrectas
        if ($usuario === null || !$usuario->verificarPassword($password)) {
            $_SESSION['intentos_login'] = ($_SESSION['intentos_login'] ?? 0) + 1;

            if ($_SESSION['intentos_login'] >= 3) {
                // Registramos el momento del bloqueo (Tiempo actual + X minutos en segundos)
                $_SESSION['bloqueado_hasta'] = time() + (self::TIEMPO_BLOQUEO_MINUTOS * 60);
                
                $this->mostrarLogin('Demasiados intentos. Acceso bloqueado por ' . self::TIEMPO_BLOQUEO_MINUTOS . ' minutos.');
            } else {
                $this->mostrarLogin('Usuario o contraseña incorrectos.');
            }
            return;
        }

        // 3. Login Exitoso
        $_SESSION['intentos_login'] = 0;
        unset($_SESSION['bloqueado_hasta']);

        $_SESSION['usuario'] = [
            'id'       => $usuario->getId(),
            'username' => $usuario->getUsername(),
            'nombre'   => $usuario->getNombreCompleto(),
            'rol'      => $usuario->getRol(),
            'tienda'   => $usuario->getTienda(),
        ];

        header('Location: index.php?accion=catalogo');
        exit;
    }

    public function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?accion=login');
        exit;
    }
}