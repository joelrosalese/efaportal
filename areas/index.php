<?php
require '../config/database.php';

// Obtener todas las áreas
$stmt = $pdo->query("SELECT id_area, nombre FROM areas ORDER BY nombre");
$areas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Áreas</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Áreas</h1>
  <p><a href="create.php">➕ Nueva Área</a></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach($areas as $a): ?>
    <tr>
      <td><?= htmlspecialchars($a['id_area'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($a['nombre'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($a['id_area']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($a['id_area']) ?>" onclick="return confirm('¿Eliminar esta área?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
