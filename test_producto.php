<?php
declare(strict_types=1);
require_once 'clases/Producto.php';

// 1. Crear los objetos (Los datos entran aquí)
$incaKola = new Producto('INC500', 'Inca Kola 500ml', 3.50, 48, 'The Coca-Cola Company', true, 0.10, 'Bebidas');
$Black = new Producto('B3l', 'Black', 2.50, 30, 'Socosani', true, 0.15, 'Bebidas');
$Lechecondensada = new Producto('LC001', 'Leche Condensada', 2.00, 25, 'Socosani', true, 0.10, 'Bebidas');
$Guarana = new Producto('G400', 'Guaraná 400ml', 3.00, 40, 'The Coca-Cola Company', false, 0.12, 'Bebidas');

// 2. Leer las propiedades usando los métodos GET

// --- INCA KOLA ---
echo "<h1><center>Tiendas Senati</center></h1>"; // Título principal para la página
echo "<h2>Detalles del Producto</h2>"; // Título para la sección de productos
echo "Nombre del producto: ".$incaKola->getNombre();
echo "<br>Precio: ".number_format($incaKola->getPrecio(), 2);  
echo "<br>Stock: ".$incaKola->getStock(); 
echo "<br>Resultado de 6**2: ".(4*9);
echo "<br>Marca: ".$incaKola->getMarca();
echo "<br>Categoria: ".$incaKola->getCategoria();
echo "<br>Descuento: ".($incaKola->getDescuento() * 100)."% por compras mayores a 3 unidades ";
echo "<br>Disponible: ".($incaKola->getDisponible() ? 'Sí' : 'No');

echo "<br><hr>"; // Separador visual

// --- BLACK ---
echo "Nombre del producto: ".$Black->getNombre(); 
echo "<br>Precio: ".number_format($Black->getPrecio(), 2);  
echo "<br>Stock: ".$Black->getStock(); 
echo "<br>Marca: ".$Black->getMarca();
echo "<br>Categoria: ".$Black->getCategoria();
echo "<br>Descuento: ".($Black->getDescuento() * 100)."% por compras mayores a 3 unidades ";
echo "<br>Disponible: ".($Black->getDisponible() ? 'Sí' : 'No');

echo "<br><hr>"; // Separador visual

// --- LECHE CONDENSADA ---
echo "Nombre del producto: ".$Lechecondensada->getNombre(); 
echo "<br>Precio: ".number_format($Lechecondensada->getPrecio(), 2);  
echo "<br>Stock: ".$Lechecondensada->getStock(); 
echo "<br>Marca: ".$Lechecondensada->getMarca();
echo "<br>Categoria: ".$Lechecondensada->getCategoria();
echo "<br>Descuento: ".($Lechecondensada->getDescuento() * 100)."% por compras mayores a 3 unidades ";
echo "<br>Disponible: ".($Lechecondensada->getDisponible() ? 'Sí' : 'No');

echo "<br><hr>"; // Separador visual

// --- GUARANÁ ---
echo "Nombre del producto: ".$Guarana->getNombre(); 
echo "<br>Precio: ".number_format($Guarana->getPrecio(), 2);  
echo "<br>Stock: ".$Guarana->getStock(); 
echo "<br>Marca: ".$Guarana->getMarca();
echo "<br>Categoria: ".$Guarana->getCategoria();
echo "<br>Descuento: ".($Guarana->getDescuento() * 100)."% por compras mayores a 3 unidades ";
echo "<br>Disponible: ".($Guarana->getDisponible() ? 'Sí' : 'No');

?>
<style>
    body {
        /* Creamos un gradiente super ancho con varios colores */
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        background-size: 400% 400%; /* Esto es clave para que haya espacio para moverse */
        
        /* Ejecutamos la animación */
        animation: fluidGradient 2sease infinite;
        
        /* Estilos de texto para que se lea bien sobre el fondo */
        color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        padding: 20px;
        line-height: 1.6;
    }

    /* La magia del movimiento */
    @keyframes fluidGradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    hr {
        border: 0;
        height: 1px;
        background: rgba(255,255,255,0.3);
        margin: 20px 0;
    }
</style>