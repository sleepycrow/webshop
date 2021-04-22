<?php
// Weź ID produktu
$prod_id = intval($s_req->get_arg(0));
if($prod_id === 0) e_404();

// ## Wprowadzanie zmian w produkcie ##
if(isset($_POST['intent-edit-product'])){
  // Dowiedz się, jakie zmiany chce wprowadzić użyszkodnik
  $changes = [];

  if(isset($_POST['product_name']) && !empty(trim($_POST['product_name']))){
    $changes['product_name'] = "'".mysqli_escape_string($s_db, htmlspecialchars($_POST['product_name']))."'";
  }
  if(isset($_POST['product_thumbnail_src'])){
    $changes['product_thumbnail_src'] = "'".mysqli_escape_string($s_db, $_POST['product_thumbnail_src'])."'";
  }
  if(isset($_POST['product_description'])){
    $changes['product_description'] = "'".mysqli_escape_string($s_db, $_POST['product_description'])."'";
  }
  if(isset($_POST['product_quantity'])){
    $changes['product_quantity'] = intval($_POST['product_quantity']);
  }
  if(isset($_POST['cat_id'])){
    $changes['cat_id'] = ($_POST['cat_id'] == 0 ? 'NULL' : intval($_POST['cat_id']));
  }
  if(isset($_POST['product_price'])){
    $changes['product_price'] = floatval($_POST['product_price']);
  }

  // Zbuduj zapytanie SQL
  $updates = [];
  foreach($changes as $key => $val){
    array_push($updates, "`{$key}`=$val");
  }
  $updates_sql = implode(', ', $updates);

  // ...i, w końcu, wykonaj je.
  $s_db->query("UPDATE `".TABLE_PRODUCTS."` SET {$updates_sql} WHERE `product_id`={$prod_id}")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  $s_page->add_notice('info', "Wprowadzono zmiany do produktu!");
}

// ## Dodawanie obrazków ##
if(isset($_POST['intent-add-img']) && isset($_POST['prodimg_src'])){
  $prodimg_src = mysqli_escape_string($s_db, $_POST['prodimg_src']);
  $s_db->query("INSERT INTO `".TABLE_PRODUCTS_IMAGES."` (`product_id`, `prodimg_src`) VALUES ({$prod_id}, '{$prodimg_src}')")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  $s_page->add_notice('info', "Dodano obrazek do galerii!");
}

// ## Usuwanie obrazków ##
if(isset($_POST['intent-delete-img'])){
  $img_id = intval($_POST['intent-delete-img']);
  $s_db->query("DELETE FROM `".TABLE_PRODUCTS_IMAGES."` WHERE `product_id`={$prod_id} AND `prodimg_id`={$img_id}")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  $s_page->add_notice('info', "Usunięto obrazek z galerii!");
}

// ## Usuwanie produktu ##
if(isset($_POST['intent-delete-product'])){
  $s_db->query("DELETE FROM `".TABLE_PRODUCTS."` WHERE `product_id`={$prod_id}")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");
}

// ## Przygotowanie do wyświetlania ##
// Bierz kategorie do pokazania na stronce
$categories = \Sklep\ShopUtils::fetch_categories($s_db);
$s_page->set_model('categories', $categories);

// Zdobywanie informacji nt. produktu
try{
  $product = \Sklep\ShopUtils::fetch_product($s_db, "WHERE `product_id`={$prod_id}", (\Sklep\ProdSelOpts::INCLUDE_CATEGORY + \Sklep\ProdSelOpts::ALL_IMGS));
  if($product == false) e_404();
  $s_page->set_model('product', $product);
}catch(Exception $e){
  die(DEBUG ? "<pre>{$e}</pre>" : $e->getMessage());
}
