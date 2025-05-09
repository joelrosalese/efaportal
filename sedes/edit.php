<?php
require '../config/database.php';
$error = '';

// Validar ID
\$id = \$_GET['id'] ?? '';
if (!ctype_digit(\$id)) {
    header('Location: index.php'); exit;
}

// Obtener datos existentes
\$stmt = \$pdo->prepare("SELECT * FROM sedes WHERE id_sede = ?");
\$stmt->execute([\$id]);
\$sedeData = \$stmt->fetch();
if (!\$sedeData) {
    header('Location: index.php'); exit;
}
\$sede = \$sedeData['sede'];
\$id_zonal = \$sedeData['id_zonal'];

// Zonales para dropdown
\$zonales = \$pdo->query("SELECT id_zonal, nombre FROM zonales ORDER BY nombre")->fetchAll();

if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
    \$sede = trim(\$_POST['sede'] ?? '');
    \$id_zonal = \$_POST['id_zonal'] ?? '';

    if (\$sede === '') {
        \$error = 'El nombre de la sede es obligatorio.';
    } elseif (!ctype_digit(\$id_zonal)) {
        \$error = 'Debe seleccionar un zonal válido.';
    } else {
        \$upd = \$pdo->prepare(
            "UPDATE sedes SET sede = :sede, id_zonal = :id_zonal WHERE id_sede = :id"
        );
        \$upd->execute(['sede'=>\$sede,'id_zonal'=>\$id_zonal,'id'=>\$id]);
        header('Location: index.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Sede</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Editar Sede #<?= htmlspecialchars(\$id, ENT_QUOTES) ?></h1>
  <?php if (\$error): ?><p class="error"><?= htmlspecialchars(\$error, ENT_QUOTES) ?></p><?php endif; ?>
  <form method="post">
    <label>Sede:
      <input type="text" name="sede" value="<?= htmlspecialchars(\$sede, ENT_QUOTES) ?>">
    </label>
    <label>Zonal:
      <select name="id_zonal">
        <option value="">-- Seleccione --</option>
        <?php foreach (\$zonales as \$z): ?>
          <option value="<?= \$z['id_zonal'] ?>" <?= (\$z['id_zonal']==\$id_zonal?'selected':'') ?>>
            <?= htmlspecialchars(\$z['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <button type="submit">Actualizar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>