<?php
require '../config/database.php';

// Parámetro de filtro por zonal
$filter_zonal = $_GET['filter_zonal'] ?? '';

// Listado para dropdown de zonales
$allZonales = $pdo->query("SELECT id_zonal, nombre FROM zonales ORDER BY nombre")->fetchAll();

// Construcción de la consulta según filtro de zonal
if ($filter_zonal !== '' && ctype_digit($filter_zonal)) {
    $stmt = $pdo->prepare(
        "SELECT s.id_sede, s.sede, z.nombre AS zonal
         FROM sedes s
         JOIN zonales z ON s.id_zonal = z.id_zonal
         WHERE s.id_zonal = ?
         ORDER BY s.sede"
    );
    $stmt->execute([$filter_zonal]);
} else {
    $stmt = $pdo->query(
        "SELECT s.id_sede, s.sede, z.nombre AS zonal
         FROM sedes s
         JOIN zonales z ON s.id_zonal = z.id_zonal
         ORDER BY s.sede"
    );
}
$sedes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Sedes</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Sedes</h1>

  <!-- Filtro -->
  <form method="get" action="index.php" style="margin-bottom:20px; display:flex; gap:10px; align-items:center;">
    <label>
      Filtrar por Zonal:
      <select name="filter_zonal" onchange="this.form.submit()">
        <option value="">-- Todas --</option>
        <?php foreach ($allZonales as $opt): ?>
          <option value="<?= htmlspecialchars($opt['id_zonal'], ENT_QUOTES) ?>" <?= $opt['id_zonal'] == $filter_zonal ? 'selected' : '' ?>>
            <?= htmlspecialchars($opt['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <?php if ($filter_zonal !== ''): ?>
      <button type="button" class="cancel-link" onclick="window.location='index.php'">Limpiar filtro</button>
    <?php endif; ?>
  </form>

  <p><a href="create.php">➕ Nueva Sede</a></p>
  <table>
    <tr><th>ID</th><th>Sede</th><th>Zonal</th><th>Acciones</th></tr>
    <?php foreach ($sedes as $s): ?>
    <tr>
      <td><?= htmlspecialchars($s['id_sede'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($s['sede'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($s['zonal'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($s['id_sede']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($s['id_sede']) ?>" onclick="return confirm('¿Eliminar esta sede?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>