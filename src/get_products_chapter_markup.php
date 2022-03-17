<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$products = getProductsChapter();

$lengthProducts = count($products);

if (!empty($_GET['page'])) {
	if ($_GET['page'] == 1 || $_GET['page'] == null) {
		$prod2 = array_slice($products, 0, 12);
	} elseif ($_GET['page'] == ceil($lengthProducts / 12)) {
		if ($lengthProducts % 12 != 0) {
			$prod2 = array_slice($products, 12 * intdiv($lengthProducts, 12), $lengthProducts % 12);
		} else {
			$prod2 = array_slice($products, 12 * intdiv($lengthProducts, 12) - 12, 12);
		}
	} else {
		$prod2 = array_slice($products, 12 * ($_GET['page'] - 1), 12);
	}
} else {
	$prod2 = array_slice($products, 0, 12);
}

$result = markupCreate($prod2); //строка с разметкой(в начале длина массива)
$result = $lengthProducts . $result;

echo json_encode($result);
