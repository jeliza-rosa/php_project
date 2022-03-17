<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$id = $_POST['id'];
$novelty = 0;
$sale = 0;
$category = $_POST['category'];

$chapters = [];

foreach ($category as $value) {
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
	array_push($chapters, '(' . $id . ',' . $chapt . ')');
}

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

//сохранить новую картинку
if ($_FILES['product-photo']['name'] != '') {
	$newFileName = '';

	//сохранить файл
	$fileName = $_FILES['product-photo']['name'];
	$uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';//куда сохранить

	$newFileName = 'edit-' . explode('.', $fileName)[0] . '.' . explode('.', $fileName)[1];

	move_uploaded_file($_FILES['product-photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/img/products/' . $newFileName);

	$strProducts = implode(',', ['name=:name', 'price=:price', 'novelty=' . $novelty, 'sale=' . $sale , 'image="' . $newFileName . '"']);
} else {
	$strProducts = implode(',', ['name=:name', 'price=:price', 'novelty=' . $novelty, 'sale=' . $sale]);
}

$strProducts = 'update products set ' . $strProducts . ' where id=' . $id;

$pdo = connect();
$products = $pdo -> prepare($strProducts);
$products->bindParam('name', $_POST['product-name']);
$products->bindParam('price', $_POST['product-price']);
$products -> execute();

//категории
//удалить строки
$strDelete = 'delete from product_chapter where products_id=' . $id;

$products = $pdo->prepare($strDelete);
$products->bindParam('str', $strDelete, PDO::PARAM_STR);
$products->execute();

//добавить строки
$strChapters = implode(',', $chapters);
$strChapters = 'insert into product_chapter(products_id, chapters_id) values' . $strChapters;

$products = $pdo->prepare($strChapters);
$products->bindParam('str', $strChapters, PDO::PARAM_STR);
$products->execute();

echo json_encode($strProducts);
