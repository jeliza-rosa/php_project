<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_FILES['product-photo']['name'] != '' && $_POST['product-name'] != '' && $_POST['product-price'] != '' && !empty($_POST['category'])) {
	$newFileName = '';

	//сохранить файл
	$fileName = $_FILES['product-photo']['name'];
	$uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';//куда сохранить

	$newFileName = 'new-' . explode('.', $fileName)[0] . '.' . explode('.', $fileName)[1];

	move_uploaded_file($_FILES['product-photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/img/products/' . $newFileName);

	//добавить продукт в таблицу products
	$pdo = connect();
	$max_id_info = $pdo->prepare("select max(id) from products");
	$max_id_info->execute();
	$max_id_arr = $max_id_info->fetchAll();
	$max_id = $max_id_arr[0]['max(id)'];

	$id = rand($max_id, 999999999);
	$chapters = $_POST['category'];

	if (empty($_POST['new'])) {
		$novelty = 0;
	} elseif ($_POST['new'] == 'on') {
		$novelty = 1;
	}

	if (empty($_POST['sale'])) {
		$sale = 0;
	} elseif ($_POST['sale'] == 'on') {
		$sale = 1;
	}

	$str = 'insert into products(name, price, id, novelty, sale, image) values(:name, :price,' . $id . ',' . $novelty . ',' . $sale . ',"' . $newFileName . '")';

	$pdo = connect();
	$product = $pdo -> prepare($str);
	$product->bindParam('name', $_POST['product-name']);
	$product->bindParam('price', $_POST['product-price']);
	$product->execute();

	//добавить категории в chapters
	$strStart = 'insert into product_chapter(products_id, chapters_id) value';
	$x = [];
	$strEnd = '';

	foreach ($chapters as $value) {
		switch ($value) {
		case 'female':
			$chapt = 1;
			break;
		case 'male':
			$chapt = 2;
			break;
		case 'children':
			$chapt = 3;
			break;
		case 'access':
			$chapt = 4;
			break;
		}
		array_push($x, '(' . $id . ',' . $chapt . ')');
		$strEnd = implode(',', $x);
	}

	$str = $strStart . $strEnd;

		$pdo = connect();
		$chapters = $pdo->prepare($str);
		$chapters->bindParam('str', $str, PDO::PARAM_STR);
		$chapters->execute();

	echo json_encode(true);
} else {
	echo json_encode(false);
}
