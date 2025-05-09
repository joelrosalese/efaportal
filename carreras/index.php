<?php
require '../config/database.php';

// Parámetros de filtro y búsqueda
$filter_familia = $_GET['filter_familia'] ?? '';
$search         = trim($_GET['search'] ?? '');

// Listado para dropdown de familias
$allFamilias = $pdo->query("SELECT id_familia, nombre FROM familias ORDER BY nombre")->fetchAll();

// Construcción de la consulta según filtros
if ($filter_familia !== '' && ctype_digit($filter_familia)) {
    $stmt = $pdo->prepare(
        "SELECT c.id_carrera, c.nombre AS carrera, f.nombre AS familia
         FROM carreras c
         JOIN familias f ON c.id_familia = f.id_familia
         WHERE c.id_familia = ?
         ORDER BY c.nombre"
    );
    $stmt->execute([$filter_familia]);
} elseif ($search !== '') {
    $stmt = $pdo->prepare(
        "SELECT c.id_carrera, c.nombre AS carrera, f.nombre AS familia
         FROM carreras c
         JOIN familias f ON c.id_familia = f.id_familia
         WHERE c.nombre LIKE ?
         ORDER BY c.nombre"
    );
    $stmt->execute(["{$search}%"]);
} else {
    $stmt = $pdo->query(
        "SELECT c.id_carrera, c.nombre AS carrera, f.nombre AS familia
         FROM carreras c
         JOIN familias f ON c.id_familia = f.id_familia
         ORDER BY c.nombre"
    );
}
$carreras = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Carreras</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Carreras</h1>

  <!-- Filtros -->
  <form method="get" action="index.php" class="filter-form" style="margin-bottom:20px; display:flex; gap:10px; align-items:center;">
    <label>
      Filtrar por Familia:
      <select name="filter_familia" onchange="this.form.submit()">
        <option value="">-- Todas --</option>
        <?php foreach ($allFamilias as $opt): ?>
          <option value="<?= $opt['id_familia'] ?>" <?= ($opt['id_familia']==$filter_familia ? 'selected' : '') ?>>
            <?= htmlspecialchars($opt['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      Buscar por Nombre de Carrera:
      <input type="text" name="search" placeholder="Ej: A" value="<?= htmlspecialchars($search, ENT_QUOTES) ?>" onkeyup="this.form.submit()">
    </label>
    <?php if ($filter_familia !== '' || $search !== ''): ?>
      <button type="button" class="cancel-link" onclick="window.location='index.php'">Limpiar filtros</button>
    <?php endif; ?>
  </form>

  <p><a href="create.php">➕ Nueva Carrera</a></p>
  <table>
    <tr>
      <th>ID</th><th>Carrera</th><th>Familia</th><th>Acciones</th>
    </tr>
    <?php foreach ($carreras as $c): ?>
    <tr>
      <td><?= htmlspecialchars($c['id_carrera'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($c['carrera'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($c['familia'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($c['id_carrera']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($c['id_carrera']) ?>" onclick="return confirm('¿Eliminar esta carrera?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>