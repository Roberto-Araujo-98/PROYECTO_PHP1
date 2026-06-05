<?php /* Recibe $error desde AuthController */ 
/* Recibe $error desde AuthController */ 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$intentos = $_SESSION['intentos_login'] ?? 0;

// Calcular cuántos segundos reales quedan de bloqueo
$segundos_restantes = 0;
$bloqueado = false;

if (isset($_SESSION['bloqueado_hasta'])) {
    $ahora = time();
    if ($ahora < $_SESSION['bloqueado_hasta']) {
        $bloqueado = true;
        $segundos_restantes = $_SESSION['bloqueado_hasta'] - $ahora; // Segundos que faltan
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ingreso · Minimarket Mass</title>
<style>
  *{box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif;margin:0;padding:0}
  body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0066B3,#004F8C)}
  .login{background:#fff;width:340px;border-radius:14px;padding:32px 28px;box-shadow:0 18px 45px rgba(0,0,0,.25)}
  .logo{display:block;text-align:center;background:#0066B3;color:#fff;font-weight:800;font-size:20px;letter-spacing:1px;padding:8px 0;border-radius:8px;margin-bottom:18px}
  label{display:block;font-size:13px;font-weight:600;margin:14px 0 5px}
  input{width:100%;padding:11px 13px;border:1px solid #d7dde6;border-radius:8px;font-size:14px}
  button{width:100%;margin-top:20px;padding:12px;border:none;border-radius:8px;background:#0066B3;color:#fff;font-size:15px;font-weight:700;cursor:pointer}
  .error{background:#fef2f2;border:1px solid #f3c2c2;color:#b91c1c;font-size:13px;padding:10px 12px;border-radius:8px;margin-bottom:8px}
  .hint{margin-top:16px;text-align:center;font-size:12px;color:#94a1b2}
</style>
</head>
<body><div class="login">
    <span class="logo">MASS</span>
    
    <div id="mensaje-error">
      <?php if ($bloqueado): ?>
        <div class="error" style="font-weight: bold; text-align: center;">
           ❌ Demasiados intentos. <br>
           Bloqueado por: <span id="contador-tiempo">--:--</span>
        </div>
      <?php elseif (!empty($error)): ?>
        <div class="error">
          <?= htmlspecialchars($error) ?> <br>
          <small>Intentos: <?= $intentos ?> de 3</small>
        </div>
      <?php endif; ?>
    </div>

    <form method="POST" action="index.php?accion=procesar-login" id="form-login">
      <label>Usuario</label>
      <input type="text" name="username" id="input-username" autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" <?= $bloqueado ? 'disabled' : '' ?>>
      
      <label>Contraseña</label>
      <input type="password" name="password" id="input-password" <?= $bloqueado ? 'disabled' : '' ?>>
      
      <button type="submit" id="btn-submit" <?= $bloqueado ? 'disabled' : '' ?>>Ingresar</button>
    </form>
    
    <p class="hint">Demo: cajero01 / admin</p>
  </div>

  <script>
    // Pasamos los segundos que calculó PHP directamente a JavaScript
    let segundosRestantes = <?= $segundos_restantes ?>;

    if (segundosRestantes > 0) {
        const contadorTxt = document.getElementById('contador-tiempo');
        const formLogin = document.getElementById('form-login');
        const inputs = formLogin.querySelectorAll('input, button');

        // Función que formatea los segundos a formato MM:SS
        function actualizarReloj() {
            if (segundosRestantes <= 0) {
                clearInterval(cronometro);
                // Cuando llega a 0, recargamos la página para que PHP limpie todo y habilite el login
                window.location.reload();
                return;
            }

            let minutos = Math.floor(segundosRestantes / 60);
            let segundos = segundosRestantes % 60;

            // Añadir un cero a la izquierda si son menores de 10 (ej: 05 en vez de 5)
            minutos = minutos < 10 ? '0' + minutos : minutos;
            segundos = segundos < 10 ? '0' + segundos : segundos;

            contadorTxt.textContent = `${minutos}:${segundos}`;
            segundosRestantes--;
        }

        // Ejecutar la función inmediatamente y luego cada 1 segundo (1000ms)
        actualizarReloj();
        const cronometro = setInterval(actualizarReloj, 1000);
    }
  </script>
</body>
</html>