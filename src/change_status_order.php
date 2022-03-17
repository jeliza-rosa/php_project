<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$post = json_decode($_POST['json'], true);//массив
$id = $post['id'];
$status = $post['status'];

$str = 'update orders set done=' . $status . ' where id=' . $id;

$pdo = connect();

$orderStatus = $pdo->prepare($str);
$orderStatus->bindParam('str', $str, PDO::PARAM_STR);

echo json_encode($orderStatus->execute());
