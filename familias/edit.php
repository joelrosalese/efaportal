<?php
require '../config/database.php';
$error = '';

// 1) Validar que venga un id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  header('Location: index.php');
  exit;
}

// 2) Obtener datos existentes
$stmt = $pdo->prepare("SELECT * FROM familias WHERE id_familia = ?");
$stmt->execute([$id]);
$familia = $stmt->fetch();
if (!$familia) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  if ($nombre === '') {
    $error = 'El nombre no puede quedar vacío.';
  } else {
    $upd = $pdo->prepare(
      "UPDATE familias SET nombre = :nombre WHERE id_familia = :id"
    );
    $upd->execute([
      'nombre' => $nombre,
      'id'     => $id
    ]);
    header('Location: index.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Familia</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
  <header class="site-header">
    <img src="../pics/logos.png" alt="Logo institucional">
  </header>
  <div class="container">
  <!-- Aquí va el contenido de la página -->
  <h1>Editar Familia Ocupacional - ID <?= $id ?></h1>
  <?php if($error): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Nombre:
      <input type="text" name="nombre"
        value="<?= htmlspecialchars($familia['nombre'], ENT_QUOTES) ?>">
    </label>
    <button type="submit">Actualizar</button>
    <a href="index.php">Cancelar</a>
  </form>
  </div> <!-- .container -->
</body>
</html>
