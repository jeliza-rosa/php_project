<?php

function getOrders() 
{
	$pdo = connect();
	$products_info = $pdo->prepare("select * from orders order by done, id desc");
	$products_info->execute();
	$products = $products_info->fetchAll();

	return $products;
}
