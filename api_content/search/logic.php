<?php
$search_term = isset($_GET['q']) ? mysqli_escape_string($s_db, $_GET['q']) : '';
$limit = isset($_GET['limit']) ? "LIMIT ".intval($_GET['limit']) : "";

$flags = \Sklep\ProdSelOpts::BRIEF;
if(isset($_GET['cat'])) $flags += \Sklep\ProdSelOpts::INCLUDE_CATEGORY;
if(isset($_GET['full'])) $flags -= \Sklep\ProdSelOpts::BRIEF;

// Wyciągnij z bazy produkty z tej kategorii
try{
  $products = \Sklep\ShopUtils::fetch_products($s_db, "WHERE `product_name` LIKE '%{$search_term}%' {$limit}", $flags);
}catch(Exception $e){
  http_response_code(500);
  die(json_encode([
    'ok' => false,
    'errText' => (DEBUG ? $e : $e->getMessage())
  ]));
}

http_response_code(200);
die(json_encode([
  'ok' => true,
  'products' => $products
]));
