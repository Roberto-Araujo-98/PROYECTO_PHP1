<?php 
// Obtenemos la acción actual, si no hay ninguna, asumimos que es 'catalogo'
$accion = $_GET['accion'] ?? 'catalogo'; 

// Definimos estilos base y colores
$linkStyle = "text-decoration:none; color:#333; padding:8px; border-radius:5px;";
$activeStyle = "background:#0066B3; color:#fff; font-weight:bold;"; // Estilo para el botón activo
?>

<aside style="width:220px; background:#f8f9fa; padding:20px; height:85vh; border-right:1px solid #ddd;">
    <nav style="display:flex; flex-direction:column; gap:10px;">
        
        <a href="index.php?accion=catalogo" 
           style="<?= $linkStyle . ($accion == 'catalogo' ? $activeStyle : '') ?>">
           📦 Catálogo
        </a>

        <a href="index.php?accion=nuevo-producto" 
           style="<?= $linkStyle . ($accion == 'nuevo-producto' ? $activeStyle : '') ?>">
           ➕ Nuevo producto
        </a>

        <a href="#" style="<?= $linkStyle ?>">✏️ Editar</a>
        <a href="#" style="<?= $linkStyle ?>">📊 Reportes</a>
        
    </nav>
</aside>