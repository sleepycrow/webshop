<?php
// Tworzenie nowych produtków
if(isset($_POST['intent-add-category'])){
  $s_db->query("INSERT INTO `".TABLE_CATEGORIES."` (`cat_name`) VALUES ('Nowa Kategoria')")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  header('Location:'.s_page('/edit-category/'.$s_db->insert_id));
  die("Dodano pomyślnie!");
}

// Bierz kategorie do pokazania na stronce
$categories = \Sklep\ShopUtils::fetch_categories($s_db);
$s_page->set_model('categories', $categories);

