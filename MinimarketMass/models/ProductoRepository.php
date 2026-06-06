<?php
declare(strict_types=1);
require_once __DIR__ . '/Producto.php';
require_once __DIR__ . '/../config/conexion.php';

class ProductoRepository {

    // --- MÉTODOS ORIGINALES (NO TOCAR) ---

    public function obtenerTodos(): array {
        try {
            $pdo = getConexion();
            $stmt = $pdo->query("SELECT codigo_barras AS codigo, nombre, precio, stock FROM productos ORDER BY nombre");
            $productos = [];
            foreach ($stmt->fetchAll() as $f) {
                $productos[] = new Producto($f['codigo'], $f['nombre'], (float) $f['precio'], (int) $f['stock']);
            }
            return $productos;
        } catch (PDOException $e) {
            error_log('[ProductoRepository::obtenerTodos] ' . $e->getMessage());
            return [];
        }
    }

    public function buscarPorCodigo(string $codigo): ?Producto {
        try {
            $pdo = getConexion();
            $stmt = $pdo->prepare("SELECT codigo_barras AS codigo, nombre, precio, stock FROM productos WHERE codigo_barras = :codigo");
            $stmt->execute([':codigo' => $codigo]);
            $fila = $stmt->fetch();
            if ($fila === false) return null;
            return new Producto($fila['codigo'], $fila['nombre'], (float) $fila['precio'], (int) $fila['stock']);
        } catch (PDOException $e) {
            error_log('[ProductoRepository::buscarPorCodigo] ' . $e->getMessage());
            return null;
        }
    }

    // --- NUEVOS REPORTES (ESTABLES) ---

public function obtenerStockBajo(): array {
        try {
            $pdo = getConexion();
            // Esto siempre traerá los 5 productos con menos stock, 
            // aunque el más bajo tenga 50 unidades.
            $stmt = $pdo->query("SELECT nombre, stock FROM productos ORDER BY stock ASC LIMIT 5");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { return []; }
    }
    public function obtenerValorTotalInventario(): float {
        try {
            $pdo = getConexion();
            $stmt = $pdo->query("SELECT SUM(precio * stock) AS total FROM productos");
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return (float) ($res['total'] ?? 0);
        } catch (PDOException $e) { return 0.0; }
    }

    public function obtenerProductosMasCaros(): array {
        try {
            $pdo = getConexion();
            $stmt = $pdo->query("SELECT nombre, precio FROM productos ORDER BY precio DESC LIMIT 5");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { return []; }
    }

    public function obtenerProductosConMasStock(): array {
        try {
            $pdo = getConexion();
            $stmt = $pdo->query("SELECT nombre, stock FROM productos ORDER BY stock DESC LIMIT 5");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { return []; }
    }
}