<?php
require '../config/database.php';
$error = '';

// Validar ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Obtener datos existentes
$stmt = $pdo->prepare("SELECT * FROM modalidades WHERE id_modalidad = ?");
$stmt->execute([$id]);
$modalidadData = $stmt->fetch();
if (!$modalidadData) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modalidad = trim($_POST['modalidad'] ?? '');
    if ($modalidad === '') {
        $error = 'El nombre de la modalidad no puede quedar vacío.';
    } else {
        $upd = $pdo->prepare("UPDATE modalidades SET modalidad = :modalidad WHERE id_modalidad = :id");
        $upd->execute(['modalidad' => $modalidad, 'id' => $id]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Modalidad</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Editar Modalidad con ID <?= $id ?></h1>
  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Modalidad:
      <input type="text" name="modalidad" value="<?= htmlspecialchars($modalidadData['modalidad'], ENT_QUOTES) ?>">
    </label>
    <button type="submit">Actualizar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>
