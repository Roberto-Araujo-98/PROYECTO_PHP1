<?php
/**
 * Sistema Mass - Módulo de Procesamiento de Ventas
 * Práctica Integradora 
 * Archivo: sistema/procesar_venta.php
 */

// ==========================================
// 0. CONFIGURACIÓN DE ENTORNO
// ==========================================
date_default_timezone_set('America/Lima');

// ==========================================
// 1. DATOS DE ENTRADA (Variables iniciales)
// ==========================================
$cliente_nombre = "Roberto Ricardo Araujo";
$cliente_dni    = "73620613";          // Debe tener 8 dígitos exactos y sin letras
$cliente_tipo   = "frecuente";         // Opciones: regular / frecuente / vip
$metodo_pago    = "tarjeta";           // Opciones: efectivo / yape / plin / tarjeta

// Lista de productos comprados (Ampliada con productos reales de Minimarket)
$productos = [
    [
        "nombre"    => "Inca Kola 3L",
        "categoria" => "bebidas",
        "precio"    => 11.50,
        "cantidad"  => 3
    ],
    [
        "nombre"    => "Arroz Costeño Costal 5kg",
        "categoria" => "abarrotes",
        "precio"    => 24.90,
        "cantidad"  => 2
    ],
    [
        "nombre"    => "Leche Gloria Azul Sixpack",
        "categoria" => "lácteos",
        "precio"    => 22.80,
        "cantidad"  => 1
    ],
    [
        "nombre"    => "Plátano de Seda (Kg)",
        "categoria" => "frutas y verduras",
        "precio"    => 4.50,
        "cantidad"  => 2
    ],
    [
        "nombre"    => "Detergente Opal Fuerza Lavanda 800g",
        "categoria" => "limpieza",
        "precio"    => 8.90,
        "cantidad"  => 2
    ],
    [
        "nombre"    => "Pan de Molde Bimbo Grande",
        "categoria" => "panadería",
        "precio"    => 9.20,
        "cantidad"  => 1
    ]
];

// ==========================================
// 2. REGLAS DE NEGOCIO Y LÓGICA
// ==========================================

// REGLA 1: Validación de DNI (if/elseif)
if (strlen($cliente_dni) !== 8 || !ctype_digit($cliente_dni)) {
    echo "<h3>Error: El DNI debe contener exactamente 8 caracteres numéricos. Procesamiento detenido.</h3>";
    exit;
}

// REGLA 7: Saludo según hora actual (date + if/elseif)
$hora_actual = (int)date('H');
$saludo = "";

if ($hora_actual >= 5 && $hora_actual <= 11) {
    $saludo = "Buenos días";
} elseif ($hora_actual >= 12 && $hora_actual <= 18) {
    $saludo = "Buenas tardes";
} elseif ($hora_actual >= 19 && $hora_actual <= 23) {
    $saludo = "Buenas noches";
} else {
    echo "<h3>Tienda cerrada. El sistema no procesa ventas de 00:00 a 04:59 horas.</h3>";
    exit;
}

/

