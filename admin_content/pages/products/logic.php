<?php
// Tworzenie nowych produtków
if(isset($_POST['intent-add-product'])){
  $s_db->query("INSERT INTO `".TABLE_PRODUCTS."` (`product_name`, `product_quantity`, `product_price`, `product_description`) VALUES ('Nowy Produkt', 0, 2.50, '')")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  header('Location:'.s_page('/edit-product/'.$s_db->insert_id));
  die("Dodano pomyślnie!");
}

// Bierz kategorie do pokazania na stronce
$categories = \Sklep\ShopUtils::fetch_categories($s_db);
$s_page->set_model('categories', $categories);

// Wyszukaj odpowiednie produkty z bazy danych
$criteria = [1];
if(isset($_GET['q']) && !empty(trim($_GET['q']))){
  $search_term = isset($_GET['q']) ? mysqli_escape_string($s_db, $_GET['q']) : '';
  array_push($criteria, "`product_name` LIKE '%{$search_term}%'");
  $s_page->set_model('search_term', $search_term);
}
if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
  $cat_id = intval($_GET['cat_id']);
  array_push($criteria, "`".TABLE_PRODUCTS."`.`cat_id`=".$cat_id);
  $s_page->set_model('cat_id', $cat_id);
}
$criteria_sql = 'WHERE '.implode(' AND ', $criteria);

try{
  $products = \Sklep\ShopUtils::fetch_products($s_db, $criteria_sql, (\Sklep\ProdSelOpts::INCLUDE_CATEGORY));
}catch(Exception $e){
  die(DEBUG ? "<pre>{$e}</pre>" : $e->getMessage());
}

$s_page->set_model('products', $products);
