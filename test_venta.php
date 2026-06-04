<?php
require_once 'clases/Producto.php';
require_once 'clases/Cliente.php';
require_once 'clases/DetalleVenta.php';
require_once 'clases/Venta.php';

function assert_test(string $nombre, float $obtenido, float $esperado) {
    if (abs($obtenido - $esperado) < 0.01) {
        echo "✅ PASS: $nombre (Resultado: $obtenido)\n";
    } else {
        echo "❌ FAIL: $nombre (Esperaba $esperado, pero obtuve $obtenido)\n";
    }
}

// 1. Configuración de prueba
$cliente = new Cliente('12345678', 'Test', 'User');
$venta = new Venta($cliente, 'efectivo');

// 2. Producto de prueba: Precio 100, Cantidad 1. 
// Si es inafecto (como panadería), IGV es 0.
$venta->agregarDetalle(new DetalleVenta(new Producto('T01', 'Pan', 100.0, 10, 'Mass', true, 0, 'panadería'), 1));

// 3. Ejecutar pruebas
assert_test("Subtotal", $venta->calcularSubtotal(), 100.0);
assert_test("IGV (Inafecto)", $venta->calcularIgvTotal(), 0.0);
assert_test("Total Final", $venta->calcularTotal(), 100.0);

echo "\n--- Fin de las pruebas ---";