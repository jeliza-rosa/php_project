<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
$post = json_decode($_POST['json'], true);
$str = 'delete from products where id=:id';
$pdo = connect();
$deleteProduct = $pdo->prepare($str);
$deleteProduct->bindParam('id', $post['id']);

echo json_encode($deleteProduct->execute());
