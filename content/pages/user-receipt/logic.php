<?php
if(!s_logged_in()) die('nie lol');

$order_id = intval($s_req->get_arg(0, -1));
if($order_id < 0) e_404();

// Wyciągnij z bazy zamówienie
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS."` WHERE `order_id`={$order_id} AND `user_id`='{$_SESSION['user']['user_id']}' ORDER BY `order_id` DESC");
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
