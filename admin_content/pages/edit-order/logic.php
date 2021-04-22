<?php
// Weź ID produktu
$order_id = intval($s_req->get_arg(0, -1));
if($order_id < 0) e_404();

// ## Zmienianie zamówienia ##
if(isset($_POST['intent-toggle-paid'])){
  $quer = $s_db->query("SELECT `order_date_paid` FROM `".TABLE_ORDERS."` WHERE `order_id`='{$order_id}'");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
  if($quer->num_rows > 0){
    $date_paid = $quer->fetch_assoc()['order_date_paid'];

    if($date_paid === null)
      $quer = $s_db->query("UPDATE `".TABLE_ORDERS."` SET `order_date_paid`=NOW() WHERE `order_id` = {$order_id}");
    else
      $quer = $s_db->query("UPDATE `".TABLE_ORDERS."` SET `order_date_paid`=NULL WHERE `order_id` = {$order_id}");

    if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
  }
}

if(isset($_POST['intent-delete-order'])){
  $quer = $s_db->query("DELETE FROM `".TABLE_ORDERS."` WHERE `order_id`={$order_id}");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
}

// ## Przygotowanie do wyświetlania ##
// Zdobywanie informacji nt. zamówienia
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS."` ".
  "INNER JOIN `".TABLE_USERS."` ON `".TABLE_USERS."`.`user_id`=`".TABLE_ORDERS."`.`user_id` ".
  "WHERE `order_id`={$order_id}");
if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
if($quer->num_rows <= 0) e_404();
$order = $quer->fetch_assoc();

// Wyciągnij z bazy zamówione produkty
$products = [];
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS_PRODUCTS."` ".
  "INNER JOIN `".TABLE_PRODUCTS."` ON `".TABLE_ORDERS_PRODUCTS."`.`product_id`=`".TABLE_PRODUCTS."`.`product_id` ".
  "WHERE `order_id`='{$order_id}'");
if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
while($row = $quer->fetch_assoc()) array_push($products, $row);

// Wsadź wszystko do modelu strony
$order['products'] = $products;
$s_page->set_model('order', $order);

// dodatkowo, jeśli zamówienie jest oznacznoe jako nieodczytane, zmień to
if(!$order['order_seen_by_admin'])
  $quer = $s_db->query("UPDATE `".TABLE_ORDERS."` SET `order_seen_by_admin`=TRUE WHERE `order_id` = {$order_id}");
