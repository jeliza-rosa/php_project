<?php
$x = $_POST['json'];
$y = json_decode($x, true)['id'];
session_start();
$_SESSION['id_product'] = $y;

echo json_encode($_SESSION['id_product']);
