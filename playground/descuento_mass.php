<?php

$monto = 169;
switch ($monto ) {
    case $monto <= 0:
        echo "No puede ser negativo, campeón";
        break;
    case $monto > 0 && $monto < 30:
        echo "Sin descuento";
        break;
    case $monto < 99.99:
        echo "Felicidades, tienes un descuento del 5%";
        break;
    case $monto >= 100 && $monto < 199.99:
        echo "Felicidades, tienes un descuento del 10%";
        break;
    case $monto >=200:
        echo "Felicidades, tienes un descuento del 15%";
        break;
    
    default:
}

?>

<?php
/*
 * ============================================================
 *  EJERCICIO 1 · PAREJA — Calculadora de descuento por monto
 *  Versión : usando match() — PHP 8.0+
 *  Alumno  : ANTHONY DORLY HUILAHUAÑA CHATA
 *  Archivo : descuento_mass.php
 * ============================================================
 */

// ── Monto de compra (cambia este valor para probar) ─────────
$monto = 150.00;

// ── Determinar porcentaje con match ─────────────────────────
$porcentaje = match(true) {
    $monto < 30    => 0,
    $monto < 100   => 5,
    $monto < 200   => 10,
    default        => 15,
};

// ── Cálculos ────────────────────────────────────────────────
$monto_descuento = $monto * ($porcentaje / 100);
$monto_final     = $monto - $monto_descuento;

// ── Mostrar resultados ──────────────────────────────────────
echo "Monto original    : S/ " . number_format($monto, 2) . "\n";
echo "Descuento aplicado: " . $porcentaje . "%\n";
echo "Monto de descuento: S/ " . number_format($monto_descuento, 2) . "\n";
echo "Monto final       : S/ " . number_format($monto_final, 2) . "\n";

/*
 * ── ¿POR QUÉ match(true)? ───────────────────────────────────
 *
 *  match compara el valor que le pasas contra cada caso.
 *  Al pasarle (true), cada rama evalúa una condición booleana
 *  y entra en la primera que sea verdadera (true).
 *
 *  Ventajas sobre if/elseif:
 *  - No necesita break
 *  - Devuelve un valor directamente (se guarda en $porcentaje)
 *  - Comparación estricta (===), más segura
 *  - Código más corto y limpio
 *
 * ── CASOS DE PRUEBA ─────────────────────────────────────────
 *  $monto = 20.00   →  0%  sin descuento
 *  $monto = 50.00   →  5%  de descuento
 *  $monto = 150.00  → 10%  de descuento
 *  $monto = 250.00  → 15%  de descuento
 * ============================================================
 */
?>