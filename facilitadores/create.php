<?php
require '../config/database.php';
$error = '';
$id_facilitador = '';
$apellidos = '';
$nombres = '';
$movil = '';
$correo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_facilitador = trim($_POST['id_facilitador'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $nombres = trim($_POST['nombres'] ?? '');
    $movil = trim($_POST['movil'] ?? '');
    $correo = trim($_POST['correo'] ?? '');

    if ($id_facilitador === '' || !ctype_digit($id_facilitador)) {
        $error = 'El código de facilitador es obligatorio y debe ser numérico.';
    } elseif ($apellidos === '' || $nombres === '') {
        $error = 'Apellidos y nombres son obligatorios.';
    } else {
        // Validar unicidad del ID
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM facilitadores WHERE id_facilitador = ?');
        $stmt->execute([$id_facilitador]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'EL IDENTIFICADOR DEL FACILITADOR YA ESTÁ REGISTRADO';
        } else {
            $insert = $pdo->prepare(
                'INSERT INTO facilitadores (id_facilitador, apellidos, nombres, movil, correo)
                 VALUES (:id_facilitador, :apellidos, :nombres, :movil, :correo)'
            );
            $insert->execute([
                'id_facilitador' => $id_facilitador,
                'apellidos' => $apellidos,
                'nombres' => $nombres,
                'movil' => $movil,
                'correo' => $correo,
            ]);
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Facilitador</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nuevo Facilitador</h1>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Código del Facilitador:
      <input type="text" name="id_facilitador" value="<?= htmlspecialchars($id_facilitador, ENT_QUOTES) ?>">
    </label>
    <label>Apellidos:
      <input type="text" name="apellidos" value="<?= htmlspecialchars($apellidos, ENT_QUOTES) ?>">
    </label>
    <label>Nombres:
      <input type="text" name="nombres" value="<?= htmlspecialchars($nombres, ENT_QUOTES) ?>">
    </label>
    <label>Móvil:
      <input type="text" name="movil" value="<?= htmlspecialchars($movil, ENT_QUOTES) ?>">
    </label>
    <label>Correo:
      <input type="text" name="correo" value="<?= htmlspecialchars($correo, ENT_QUOTES) ?>">
    </label>
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
</body>
</html>