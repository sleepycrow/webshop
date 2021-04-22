<?php
// Weź ID produktu
$cat_id = intval($s_req->get_arg(0));
if($cat_id === 0) e_404();

// ## Wprowadzanie zmian w kategorii ##
if(isset($_POST['intent-edit-category'])){
  // Dowiedz się, jakie zmiany chce wprowadzić użyszkodnik
  $changes = [];

  if(isset($_POST['cat_name']) && !empty(trim($_POST['cat_name']))){
    $changes['cat_name'] = "'".mysqli_escape_string($s_db, htmlspecialchars($_POST['cat_name']))."'";
  }

  // Zbuduj zapytanie SQL
  $updates = [];
  foreach($changes as $key => $val){
    array_push($updates, "`{$key}`=$val");
  }
  $updates_sql = implode(', ', $updates);

  // ...i, w końcu, wykonaj je.
  $s_db->query("UPDATE `".TABLE_CATEGORIES."` SET {$updates_sql} WHERE `cat_id`={$cat_id}")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");

  $s_page->add_notice('info', "Wprowadzono zmiany do kategorii!");
}

// ## Usuwanie kategorii ##
if(isset($_POST['intent-delete-category'])){
  $s_db->query("DELETE FROM `".TABLE_CATEGORIES."` WHERE `cat_id`={$cat_id}")
    or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");
}

// ## Przygotowanie do wyświetlania ##
// Bierz kategorie do pokazania na stronce
$quer = $s_db->query("SELECT * FROM `".TABLE_CATEGORIES."` WHERE `cat_id`={$cat_id}")
  or die(DEBUG ? '<pre>'.mysqli_error($s_db).'</pre>' : "Wystąpił błąd.");
if($quer->num_rows <= 0) e_404();
$category = $quer->fetch_assoc();
$s_page->set_model('category', $category);

