

<?php
// 1. DEFINICIÓN DE VARIABLES (Lógica de PHP)

// El nombre de tu tienda (puedes cambiarlo si quieres)
$nombreTienda = "Mass Arequipa"; 
$tituloPagina = "Bienvenido a Mass — " . $nombreTienda;

// Configurar la zona horaria de Perú para que la fecha salga exacta
date_default_timezone_set('America/Lima');

// Obtener la fecha de hoy en formato legible (ej: 23/05/2026)
$fechaHoy = date("d/m/Y");

// Lista de tres categorías (usamos un array para manejarlo mejor)
$categorias = ["Abarrotes", "Bebidas y Lácteos", "Limpieza"];

// Mensaje de promoción con contexto peruano
$promocionDia = "Solo por hoy, lleva tu Pack :2 Pepsi's Personales + 1 bolsa de Chifles a solo S/ 12.50. ¡No te lo pierdas!";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina; ?></title>
</head>
<body>

    <h1><?php echo $tituloPagina; ?></h1>

    <p>Fecha de hoy: <?php echo $fechaHoy; ?></p>

    <h3>Categorías Disponibles:</h3>
    <ul>
        <?php foreach ($categorias as $categoria): ?>
            <li><?php echo $categoria; ?></li>
        <?php endforeach; ?>
    </ul>

    <p><strong><?php echo $promocionDia; ?></strong></p>

</body>
</html>