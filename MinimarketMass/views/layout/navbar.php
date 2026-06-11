<?php $u = usuarioActual(); ?>
<nav style="background:#0066B3; color:#fff; padding:15px; display:flex; justify-content:space-between; align-items:center;">
    <div style="font-weight:bold; font-size:1.2rem;">🛒 MASS · Sistema de Caja</div>
    <div>
        👤 <?= htmlspecialchars($u['nombre']) ?> · <?= htmlspecialchars(ucfirst($u['rol'])) ?>
        <a href="index.php?accion=logout" style="color:#FFB81C; margin-left:15px; text-decoration:none;">Salir</a>
    </div>
</nav>