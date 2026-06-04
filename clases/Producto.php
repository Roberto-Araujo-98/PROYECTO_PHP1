<?php
declare(strict_types=1);

class Producto {
    private string $codigo;
    private string $nombre; // Le agregué string para ser exactos
    private float $precio;  // Corregido el espacio de 'private'
    private int $stock;
    private string $marca;
    private bool $disponible;
    private float $descuento; 
    private string $categoria;

    public function __construct(
        string $codigo,
        string $nombre,
        float $precio,
        int $stock,
        string $marca,
        bool $disponible,
        float $descuento,
        string $categoria
    ) {
        // ASIGNACIÓN CORRECTA: A la propiedad, no al método
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock  = $stock;
        $this->marca = $marca;
        $this->disponible = $disponible;
        $this->descuento = $descuento;
        $this->categoria = $categoria;
    }

    // MÉTODOS GETTERS (Para que el otro archivo pueda leer los datos)
    public function getCodigo(): string {
        return $this->codigo;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function getMarca(): string {
        return $this->marca;
    }

    public function getDisponible(): bool {
        return $this->disponible;
    }

    public function getDescuento(): float {
        return $this->descuento;
    }

    public function getCategoria(): string {
        return $this->categoria;
    }
    // Agrégalo junto a tus otros getters
    public function calcularTasaIGV(): float {
    // Si la categoría es inafecta, el IGV es 0, si no, es 0.18
    $inafectas = ['panadería', 'frutas y verduras'];
    if (in_array(strtolower($this->categoria), $inafectas)) {
        return 0.00;
    }
    return 0.18;
}
}
?>