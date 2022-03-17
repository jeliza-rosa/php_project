<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
echo json_encode(getMaxMinPrice());
