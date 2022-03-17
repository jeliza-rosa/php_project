<?php
function markupCreate($products) 
{
	$result = '';

foreach ($products as $product) {
    $auxiliary = "
    <article class='shop__item product' tabindex='0'>
        <div class='product__image'>
            <img src='img/products/" . $product['image'] . "' alt='product-name'>
        </div>
        <p class='product__name'>" . $product['name'] . "</p>
        <span class='product__price'>" . $product['price'] . "руб.</span>
    </article>";
  $result = $result . $auxiliary;  
}

	return $result;
}
