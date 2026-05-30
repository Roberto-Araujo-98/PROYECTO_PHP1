<?php
$producto = "Inca Kola 1.5L";
$stock    = 7;

if ($stock === 0) {
    echo $producto . ": AGOTADO - reponer urgente";
} elseif ($stock < 10) {
    echo $producto . ": stock bajo (" . $stock . " unid.) - reponer pronto";
} elseif ($stock < 50) {
    echo $producto . ": stock normal";
} else {
    echo $producto . ": stock alto";
}
$producto = false;
$descuento = ($producto) ? 0.10 : 0.05;

echo  "<br>" .$descuento; // Si el producto existe, descuento del 10%, sino 5%


echo "<br>" . "<br>";


$categoria = "bebidas";

switch ($categoria) {
    case "abarrotes":
        $pasillo = "Pasillo 1";
        $igv = 0.18;
        break;
    case "bebidas":
        $pasillo = "Pasillo 2";
        $igv = 0.18;
        break;
    case "lacteos":
        $pasillo = "Pasillo 3";
        $igv = 0.18;
        break;
    case "panaderia":
    case "frutas":
        $pasillo = "Zona fresca";
        $igv = 0; // inafecto
        break;
    default:
        $pasillo = "No definido";
        $igv = 0.18;
}

echo "Categoría: " . $categoria . "<br>";
echo "Pasillo: " . $pasillo . "<br>";
echo "IGV: " . ($igv * 100) . "%";


?>
