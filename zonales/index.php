<?php
require '../config/database.php';

// Obtener todas las zonas
$stmt = $pdo->query("SELECT * FROM zonales ORDER BY nombre");
$zonales = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Zonales</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Zonales</h1>
  <p><a href="create.php">➕ Nueva Zonal</a></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($zonales as $z): ?>
    <tr>
      <td><?= htmlspecialchars($z['id_zonal'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($z['nombre'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($z['id_zonal']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($z['id_zonal']) ?>" onclick="return confirm('¿Eliminar esta zonal?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
