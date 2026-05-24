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