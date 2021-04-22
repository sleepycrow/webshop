<?php
$search_term = isset($_GET['q']) ? mysqli_escape_string($s_db, $_GET['q']) : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Wyciągnij z bazy produkty z tej kategorii
try{
  $products_per_page = $s_conf['products_per_page'];
  $offset = ($page - 1) * $products_per_page;
  $products = \Sklep\ShopUtils::fetch_products($s_db, "WHERE `product_name` LIKE '%{$search_term}%' LIMIT {$offset}, {$products_per_page}");
}catch(Exception $e){
  if(DEBUG) die("<pre>{$e}</pre>");
  die($e->getMessage());
}

// Wrzuć wszystko w model
$s_page->set_model('search_term', $search_term);
$s_page->set_model('products', $products);
$s_page->set_model('page_num', $page);
