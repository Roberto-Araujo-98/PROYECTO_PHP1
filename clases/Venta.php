<?php
declare(strict_types=1);

class Venta {
    private Cliente $cliente;
    private string $metodoPago;
    private array $detalles = [];

    public function __construct(Cliente $cliente, string $metodoPago) {
        $this->cliente = $cliente;
        $this->metodoPago = $metodoPago;
    }

    public function agregarDetalle(DetalleVenta $detalle): void {
        $this->detalles[] = $detalle;
    }

    public function getDetalles(): array {
        return $this->detalles;
    }

    // --- CÁLCULOS PRINCIPALES ---

    public function calcularSubtotal(): float {
        $suma = 0.0;
        foreach ($this->detalles as $detalle) {
            $suma += $detalle->getSubtotal();
        }
        return $suma;
    }

    public function calcularIgvTotal(): float {
        $suma = 0.0;
        foreach ($this->detalles as $detalle) {
            $suma += $detalle->getIgvCalculado();
        }
        return $suma;
    }

    // Lógica completa: Suma base + IGV, y resta el descuento según el monto
    public function calcularTotal(): float {
        $subtotal = $this->calcularSubtotal();
        $igv = $this->calcularIgvTotal();
        $montoBase = $subtotal + $igv;
        
        $descuento = 0.0;
        if ($montoBase > 100) {
            $descuento = $montoBase * 0.05; // 5% de descuento si pasa de 100
        }
        
        return $montoBase - $descuento;
    }

    // --- AUXILIARES ---

    public function obtenerSaludo(): string {
        $hora = (int)date('H');
        if ($hora < 12) return "Buenos días";
        if ($hora < 18) return "Buenas tardes";
        return "Buenas noches";
    }
}