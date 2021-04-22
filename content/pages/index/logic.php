<?php
// Wyciągnij z bazy 20 losowych produktów
try{
  $random_products = \Sklep\ShopUtils::fetch_products($s_db, "WHERE `product_quantity` > 0 ORDER BY RAND() LIMIT 20");
}catch(Exception $e){
  if(DEBUG) die("<pre>{$e}</pre>");
  die($e->getMessage());
}

// Wrzuć to w model
$s_page->set_model([
  'random_products' => $random_products
]);
