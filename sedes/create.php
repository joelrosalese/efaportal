<?php
require '../config/database.php';
$error = '';
\$sede = '';
\$id_zonal = '';

// Obtener zonales para dropdown
\$zonales = \$pdo->query("SELECT id_zonal, nombre FROM zonales ORDER BY nombre")->fetchAll();

if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
    \$sede = trim(\$_POST['sede'] ?? '');
    \$id_zonal = \$_POST['id_zonal'] ?? '';

    if (\$sede === '') {
        \$error = 'El nombre de la sede es obligatorio.';
    } elseif (!ctype_digit(\$id_zonal)) {
        \$error = 'Debe seleccionar un zonal válido.';
    } else {
        \$stmt = \$pdo->prepare(
            "INSERT INTO sedes (sede, id_zonal) VALUES (:sede, :id_zonal)"
        );
        \$stmt->execute(['sede' => \$sede, 'id_zonal' => \$id_zonal]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Sede</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nueva Sede</h1>
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
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>