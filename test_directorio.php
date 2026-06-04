<?php
$ruta = __DIR__ . '/clases';
if (is_dir($ruta)) {
    echo "¡La carpeta 'clases' SÍ existe en: " . $ruta . "!";
    echo "<br>Contenido: " . implode(", ", scandir($ruta));
} else {
    echo "ERROR: La carpeta 'clases' NO existe en " . $ruta;
}
?>