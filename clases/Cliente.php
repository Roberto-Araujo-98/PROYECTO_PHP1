<?php
declare(strict_types=1);

class Cliente {
    // 1. Atributos (privados para proteger la integridad)
    private string $dni;
    private string $nombre;
    private string $apellido;

    // 2. Constructor: Ejecuta la validación inmediatamente
    public function __construct(string $dni, string $nombre, string $apellido) {
        $this->validarDni($dni);
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // 3. Método de validación interna (Responsabilidad de Cliente)
    private function validarDni(string $dni): void {
        // Regex: /^[0-9]{8}$/ -> exacto 8 dígitos
        if (!preg_match('/^[0-9]{8}$/', $dni)) {
            throw new InvalidArgumentException("Error: El DNI debe tener exactamente 8 dígitos.");
        }
    }

    // 4. Método que pide el integrador
    public function nombreCompleto(): string {
        return $this->nombre . ' ' . $this->apellido;
    }

    // 5. Getters (Si los necesitas para mostrar en el comprobante)
    public function getDni(): string {
        return $this->dni;
    }
}