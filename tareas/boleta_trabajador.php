<?php
// =======================================================
// BOLETA DE PAGO - MINIMARKET MASS
// Autor: Roberto Ricardo Araujo Ari
// =======================================================

// 1. Variables de atos del trabajador
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

