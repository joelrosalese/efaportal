<?php
require '../config/database.php';
$error = '';

// Validar ID
$id = $_GET['id'] ?? '';
if (!ctype_digit($id)) {
    header('Location: index.php'); exit;
}

// Obtener datos existentes
$stmt = $pdo->prepare("SELECT * FROM zonales WHERE id_zonal = ?");
$stmt->execute([$id]);
$zonal = $stmt->fetch();
if (!$zonal) {
    header('Location: index.php'); exit;
}
$nombre = $zonal['nombre'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    if ($nombre === '') {
        $error = 'El nombre de la zonal es obligatorio.';
    } else {
        $upd = $pdo->prepare("UPDATE zonales SET nombre = :nombre WHERE id_zonal = :id");
        $upd->execute(['nombre' => $nombre, 'id' => $id]);
        header('Location: index.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Zonal</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Editar Zonal ID:<?= htmlspecialchars($id, ENT_QUOTES) ?></h1>
  <?php if ($error): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p><?php endif; ?>
  <form method="post">
    <label>Nombre:
      <input type="text" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES) ?>">
    </label>
    <button type="submit">Actualizar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>
