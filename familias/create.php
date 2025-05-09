<?php
require '../config/database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  if ($nombre === '') {
    $error = 'El nombre no puede quedar vacío.';
  } else {
    $stmt = $pdo->prepare("INSERT INTO familias (nombre) VALUES (:nombre)");
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
  <title>Crear Familia</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
  <header class="site-header">
    <img src="../pics/logo.png" alt="Logo institucional">
  </header>
  <div class="container">
  <!-- Aquí va el contenido de la página -->
  <h1>Crear Nueva Familia</h1>
  <?php if($error): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>"></label>
    <button type="submit">Guardar</button>
    <a href="index.php">Cancelar</a>
  </form>
</div> <!-- .container -->
</body>
</html>
