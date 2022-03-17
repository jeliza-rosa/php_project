<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
$post = json_decode($_POST['json'], true);

if ($post['surname'] != null && $post['name'] != null && $post['phone'] != null && $post['mail'] != null) {
	if (($post['delivery'] == "Самовывоз") || ($post['city'] != null && $post['street'] != null && $post['house'] != null && $post['apartment'] != null)) {
		$str = sendOrderDB($post);
		echo json_encode($str);
	}
}
