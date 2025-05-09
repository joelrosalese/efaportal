<?php
require '../config/database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modalidad = trim($_POST['modalidad'] ?? '');
    if ($modalidad === '') {
        $error = 'El nombre de la modalidad no puede quedar vacío.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO modalidades (modalidad) VALUES (:modalidad)");
        $stmt->execute(['modalidad' => $modalidad]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Modalidad</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nueva Modalidad</h1>
  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Modalidad:
      <input type="text" name="modalidad" value="<?= htmlspecialchars($modalidad ?? '', ENT_QUOTES) ?>">
    </label>
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>