<?php
require '../config/database.php';

// Búsqueda de facilitadores
$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $like = "%{$q}%";
    $stmt = $pdo->prepare(
        "SELECT * FROM facilitadores
         WHERE id_facilitador = :q
           OR apellidos LIKE :like
           OR nombres LIKE :like
         ORDER BY apellidos, nombres"
    );
    $stmt->execute(['q' => $q, 'like' => $like]);
} else {
    $stmt = $pdo->query("SELECT * FROM facilitadores ORDER BY apellidos, nombres");
}
$facilitadores = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Facilitadores</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Facilitadores</h1>
  <form method="get" action="index.php" style="margin-bottom: 15px;">
    <input type="text" name="q" placeholder="Buscar por ID, apellidos o nombres"
           value="<?= htmlspecialchars($q, ENT_QUOTES) ?>"
           style="padding: 6px; width: 60%;">
    <button type="submit">🔍</button>
    <?php if ($q !== ''): ?>
      <a href="index.php" style="margin-left:10px;">Limpiar</a>
    <?php endif; ?>
  </form>
  <p><a href="create.php">➕ Nuevo Facilitador</a></p>
  <table>
    <tr>
      <th>ID</th><th>Apellidos</th><th>Nombres</th><th>Móvil</th><th>Correo</th><th>Acciones</th>
    </tr>
    <?php foreach ($facilitadores as $f): ?>
    <tr>
      <td><?= str_pad(htmlspecialchars($f['id_facilitador'], ENT_QUOTES), 9, '0', STR_PAD_LEFT) ?></td>
      <td><?= htmlspecialchars($f['apellidos'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($f['nombres'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($f['movil'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($f['correo'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($f['id_facilitador']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($f['id_facilitador']) ?>" onclick="return confirm('¿Eliminar este facilitador?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>