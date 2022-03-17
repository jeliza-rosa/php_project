<?php

function getChapters() 
{
	$pdo = connect();
	$chapters_info = $pdo->prepare("select p.id, chapters.name as chapter_name from products as p left join product_chapter on id=product_chapter.products_id left join chapters on product_chapter.chapters_id=chapters.id");
	$chapters_info->execute();
	$chapters = $chapters_info->fetchAll();

	return $chapters;
}
