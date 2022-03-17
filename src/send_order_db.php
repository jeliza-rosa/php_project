<?php
	
function sendOrderDB($data) 
{
	$customer = trim($data['surname'] . ' ' . $data['name'] . ' ' . $data['thirdName']);
	$sum;
	if ($data['price'] < FREE_DELIVERY && $data['delivery'] == 'Курьер') {
		$sum = $data['price'] + COURIER_DELIVERY;
	} else {
		$sum = $data['price'];
	}
	$deliveryMethod = $data['delivery'];
	$payMethod = $data['pay'];
	$address = 'г. ' . $data['city'] . ', ул. ' . $data['street'] . ', д.' . $data['house'] . ', кв. ' . $data['apartment'];

	$strKeys = 'customer, phone, sum, delivery_method, pay_method, comment';
	$strValues = ':customer, :phone, ' . $sum . ',"' . $deliveryMethod . '", "' . $payMethod . '", :comment';

	if ($deliveryMethod == 'Курьер') {
		$strDevYes = ', address';
		$strDevYesValues = ', :address';
		$strKeys = $strKeys . $strDevYes;
		$strValues = $strValues . $strDevYesValues;
	}

	$str = 'insert into orders(' . $strKeys . ') values(' . $strValues . ')';

	$pdo = connect();
	$order = $pdo->prepare($str);
	$order->bindParam('customer', $customer);
	$order->bindParam('phone', $data['phone']);
	$order->bindParam('comment', $data['comment']);

	if ($deliveryMethod == 'Курьер') {
		$order->bindParam('address', $address);
	}

	return $order->execute();
}
