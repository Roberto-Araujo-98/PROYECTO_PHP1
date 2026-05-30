<?php
/*
 * ============================================================
 *  EJERCICIO 2 · PAREJA — Saludo según hora del día
 *  Alumno  : ANTHONY DORLY HUILAHUAÑA CHATA
 *  Archivo : saludo_mass.php
 * ============================================================
 */

// ── Obtener la hora actual (0 - 23) ─────────────────────────
$hora = (int) date("H");

// ── Determinar el turno con if ───────────────────────────────
if ($hora >= 5 && $hora <= 11) {
    $turno = "mañana";
} elseif ($hora >= 12 && $hora <= 18) {
    $turno = "tarde";
} elseif ($hora >= 19 && $hora <= 23) {
    $turno = "noche";
} else {
    $turno = "cerrado";
}

// ── Mostrar saludo con switch ────────────────────────────────
switch ($turno) {
    case "mañana":
        echo "Buenos días, bienvenido a Mass";
        break;
    case "tarde":
        echo "Buenas tardes, bienvenido a Mass";
        break;
    case "noche":
        echo "Buenas noches, bienvenido a Mass";
        break;
    case "cerrado":
        echo "Tienda cerrada en este horario";
        break;
}

echo " <br> \n(  Hora actual del servidor: " . $hora . ":00)";

/*
 * ── NOTAS ───────────────────────────────────────────────────
 *
 *  date("H")  → devuelve la hora en formato 24h como string
 *  (int)      → lo convertimos a entero para comparar rangos
 *
 *  Flujo:
 *  1. Obtenemos la hora actual
 *  2. Un if determina el TURNO (mañana/tarde/noche/cerrado)
 *  3. El switch usa el TURNO para mostrar el saludo correcto
 *
 *  Rangos:
 *   0  -  4  → cerrado
 *   5  - 11  → mañana
 *  12  - 18  → tarde
 *  19  - 23  → noche
 * ============================================================
 */
?>