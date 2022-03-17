<?php
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT'] . '/src/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_products.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_chapters.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_orders.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_products_chapter.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/markup_creation.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/send_order_db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/get_max_min_price.php';
