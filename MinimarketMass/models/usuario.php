<?php
declare(strict_types=1);

class Usuario {
    // 1. AGREGA LA PROPIEDAD AQUÍ
    private int $contador_accesos;

    public function __construct(
        private int    $id,
        private string $username,
        private string $nombres,
        private string $apellidos,
        private string $rol,
        private string $tienda,
        private string $passwordHash,
        int $contador_accesos // 2. AGREGA ESTE PARÁMETRO
    ) {
        // 3. ASIGNA EL VALOR
        $this->contador_accesos = $contador_accesos;
    }

    public function getId(): int              { return $this->id; }
    public function getUsername(): string    { return $this->username; }
    public function getNombres(): string     { return $this->nombres; }
    public function getApellidos(): string   { return $this->apellidos; }
    public function getNombreCompleto(): string { return $this->nombres . ' ' . $this->apellidos; }
    public function getRol(): string         { return $this->rol; }
    public function getTienda(): string      { return $this->tienda; }
    
    // 4. EL GETTER QUEDARÍA ASÍ
    public function getContador(): int {
        return $this->contador_accesos;
    }

    public function verificarPassword(string $password): bool {
        return password_verify($password, $this->passwordHash);
    }
}