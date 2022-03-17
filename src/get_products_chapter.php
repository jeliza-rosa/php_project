<?php
function getProductsChapter() 
{
	$chapter = $_GET['chapter'] ?? null;
	$minPrice = $_GET['minPrice'] ?? null;
	$maxPrice = $_GET['maxPrice'] ?? null;
	$novelty = $_GET['novelty'] ?? null;
	$sale = $_GET['sale'] ?? null;
	$sort = $_GET['sort'] ?? null;
	$order = $_GET['order'] ?? null;
	
	$str = "select p.id, p.name, price, image, chapters.name as chapter_name from products as p left join product_chapter on id=product_chapter.products_id left join chapters on product_chapter.chapters_id=chapters.id";

	$arrHelp = [];

	if ($chapter == 'Все' || !isset($chapter)) {
		$str = "select distinct name, price, image from products";
	} else {
		array_push($arrHelp, " chapters.name=:chapter");
	}

	if ($maxPrice != null) {
		array_push($arrHelp, " price<=:maxPrice");
	}

	if ($minPrice != null) {
		array_push($arrHelp, " price>=:minPrice");
	}

	if ($novelty != null) {
		array_push($arrHelp, " novelty=:novelty");
	}

	if ($sale != null) {
		array_push($arrHelp, " sale=:sale");
	}

	$newStr = implode(' and', $arrHelp);

	if (count($arrHelp) !== 0) {
		$newStr = " where" . $newStr;
	}

	if ($sort != null) {
		$newStr = $newStr . " order by $sort";
		if ($order != null) {
			$newStr = $newStr . " $order";
		}
	}

	$str = $str . $newStr;

	$pdo = connect();
	$products_info = $pdo->prepare($str);

	if (!($chapter == 'Все' || !isset($chapter))) {
		$products_info->bindParam('chapter', $chapter);
	}

	if ($maxPrice != null) {
		$products_info->bindParam('maxPrice', $maxPrice);
	}

	if ($minPrice != null) {
		$products_info->bindParam('minPrice', $minPrice);
	}

	if ($novelty != null) {
		$products_info->bindParam('novelty', $novelty);
	}

	$products_info->execute();
	$products = $products_info->fetchAll();

	return $products;
}
