<?php
require '../config/database.php';

// Validar ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
  $del = $pdo->prepare("DELETE FROM familias WHERE id_familia = ?");
  $del->execute([$id]);
}

// Siempre redirigimos de vuelta al listado
header('Location: index.php');
exit;