// ==========================================
// 3. OUTPUT: COMPROBANTE HTML PROFESIONAL (ESTILO MASS)
// ==========================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Venta - MASS</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f6f9; padding: 30px; color: #333; }
        .ticket-box { background: #fff; max-width: 520px; margin: 0 auto; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 1px solid #ddd; }
        
        /* Encabezado con los colores corporativos oficiales de la imagen */
        .brand-header { background-color: #ffd200; padding: 25px 20px; text-align: center; border-bottom: 4px solid #0038a8; }
        .logo { font-size: 52px; font-weight: 900; color: #0038a8; font-style: italic; margin: 0; letter-spacing: -1px; display: inline-block; }
        .logo-check { color: #0038a8; font-style: normal; margin-left: -5px; }
        .slogan { font-size: 16px; font-weight: bold; color: #0038a8; margin-top: 8px; text-transform: uppercase; }
        
        .ticket-body { padding: 25px; background: #fff; }
        .tienda-datos { font-size: 11px; color: #666; text-align: center; line-height: 1.5; margin-bottom: 20px; border-bottom: 1px dashed #ccc; padding-bottom: 12px; }
        
        .saludo-cliente { font-style: italic; font-weight: bold; margin-bottom: 15px; font-size: 14px; color: #0038a8; }
        .bloque-info { margin-bottom: 20px; font-size: 12px; }
        .titulo-bloque { font-weight: bold; color: #0038a8; border-bottom: 2px solid #ffd200; margin-bottom: 8px; padding-bottom: 2px; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        
        table { width: 100%; font-size: 12px; border-collapse: collapse; margin-top: 5px; }
        th { text-align: left; background-color: #f9f9f9; color: #0038a8; padding: 6px; border-bottom: 1px solid #ddd; }
        td { padding: 6px; border-bottom: 1px solid #f1f1f1; vertical-align: middle; }
        .align-right { text-align: right; }
        
        .totales-tabla td { padding: 4px 6px; border: none; }
        .linea-totales { border-top: 1px dashed #ccc; padding-top: 10px; margin-top: 10px; }
        .fila-descuento-total { background-color: #fff8d4; font-weight: bold; color: #b88600; border: 1px solid #ffe885; }
        .monto-final { font-size: 16px; font-weight: bold; background-color: #0038a8; color: #fff; border-radius: 4px; }
        .monto-final td { padding: 10px; }
        
        /* Notificación inferior basada en las formas de pago de la marca */
        .pago-footer { background: #f4f6f9; border-left: 5px solid #ffd200; padding: 12px; text-align: center; margin-top: 20px; border-radius: 0 4px 4px 0; }
        .pago-titulo { font-weight: bold; color: #0038a8; font-size: 13px; }
        .pago-instruccion { font-size: 12px; color: #444; margin-top: 3px; display: block; font-weight: bold; }
    </style>
</head>
<body>

<div class="ticket-box">
    <div class="brand-header">
        <h1 class="logo">Mass <span class="logo-check"> ✓</span></h1>
        <div class="slogan">Los mejores precios, cerca de ti</div>
    </div>

    <div class="ticket-body">
        <div class="tienda-datos">
            <strong>Tiendas Mass S.A.C.</strong><br>
            RUC: 20546321852 | Av. Aviación Nro. 2410 - Lima<br>
            EMISIÓN: <?php echo date('d/m/Y H:i:s'); ?>
        </div>

        <div class="saludo-cliente">
            <?php echo $saludo . ", " . $cliente_nombre . "."; ?>
        </div>

        <div class="bloque-info">
            <div class="titulo-bloque">Datos del Comprobante</div>
            <div><strong>Cliente:</strong> <?php echo $cliente_nombre; ?></div>
            <div><strong>DNI:</strong> <?php echo $cliente_dni; ?></div>
            <div><strong>Tipo de Cliente:</strong> <?php echo strtoupper($cliente_tipo); ?></div>
        </div>

        <div class="bloque-info">
            <div class="titulo-bloque">Detalle de Compra</div>
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th class="align-right">Cant</th>
                        <th class="align-right">P.U.</th>
                        <th class="align-right">IGV</th>
                        <th class="align-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalle_procesado as $item): ?>
                    <tr>
                        <td><?php echo $item['nombre']; ?></td>
                        <td class="align-right"><?php echo $item['cantidad']; ?></td>
                        <td class="align-right">S/ <?php echo number_format($item['precio'], 2); ?></td>
                        <td class="align-right">S/ <?php echo number_format($item['igv'], 2); ?></td>
                        <td class="align-right">S/ <?php echo number_format($item['total'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="bloque-info linea-totales">
            <table class="totales-tabla">
                <tr>
                    <td>Total Subtotal Neto:</td>
                    <td class="align-right">S/ <?php echo number_format($total_subtotal_neto, 2); ?></td>
                </tr>
                <tr>
                    <td>Total IGV Acumulado:</td>
                    <td class="align-right">S/ <?php echo number_format($total_igv_acumulado, 2); ?></td>
                </tr>
                <tr>
                    <td style="font-size: 11px; color:#777; padding-left: 15px;">• Descuento Escala (<?php echo ($porcentaje_desc_monto * 100) . "%"; ?>):</td>
                    <td class="align-right" style="font-size: 11px; color:#777;">- S/ <?php echo number_format($descuento_monto, 2); ?></td>
                </tr>
                <tr>
                    <td style="font-size: 11px; color:#777; padding-left: 15px;">• Descuento Fiel <?php echo ucfirst($cliente_tipo); ?> (<?php echo ($porcentaje_desc_cliente * 100) . "%"; ?>):</td>
                    <td class="align-right" style="font-size: 11px; color:#777;">- S/ <?php echo number_format($descuento_cliente, 2); ?></td>
                </tr>
                
                <tr class="fila-descuento-total">
                    <td>AHORRO TOTAL EN DESCUENTOS:</td>
                    <td class="align-right">- S/ <?php echo number_format($total_descuentos, 2); ?></td>
                </tr>
                
                <tr style="height: 10px;"><td></td><td></td></tr>
                
                <tr class="monto-final">
                    <td>TOTAL FINAL A PAGAR:</td>
                    <td class="align-right">S/ <?php echo number_format($total_a_pagar, 2); ?></td>
                </tr>
            </table>
        </div>

        <div class="pago-footer">
            <div class="pago-titulo">MEDIO DE PAGO SELECCIONADO: <?php echo strtoupper($metodo_pago); ?></div>
            <span class="pago-instruccion">
                <?php echo $instruccion_pago; ?>
            </span>
        </div>
    </div>
</div>

</body>
</html>