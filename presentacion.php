<?php
$producto   = "Paneton Santa Clara 900g";
$marca = "Panamericana";
$precio     = 8.90;
$stock      = 69;
$categoria = "Alimentos";

echo "Ficha de producto MASS <br>";
echo "Nombre del producto: " . $producto . "<br>";
echo "Marca: " . $marca . "<br>";
echo "Precio: S/ " . number_format($precio, 2) . "<br>";
echo "Stock: " . $stock . " unidades<br>";
echo "Categoría: " . $categoria . "<br>";
?>

