<?php
// Nieodczytane zamówienia
$orders = [];
$quer = $s_db->query("SELECT * FROM `".TABLE_ORDERS."` ".
  "INNER JOIN `".TABLE_USERS."` ON `".TABLE_USERS."`.`user_id`=`".TABLE_ORDERS."`.`user_id` ".
  "WHERE `order_seen_by_admin`=0 ORDER BY `order_id` DESC");
if($quer == false){
  $s_page->add_notice('error', "Wystąpił błąd podczas wyciągania z bazy nowych zamówień.");
}else{
  while($order = $quer->fetch_assoc()) array_push($orders, $order);
}
$s_page->set_model('new_orders', $orders);

// Statystyki
$days = isset($_GET['stats_days']) ? intval($_GET['stats_days']) : 30;
$s_page->set_model('stats_days', $days);

$quer = $s_db->query("SELECT COUNT(`order_id`) as `amount`, SUM(`order_total`) as `total` ".
  "FROM `orders` WHERE `order_date_made` BETWEEN DATE_SUB(NOW(), INTERVAL {$days} DAY) AND NOW();");
if($quer == false){
  $s_page->add_notice('error', "Wystąpił błąd podczas wyciągania z bazy statystyk.");
}else{
  $s_page->set_model('stats', $quer->fetch_assoc());
}
