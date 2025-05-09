<?php
require '../config/database.php';
$id=$_GET['id']??''; if(ctype_digit($id)){
  $pdo->prepare('DELETE FROM participantes WHERE id_participante=?')
      ->execute([$id]);
}
header('Location:index.php');exit;
?>