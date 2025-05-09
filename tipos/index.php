<?php
require '../config/database.php';

// Obtener todos los tipos
$stmt = $pdo->query("SELECT id_tipo, nombre FROM tipos ORDER BY nombre");
$tipos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Tipos</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Tipos</h1>
  <p><a href="create.php">➕ Nuevo Tipo</a></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($tipos as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['id_tipo'], ENT_QUOTES) ?></td>
      <td><?= htmlspecialchars($t['nombre'], ENT_QUOTES) ?></td>
      <td class="table-actions">
        <a href="edit.php?id=<?= urlencode($t['id_tipo']) ?>">✏️ Editar</a>
        <a href="delete.php?id=<?= urlencode($t['id_tipo']) ?>" onclick="return confirm('¿Eliminar este tipo?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>