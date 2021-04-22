<?php
// Wyszukaj odpowiednie produkty z bazy danych
$criteria = [1];
if(isset($_GET['user_id']) && !empty(trim($_GET['user_id']))){
  $user_id = intval($_GET['user_id']);
  array_push($criteria, "`".TABLE_ORDERS."`.`user_id`={$user_id}");
  $s_page->set_model('user_id', $user_id);
}
if(isset($_GET['only_unseen'])){
  array_push($criteria, "`".TABLE_ORDERS."`.`order_seen_by_admin`=0");
  $s_page->set_model('only_unseen', $_GET['only_unseen']);
}
$criteria_sql = 'WHERE '.implode(' AND ', $criteria).' ';

$orders = [];
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS."` ".
  "INNER JOIN `".TABLE_USERS."` ON `".TABLE_USERS."`.`user_id`=`".TABLE_ORDERS."`.`user_id` ".
  $criteria_sql.
  "ORDER BY `order_id` DESC");
if($quer == false) die(DEBUG ? $s_db->error : 'Wystąpił błąd');
while($row = $quer->fetch_assoc()) array_push($orders, $row);

$s_page->set_model('orders', $orders);
