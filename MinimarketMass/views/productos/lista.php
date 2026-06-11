<?php 
// 1. Incluimos el nuevo Navbar (que reemplaza al header y a la barra_usuario)
require __DIR__ . '/../layout/navbar.php'; 
?>

<div class="contenedor" style="display: flex;">
    <?php require __DIR__ . '/../layout/sidebar.php'; ?>
    
    <main style="flex: 1; padding: 20px;">
        <h1>Catálogo del Minimarket Mass</h1>
        <p>Total de productos: <strong><?= count($productos) ?></strong></p>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Precio con IGV</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->getCodigo()) ?></td>
                    <td><?= htmlspecialchars($p->getNombre()) ?></td>
                    <td class="precio">S/ <?= number_format($p->getPrecio(), 2) ?></td>
                    <td class="precio">S/ <?= number_format($p->precioConIGV(), 2) ?></td>
                    <td <?= $p->getStock() === 0 ? 'class="sin-stock"' : '' ?>>
                        <?= $p->getStock() ?> unidades
                    </td>
                    <td>
    <a href="index.php?accion=editar-producto&codigo=<?= urlencode($producto->getCodigo()) ?>">Editar</a>
</td>
<th>Acciones</th>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<?php 
// 4. Incluimos el nuevo Footer
require __DIR__ . '/../layout/footer.php'; 
?>