<?php
require '../config/database.php';
// Validar ID
$id = $_GET['id'] ?? '';
if (ctype_digit($id)) {
    $del = $pdo->prepare("DELETE FROM zonales WHERE id_zonal = ?");
    $del->execute([$id]);
}
header('Location: index.php'); exit;