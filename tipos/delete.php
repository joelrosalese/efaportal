<?php
require '../config/database.php';
// Validar ID
$id = $_GET['id'] ?? '';
if (ctype_digit($id)) {
    $del = $pdo->prepare("DELETE FROM tipos WHERE id_tipo = ?");
    $del->execute([$id]);
}
header('Location: index.php');
exit;
