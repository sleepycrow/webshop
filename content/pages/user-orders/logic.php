<?php
if(!s_logged_in()) die('nie lol');

// Wyciągnij z bazy zamówienia
$orders = [];
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS."` WHERE `user_id`='{$_SESSION['user']['user_id']}' ORDER BY `order_id` DESC");
if($quer == false) die("Wystąpił błąd.");
while($row = $quer->fetch_assoc()) array_push($orders, $row);

$s_page->set_model('orders', $orders);
