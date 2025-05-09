<?php
require '../config/database.php';
$error = '';
$nombre = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    if ($nombre === '') {
        $error = 'El nombre de la área es obligatorio.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO areas (nombre) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Área</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nueva Área</h1>
  <?php if ($error): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p><?php endif; ?>
  <form method="post">
    <label>Nombre:
      <input type="text" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES) ?>">
    </label>
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>