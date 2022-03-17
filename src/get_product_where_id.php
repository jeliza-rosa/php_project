<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$post = json_decode($_POST['json'], true);
$str = 'select p.name, price, image, novelty, sale, chapters.name as chapter_name from products as p left join product_chapter on id=product_chapter.products_id left join chapters on product_chapter.chapters_id=chapters.id where p.id=:id';

$pdo = connect();
$product_info = $pdo->prepare($str);
$product_info->bindParam('id', $post['id']);
$product_info->execute();
$product = $product_info->fetchAll();

$chapters = [];

foreach ($product as $value) {
	array_push($chapters, $value['chapter_name']);
}

$product['chapter_name'] = $chapters;

echo json_encode($product);
