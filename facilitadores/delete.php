<?php
require '../config/database.php';

// Validar ID
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id !== '' && ctype_digit($id)) {
    $del = $pdo->prepare("DELETE FROM facilitadores WHERE id_facilitador = ?");
    $del->execute([$id]);
}
header('Location: index.php');
exit;