<?php
require '../config/database.php';

// 1) Obtener todas las familias
$stmt = $pdo->query("SELECT * FROM familias ORDER BY nombre");
$familias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Familias</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
  <header class="site-header">
    <img src="../pics/logos.png" alt="Logo institucional">
  </header>
  <div class="container">
  <!-- Aquí va el contenido de la página -->
  <h1>Familias Ocupacionales</h1>
  <p><a href="create.php">➕ Nueva Familia</a></p>
  <table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach($familias as $f): ?>
    <tr>
      <td><?= $f['id_familia'] ?></td>
      <td><?= htmlspecialchars($f['nombre'], ENT_QUOTES) ?></td>
      <td>
        <a href="edit.php?id=<?= $f['id_familia'] ?>">✏️ Editar</a> |
        <a href="delete.php?id=<?= $f['id_familia'] ?>"
           onclick="return confirm('¿Eliminar esta familia?')">
           🗑️ Eliminar
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div> <!-- .container -->
</body>
</html>
