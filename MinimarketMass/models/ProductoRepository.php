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
    public function crear(array $d): bool {
    try {
        $pdo  = getConexion();
        $stmt = $pdo->prepare(
            "INSERT INTO productos (codigo_barras, nombre, marca, categoria_id, precio, stock)
             VALUES (:codigo, :nombre, :marca, :categoria, :precio, :stock)"
        );
        return $stmt->execute([
            ':codigo' => $d['codigo'], ':nombre' => $d['nombre'], ':marca' => $d['marca'],
            ':categoria' => $d['categoria'], ':precio' => $d['precio'], ':stock' => $d['stock'],
        ]);
    } catch (PDOException $e) {
        error_log('[crear] ' . $e->getMessage());
        return false;
    }

    }

// Muestra el formulario con los datos actuales del producto
public function editar(): void
{
    $codigo = $_GET['codigo'] ?? '';

    $repo = new ProductoRepository();
    $producto = $repo->buscarPorCodigo($codigo);

    if ($producto === null) {
        header('Location: index.php');
        exit;
    }

    require __DIR__ . '/../views/productos/editar.php';
}

// Procesa el formulario y guarda los cambios (Post-Redirect-Get)
public function actualizar(): void
{
    $codigo = $_POST['codigo'] ?? '';
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = $_POST['precio'] ?? '';
    $stock  = $_POST['stock']  ?? '';

    // Validación
    if ($codigo === '' || $nombre === '' || $precio === '' || $stock === '') {
        $error = 'Todos los campos son obligatorios.';
        $producto = new Producto($codigo, $nombre, (float)$precio, (int)$stock);
        require __DIR__ . '/../views/productos/editar.php';
        return;
    }

    $producto = new Producto($codigo, $nombre, (float)$precio, (int)$stock);

    $repo = new ProductoRepository();
    $repo->actualizar($producto);

    header('Location: index.php'); // PRG → vuelve al catálogo
    exit;
}
    public function guardar(): void {
    $codigo    = trim($_POST['codigo'] ?? '');
    $nombre    = trim($_POST['nombre'] ?? '');
    $marca     = trim($_POST['marca'] ?? '');
    $categoria = (int)  ($_POST['categoria'] ?? 0);
    $precio    = (float)($_POST['precio'] ?? 0);
    $stock     = (int)  ($_POST['stock'] ?? 0);

    // Validación de campos
    if ($codigo === '' || $nombre === '' || $precio <= 0) {
        $error = 'Completa código, nombre y un precio mayor a 0.';
        require __DIR__ . '/../views/productos/crear.php';
        return;
    }

    // El código de barras es ÚNICO: si ya existe, no se repite
    if ($this->repo->buscarPorCodigo($codigo) !== null) {
        $error = 'Ya existe un producto con ese código de barras.';
        require __DIR__ . '/../views/productos/crear.php';
        return;
    }

    $this->repo->crear([
        'codigo' => $codigo, 'nombre' => $nombre, 'marca' => $marca,
        'categoria' => $categoria, 'precio' => $precio, 'stock' => $stock,
    ]);

    header('Location: index.php?accion=catalogo');  // Post-Redirect-Get
    exit;
}
}
