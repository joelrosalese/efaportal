<?php
require '../config/database.php';
$error = '';
$nombre = '';
$id_familia = '';

// Obtener familias para dropdown
$familias = $pdo->query("SELECT id_familia, nombre FROM familias ORDER BY nombre")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $id_familia = $_POST['id_familia'] ?? '';

    if ($nombre === '') {
        $error = 'El nombre de la carrera es obligatorio.';
    } elseif (!ctype_digit($id_familia)) {
        $error = 'Debe seleccionar una familia válida.';
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO carreras (nombre, id_familia) VALUES (:nombre, :id_familia)"
        );
        $stmt->execute(['nombre' => $nombre, 'id_familia' => $id_familia]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Carrera</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logo.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nueva Carrera</h1>
  <?php if ($error): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p><?php endif; ?>
  <form method="post">
    <label>Nombre de la Carrera:
      <input type="text" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES) ?>">
    </label>
    <label>Familia:
      <select name="id_familia">
        <option value="">-- Seleccione --</option>
        <?php foreach ($familias as $f): ?>
          <option value="<?= $f['id_familia'] ?>" <?= ($f['id_familia']==$id_familia?'selected':'') ?>>
            <?= htmlspecialchars($f['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>