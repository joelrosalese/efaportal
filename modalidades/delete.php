<?php
require '../config/database.php';

// Validar ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $del = $pdo->prepare("DELETE FROM modalidades WHERE id_modalidad = ?");
    $del->execute([$id]);
}
header('Location: index.php');
exit;