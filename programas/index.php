<?php
require '../config/database.php';

// Obtener todos los programas
$stmt = $pdo->query("SELECT id_programa, nombre FROM programas ORDER BY nombre");
$programas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Programas</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Programas</h1>
  <p><a href="create.php">➕ Nuevo Programa</a></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($programas as $p): ?>
    <tr>
      <td><?= htmlspecialchars($p['id_programa'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($p['id_programa']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($p['id_programa']) ?>" onclick="return confirm('¿Eliminar este programa?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>