<?php
$subtotal = "120.50";
$IGV = 0.18; // 18% de IGV
$total = $subtotal + $subtotal * $IGV;

echo"Boleta de Venta  <br>";
echo "<br>";
echo "Subtotal: " . $subtotal . "<br>";
echo "IGV:".($IGV* $subtotal) . "<br>";
echo "Total:". $total . "<br>";
echo "<br>";
echo " Tipos de datos: <br>";
echo "<br>";
echo "Tipo de dato de subtotal: " . gettype($subtotal) . "<br>";
echo "Tipo de dato de IGV: " . gettype($IGV) . "<br>";
echo "Tipo de dato de total: " . gettype($total) . "<br>";
?> 