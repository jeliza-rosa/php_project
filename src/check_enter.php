<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$strAll = 'select * from users where login=:login';
$checkLogin = false;

$pdo = connect();

$user_info = $pdo->prepare($strAll);
$user_info->bindParam('login', $_POST['login']);
$user_info->execute();
$user = $user_info->fetchAll();

if ($user == []) {
	echo json_encode(false);
} else {
	if (password_verify($_POST['password'], $user[0]['password'])) {
	    session_start();
	    $_SESSION['login'] = $_POST['login'];
	    echo json_encode(true);
	} else {
		echo json_encode(false);
	}
}
