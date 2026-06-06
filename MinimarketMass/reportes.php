<?php
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/models/ProductoRepository.php';

$repo = new ProductoRepository();

$stockBajo = $repo->obtenerStockBajo();
$valorTotal = $repo->obtenerValorTotalInventario();
$masCaros = $repo->obtenerProductosMasCaros();
$masStock = $repo->obtenerProductosConMasStock();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Minimarket Mass</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f9; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .card { background: white; border: 1px solid #ddd; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border-bottom: 1px solid #eee; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Reportes del Inventario</h1>
    <div class="grid">
        <div class="card">
            <h3>Productos con Menor Stock  </h3>
            <table>
                <tr><th>Nombre</th><th>Stock</th></tr>
                <?php foreach ($stockBajo as $p): ?>
                <tr><td><?= $p['nombre'] ?></td><td><?= $p['stock'] ?></td></tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card">
            <h3>Valor Total del Inventario</h3>
            <h1 style="color: #27ae60;">$<?= number_format($valorTotal, 2) ?></h1>
        </div>
        <div class="card">
            <h3>Top 5 Productos más caros</h3>
            <table>
                <tr><th>Nombre</th><th>Precio</th></tr>
                <?php foreach ($masCaros as $p): ?>
                <tr><td><?= $p['nombre'] ?></td><td>$<?= number_format($p['precio'], 2) ?></td></tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card">
            <h3>Top 5 con más unidades en stock</h3>
            <table>
                <tr><th>Nombre</th><th>Stock</th></tr>
                <?php foreach ($masStock as $p): ?>
                <tr><td><?= $p['nombre'] ?></td><td><?= $p['stock'] ?></td></tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>