<?php
require '../config/database.php';
$error = '';
// Inicializar variables de formulario
$id_participante = '';
$apellidos       = '';
$nombres         = '';
$movil           = '';
$correo_ins      = '';
$correo_per      = '';
$jornada         = '';
$id_familia      = '';
$id_carrera      = '';
$id_zonal        = '';
$id_sede         = '';
$observacion     = '';

// Cargar datos para selects
$familias     = $pdo->query("SELECT id_familia, nombre FROM familias ORDER BY nombre")->fetchAll();
$carreras_all = $pdo->query("SELECT id_carrera, nombre, id_familia FROM carreras")->fetchAll();
$zonales      = $pdo->query("SELECT id_zonal, nombre FROM zonales ORDER BY nombre")->fetchAll();
$sedes_all    = $pdo->query("SELECT id_sede, sede, id_zonal FROM sedes ORDER BY sede")->fetchAll();

if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger valores
    $id_participante = trim($_POST['id_participante'] ?? '');
    $apellidos       = trim($_POST['apellidos'] ?? '');
    $nombres         = trim($_POST['nombres'] ?? '');
    $movil           = trim($_POST['movil'] ?? '');
    $correo_ins      = trim($_POST['correo_ins'] ?? '');
    $correo_per      = trim($_POST['correo_per'] ?? '');
    $jornada         = trim($_POST['jornada'] ?? '');
    $id_familia      = $_POST['id_familia'] ?? '';
    $id_carrera      = $_POST['id_carrera'] ?? '';
    $id_zonal        = $_POST['id_zonal'] ?? '';
    $id_sede         = $_POST['id_sede'] ?? '';
    $observacion     = trim($_POST['observacion'] ?? '');

    // Validaciones básicas
    if (!ctype_digit($id_participante)) {
        $error = 'El ID debe ser numérico y único.';
    } elseif (empty($apellidos) || empty($nombres)) {
        $error = 'Apellidos y Nombres son obligatorios.';
    } elseif (!filter_var($correo_ins, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo Institucional inválido.';
    } elseif (!filter_var($correo_per, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo Personal inválido.';
    } elseif (!ctype_digit($id_familia) || !ctype_digit($id_carrera)) {
        $error = 'Debe seleccionar Familia y Carrera válidas.';
    } elseif (!ctype_digit($id_zonal) || !ctype_digit($id_sede)) {
        $error = 'Debe seleccionar Zonal y Sede válidas.';
    } else {
        // Verificar unicidad
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM participantes WHERE id_participante = ?');
        $stmt->execute([$id_participante]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'El ID de participante ya está registrado.';
        } else {
            // Insertar
            $ins = $pdo->prepare(
                "INSERT INTO participantes
                 (id_participante, apellidos, nombres, movil, correo_ins, correo_per,
                  jornada, id_carrera, id_zonal, id_sede, observacion)
                 VALUES
                 (:id, :apellidos, :nombres, :movil, :ci, :cp, :jornada,
                  :carrera, :zonal, :sede, :obs)"
            );
            $ins->execute([
                'id'       => $id_participante,
                'apellidos'=> $apellidos,
                'nombres'  => $nombres,
                'movil'    => $movil,
                'ci'       => $correo_ins,
                'cp'       => $correo_per,
                'jornada'  => $jornada,
                'carrera'  => $id_carrera,
                'zonal'    => $id_zonal,
                'sede'     => $id_sede,
                'obs'      => $observacion,
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
  <title>Crear Participante</title>
  <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<header class="site-header">
  <img src="../pics/logos.png" alt="Logo institucional">
</header>
<div class="container">
  <h1>Crear Nuevo Participante</h1>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></p>
  <?php endif; ?>
  <form method="post" id="form">
    <label>ID Participante:
      <input type="text" name="id_participante" value="<?= htmlspecialchars($id_participante, ENT_QUOTES) ?>">
    </label>
    <label>Apellidos:
      <input type="text" name="apellidos" value="<?= htmlspecialchars($apellidos, ENT_QUOTES) ?>">
    </label>
    <label>Nombres:
      <input type="text" name="nombres" value="<?= htmlspecialchars($nombres, ENT_QUOTES) ?>">
    </label>
    <label>Teléfono Móvil:
      <input type="text" name="movil" value="<?= htmlspecialchars($movil, ENT_QUOTES) ?>">
    </label>
    <label>Correo Institucional:
      <input type="text" name="correo_ins" value="<?= htmlspecialchars($correo_ins, ENT_QUOTES) ?>">
    </label>
    <label>Correo Personal:
      <input type="text" name="correo_per" value="<?= htmlspecialchars($correo_per, ENT_QUOTES) ?>">
    </label>
    <label>Jornada:
      <input type="text" name="jornada" value="<?= htmlspecialchars($jornada, ENT_QUOTES) ?>">
    </label>
    <label>Familia:
      <select name="id_familia" id="id_familia">
        <option value="">-- Seleccione Familia --</option>
        <?php foreach ($familias as $f): ?>
          <option value="<?= $f['id_familia'] ?>" <?= $f['id_familia'] == $id_familia ? 'selected' : '' ?>>
            <?= htmlspecialchars($f['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Carrera:
      <select name="id_carrera" id="id_carrera">
        <option value="">-- Seleccione Carrera --</option>
      </select>
    </label>
    <label>Zonal:
      <select name="id_zonal" id="id_zonal">
        <option value="">-- Seleccione Zonal --</option>
        <?php foreach ($zonales as $z): ?>
          <option value="<?= $z['id_zonal'] ?>" <?= $z['id_zonal'] == $id_zonal ? 'selected' : '' ?>>
            <?= htmlspecialchars($z['nombre'], ENT_QUOTES) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Sede:
      <select name="id_sede" id="id_sede">
        <option value="">-- Seleccione Sede --</option>
      </select>
    </label>
    <label>Observación:
      <textarea name="observacion" style="width:85%; height:50px;"><?= htmlspecialchars($observacion, ENT_QUOTES) ?></textarea>
    </label>
    <button type="submit">Guardar</button>
    <a href="index.php" class="cancel-link">Cancelar</a>
  </form>
</div>
<script>
  const carreras = <?= json_encode($carreras_all) ?>;
  const sedes    = <?= json_encode($sedes_all) ?>;
  function updateCarreras() {
    const fam = document.getElementById('id_familia').value;
    const cur = document.getElementById('id_carrera');
    cur.innerHTML = '<option value="">-- Seleccione Carrera --</option>';
    carreras.forEach(c => {
      if (c.id_familia == fam) {
        const opt = document.createElement('option');
        opt.value = c.id_carrera;
        opt.text  = c.nombre;
        cur.appendChild(opt);
      }
    });
  }
  function updateSedes() {
    const zon = document.getElementById('id_zonal').value;
    const sel = document.getElementById('id_sede');
    sel.innerHTML = '<option value="">-- Seleccione Sede --</option>';
    sedes.forEach(s => {
      if (s.id_zonal == zon) {
        const opt = document.createElement('option');
        opt.value = s.id_sede;
        opt.text  = s.sede;
        sel.appendChild(opt);
      }
    });
  }
  document.getElementById('id_familia').addEventListener('change', updateCarreras);
  document.getElementById('id_zonal').addEventListener('change', updateSedes);
  window.addEventListener('load', () => { updateCarreras(); updateSedes(); });
</script>
<?php
require '../config/database.php';
$error='';
// Inicializar campos
$id_participante=$apellidos=$nombres=$movil=$correo_ins='';
$correo_per=$jornada=$id_familia=$id_carrera=$id_zonal=$id_sede=$observacion='';
// Dropdown datos
$familias=$pdo->query("SELECT id_familia,nombre FROM familias ORDER BY nombre")->fetchAll();
$carreras_all=$pdo->query("SELECT id_carrera,nombre,id_familia FROM carreras")->fetchAll();
$zonales=$pdo->query("SELECT id_zonal,nombre FROM zonales ORDER BY nombre")->fetchAll();
$sedes_all=$pdo->query("SELECT id_sede,sede,id_zonal FROM sedes")->fetchAll();
// Procesar POST
if($_SERVER['REQUEST_METHOD']==='POST'){
  // Recoger… validaciones… insertar… (igual a edit)
}
?>
<!-- Formulario similar a edit, omitido por brevedad -->
