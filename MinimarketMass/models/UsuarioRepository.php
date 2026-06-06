<?php
declare(strict_types=1);
require_once __DIR__ . '/Usuario.php';
require_once __DIR__ . '/../config/conexion.php';

class UsuarioRepository {

    public function buscarPorUsername(string $username): ?Usuario {
        try {
            $pdo  = getConexion();
            // SE AGREGA 'contador_accesos' AL SELECT
            $stmt = $pdo->prepare(
                "SELECT id, username, nombres, apellidos, rol, tienda, password_hash, contador_accesos
                 FROM usuarios
                 WHERE username = :username AND activo = 1"
            );
            $stmt->execute([':username' => $username]);
            $f = $stmt->fetch();
            
            if ($f === false) return null;
            
            // SE PASA EL CONTADOR AL CONSTRUCTOR DEL MODELO
            return new Usuario(
                (int) $f['id'], 
                $f['username'], 
                $f['nombres'], 
                $f['apellidos'],
                $f['rol'], 
                $f['tienda'], 
                $f['password_hash'],
                (int) $f['contador_accesos']
            );
        } catch (PDOException $e) {
            error_log('[UsuarioRepository] ' . $e->getMessage());
            return null;
        }
    }

    public function registrarAcceso(int $id): void {
        try {
            $pdo = getConexion();
            $stmt = $pdo->prepare("
                UPDATE usuarios 
                SET ultimo_acceso = NOW(), 
                    contador_accesos = contador_accesos + 1 
                WHERE id = :id
            ");
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log('[UsuarioRepository::registrarAcceso] ' . $e->getMessage());
        }
    }

    public function obtenerContadorActual(int $id): int {
        try {
            $pdo = getConexion();
            $stmt = $pdo->prepare("SELECT contador_accesos FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $resultado = $stmt->fetchColumn();
            return $resultado !== false ? (int)$resultado : 0;
        } catch (PDOException $e) {
            error_log('[UsuarioRepository::obtenerContadorActual] ' . $e->getMessage());
            return 0;
        }
    }
}