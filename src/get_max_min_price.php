<?php
function getMaxMinPrice()
{
	$pdo = connect();
	$max_min_price_info = $pdo->prepare("select max(price), min(price) from products");
	$max_min_price_info->execute();
	$max_min_price = $max_min_price_info->fetchAll();

	return $max_min_price;
}