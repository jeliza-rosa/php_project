<?php

function getProducts($x) 
{
	$pdo = connect();
	$products_info = $pdo->prepare("select " . $x . " from products order by id desc");
	$products_info->execute();
	$products = $products_info->fetchAll();

	return $products;
}
