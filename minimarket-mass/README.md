# Minimarket Mass — Sistema MVC

Sistema de gestión de inventario para el Minimarket Mass, desarrollado en PHP 8 con patrón MVC y conexión a MySQL mediante PDO.

---

## Estructura

```
minimarket-mass/
├── config/
│   └── conexion.php
├── controllers/
│   ├── ProductoController.php
│   └── AuthController.php
├── helpers/
│   └── sesion.php
├── models/
│   ├── Producto.php
│   ├── ProductoRepository.php
│   ├── Usuario.php
│   └── UsuarioRepository.php
├── public/
│   ├── index.php
│   └── assets/fondo.css
├── views/
│   ├── auth/
│   │   ├── login.php
│   │   └── barra_usuario.php
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   └── productos/
│       └── lista.php
├── TAREA 2/
├── TAREA 3/
└── TAREA 4/
```

## Requisitos

- Laragon con MySQL activo
- Base de datos `minimarket_mass` importada en phpMyAdmin
- Puerto configurado en `config/conexion.php`

## Cómo ejecutar

```
http://localhost:8080/minimarket-mass/public/index.php
```

## URLs disponibles

| Ruta | Descripción |
|------|-------------|
| `?accion=login` | Formulario de ingreso |
| `?accion=catalogo` | Catálogo de productos (requiere login) |
| `?accion=logout` | Cerrar sesión |

## Credenciales de prueba

| Usuario | Contraseña | Rol |
|---------|------------|-----|
| `cajero01` | `admin123` | cajero |
| `admin` | `admin123` | admin |

## Sesiones

| Sesión | Contenido |
|--------|-----------|
| 7 | MVC con datos hardcodeados |
| 8 | Conexión a MySQL con PDO |
| 9 | Autenticación con sesiones PHP |
