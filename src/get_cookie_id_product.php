<?php 
session_start();  
if (empty($_SESSION['id_product'])) {
	echo json_encode(false);
} else {
	echo json_encode($_SESSION['id_product']);
}
