<?php
declare(strict_types=1);

class DetalleVenta {
    public function __construct(
        private Producto $producto,
        private int $cantidad
    ) {}

    public function getProducto(): Producto { return $this->producto; }
    public function getCantidad(): int { return $this->cantidad; }

    // Calcula cuánto cuesta este detalle sin IGV
    public function getSubtotal(): float {
        return $this->producto->getPrecio() * $this->cantidad;
    }

    // Calcula cuánto es el impuesto de esta línea
    public function getIgvCalculado(): float {
        return $this->getSubtotal() * $this->producto->calcularTasaIGV();
    }
}