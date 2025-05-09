<?php
require '../config/database.php';

// Filtros opcionales
$search          = $_GET['search'] ?? '';
$filter_carrera  = $_GET['filter_carrera'] ?? '';
$filter_zonal    = $_GET['filter_zonal'] ?? '';
$filter_sede     = $_GET['filter_sede'] ?? '';

// Datos para dropdowns
$allCarreras = $pdo->query("SELECT id_carrera, nombre FROM carreras ORDER BY nombre")->fetchAll();
$allZonales  = $pdo->query("SELECT id_zonal, nombre FROM zonales ORDER BY nombre")->fetchAll();
$allSedes    = $pdo->query("SELECT id_sede, sede, id_zonal FROM sedes ORDER BY sede")->fetchAll();

// Construcción de la consulta
$sql = "SELECT p.id_participante, p.apellidos, p.nombres, p.movil, p.correo_ins, p.correo_per,
            p.jornada, c.nombre AS carrera, z.nombre AS zonal, s.sede AS sede, p.observacion
        FROM participantes p
        JOIN carreras c ON p.id_carrera = c.id_carrera
        JOIN zonales z ON p.id_zonal = z.id_zonal
        JOIN sedes s   ON p.id_sede   = s.id_sede
        WHERE 1=1";
$params = [];

// Filtro por apellidos
if ($search !== '') {
    $sql .= " AND p.apellidos LIKE ?";
    $params[] = "%{$search}%";
}
// Filtro por carrera
if (ctype_digit($filter_carrera)) {
    $sql .= " AND p.id_carrera = ?";
    $params[] = $filter_carrera;
}
// Filtro por zonal
if (ctype_digit($filter_zonal)) {
    $sql .= " AND p.id_zonal = ?";
    $params[] = $filter_zonal;
}
// Filtro por sede
if (ctype_digit($filter_sede)) {
    $sql .= " AND p.id_sede = ?";
    $params[] = $filter_sede;
}

$sql .= " ORDER BY p.apellidos, p.nombres";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$participantes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Participantes</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Participantes</h1>
  <p><a href="create.php">➕ Nuevo Participante</a></p>

  <!-- Filtros -->
  <form method="get" class="filter-form" style="display:flex; gap:10px; margin-bottom:20px;">
    <input type="text" name="search" placeholder="Buscar Apellidos..." value="<?= htmlspecialchars($search, ENT_QUOTES) ?>" onkeyup="this.form.submit()">
    <select name="filter_carrera" onchange="this.form.submit()">
      <option value="">-- Todas Carreras --</option>
      <?php foreach ($allCarreras as $c): ?>
        <option value="<?= $c['id_carrera'] ?>" <?= $c['id_carrera'] == $filter_carrera ? 'selected' : '' ?>>
          <?= htmlspecialchars($c['nombre'], ENT_QUOTES) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <select name="filter_zonal" onchange="this.form.submit()">
      <option value="">-- Todas Zonales --</option>
      <?php foreach ($allZonales as $z): ?>
        <option value="<?= $z['id_zonal'] ?>" <?= $z['id_zonal'] == $filter_zonal ? 'selected' : '' ?>>
          <?= htmlspecialchars($z['nombre'], ENT_QUOTES) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <select name="filter_sede" onchange="this.form.submit()">
      <option value="">-- Todas Sedes --</option>
      <?php foreach ($allSedes as $s): ?>
        <?php if ($filter_zonal === '' || $s['id_zonal'] == $filter_zonal): ?>
          <option value="<?= $s['id_sede'] ?>" <?= $s['id_sede'] == $filter_sede ? 'selected' : '' ?>>
            <?= htmlspecialchars($s['sede'], ENT_QUOTES) ?>
          </option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
    <?php if ($search !== '' || $filter_carrera || $filter_zonal || $filter_sede): ?>
      <button type="button" class="cancel-link" onclick="window.location='index.php'">Limpiar</button>
    <?php endif; ?>
  </form>

  <div style="display:flex; justify-content:center;">
    <table style="width:auto;">
      <tr><th>ID</th><th>Apellidos</th><th>Nombres</th><th>Movil</th><th>Correo Ins.</th><th>Correo Pers.</th><th>Jornada</th><th>Carrera</th><th>Zonal</th><th>Sede</th><th>Observación</th><th>Acciones</th></tr>
      <?php foreach ($participantes as $p): ?>
      <tr>
        <td><?= str_pad(htmlspecialchars($p['id_participante'], ENT_QUOTES),9,'0',STR_PAD_LEFT) ?></td>
        <td><?= htmlspecialchars($p['apellidos'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['nombres'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['movil'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['correo_ins'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['correo_per'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['jornada'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['carrera'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['zonal'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['sede'], ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars($p['observacion'], ENT_QUOTES) ?></td>
        <td class="table-actions">
          <a href="edit.php?id=<?= urlencode($p['id_participante']) ?>">✏️ Editar</a>
          <a href="delete.php?id=<?= urlencode($p['id_participante']) ?>" onclick="return confirm('¿Eliminar este participante?')">🗑️ Eliminar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
</body>
</html>
