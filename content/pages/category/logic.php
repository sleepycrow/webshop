<?php
$cat_id = intval($s_req->get_arg(0));
$page = intval($s_req->get_arg(1, 1));

if($cat_id == null) e_404();

// Wyciągnij informacje o tej kategorii
$quer = $s_db->query("SELECT * FROM `".TABLE_CATEGORIES."` WHERE `cat_id`={$cat_id}");
if($quer->num_rows <= 0) e_404();
$category = $quer->fetch_assoc();

// Wyciągnij z bazy produkty z tej kategorii
try{
  $products_per_page = $s_conf['products_per_page'];
  $offset = ($page - 1) * $products_per_page;
  $products = \Sklep\ShopUtils::fetch_products($s_db, "WHERE `cat_id`={$cat_id} LIMIT {$offset}, {$products_per_page}");
}catch(Exception $e){
  if(DEBUG) die("<pre>{$e}</pre>");
  die($e->getMessage());
}

// Wrzuć wszystko w model
$s_page->set_model($category);
$s_page->set_model('products', $products);
$s_page->set_model('page_num', $page);
