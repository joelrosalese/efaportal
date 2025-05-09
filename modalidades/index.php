<?php
require '../config/database.php';

// Obtener todas las modalidades
$stmt = $pdo->query("SELECT * FROM modalidades ORDER BY modalidad");
$modalidades = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Modalidades</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Modalidades</h1>
  <p><a href="create.php">➕ Nueva Modalidad</a></p>
  <table>
    <tr><th>ID</th><th>Modalidad</th><th>Acciones</th></tr>
    <?php foreach($modalidades as $m): ?>
    <tr>
      <td><?= $m['id_modalidad'] ?></td>
      <td><?= htmlspecialchars($m['modalidad'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= $m['id_modalidad'] ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= $m['id_modalidad'] ?>" onclick="return confirm('¿Eliminar esta modalidad?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>