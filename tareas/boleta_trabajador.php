<?php
// =======================================================
// BOLETA DE PAGO - MINIMARKET MASS
// Autor: Roberto Ricardo Araujo Ari
// =======================================================

// 1. Variables de Datos del trabajador
$nombre         = "Carlos Eduardo Mamani Quispe";
$dni            = "74521893";
$cargo          = "Jefe de almacén";
$tienda         = "Mass Cayma";
$periodo        = "Mayo 2026";
$dias_trab      = 30;

// 2. Variables de ingresos base y variables de horas extras
$sueldo_base        = 2850.00;
$asig_familiar      = 102.50; // Se asigna por tener hijos menores
$horas_extras       = 12;
$valor_hora_extra   = 18.50;

// 3. Variables de tasas de descuento y aportes (Buenas prácticas al centralizar porcentajes)
$tasa_afp       = 0.13; // 13% de aporte obligatorio
$tasa_renta     = 0.08; // 8% simplificado de 5ta categoría
$tasa_essalud   = 0.09; // 9% asumido por el empleador (Reto 1)

// ============================================================================
// 4. Bloque de Cálculos Operacionales (Uso de operadores aritméticos)
// ============================================================================

// Cálculo de los ingresos totales
$pago_horas_extras = $horas_extras * $valor_hora_extra;
$total_ingresos    = $sueldo_base + $asig_familiar + $pago_horas_extras;

// Cálculo de los descuentos de ley (aplicados sobre el total de ingresos)
$descuento_afp   = $total_ingresos * $tasa_afp;
$descuento_renta = $total_ingresos * $tasa_renta;
$total_descuentos = $descuento_afp + $descuento_renta;

// Cálculo del sueldo neto final a recibir por el trabajador
$sueldo_neto = $total_ingresos - $total_descuentos;

// --- Cálculos de Retos Adicionales (Bonus) ---
// Reto 1: Aporte de EsSalud (9% del sueldo bruto base)
$essalud_empleador = $sueldo_base * $tasa_essalud;

// Reto 2: Costo total que representa el trabajador para la empresa
$costo_total_empresa = $total_ingresos + $essalud_empleador;

// Reto 4: Cálculo del sueldo proporcional si solo hubiera trabajado 22 días
$dias_proporcionales = 22;
$sueldo_proporcional = ($sueldo_base / 30) * $dias_proporcionales;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Pago - <?php echo $nombre; ?></title>
    <style>
        /* Estilos globales y tipografía limpia */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9f0;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Contenedor principal estilo boleta formal */
        .boleta-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #dcdcdc;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        /* Encabezados y títulos */
        h1 {
            color: #003366;
            font-size: 24px;
            text-align: center;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h3 {
            color: #555;
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: normal;
            border-bottom: 2px solid #003366;
            padding-bottom: 10px;
        }

        /* Estructura de tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px 12px;
            font-size: 14px;
            text-align: left;
        }

        /* Tabla de datos personales */
        .tabla-datos {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            margin-bottom: 25px;
        }

        .tabla-datos td {
            border: none;
        }

        /* Tablas de conceptos financieros */
        .tabla-financiera th {
            color: #ffffff;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        /* Colores diferenciales solicitados */
        .bg-ingresos { background-color: #2e7d32; } /* Verde para Ingresos */
        .bg-descuentos { background-color: #c62828; } /* Rojo para Descuentos */
        .bg-totales { background-color: #37474f; } /* Gris oscuro para Netos y Empresa */

        .tabla-financiera td {
            border-bottom: 1px solid #dee2e6;
        }

        .text-right {
            text-align: right;
        }

        .fila-total {
            font-weight: bold;
            background-color: #f1f3f5;
        }

        .fila-neto {
            font-weight: bold;
            color: #ffffff;
        }

        /* Sección informativa de retos */
        .seccion-informativa {
            background-color: #e8f4fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin-top: 25px;
            font-size: 13px;
        }

        .seccion-informativa h4 {
            margin: 0 0 8px 0;
            color: #0d47a1;
        }

        /* Optimización para impresión */
        @media print {
            body { background-color: #fff; padding: 0; }
            .boleta-container { box-shadow: none; border: none; padding: 0; }
            .bg-ingresos, .bg-descuentos, .bg-totales {
                color: #000 !important;
                background-color: transparent !important;
                border-bottom: 2px solid #000;
            }
            th { color: #000 !important; }
            .seccion-informativa { border: 1px solid #ccc; background-color: #fff; }
        }
    </style>
</head>
<body>