<?php
// Wyszukaj odpowiednich użytkowników z bazy danych
$criteria = [1];
if(isset($_GET['q']) && !empty(trim($_GET['q']))){
  $q = $s_db->escape_string($_GET['q']);
  array_push($criteria, "`username` LIKE '%{$q}%'");
  $s_page->set_model('q', $q);
}
$criteria_sql = 'WHERE '.implode(' AND ', $criteria).' ';

$users = [];
$quer = $s_db->query("SELECT * FROM `".TABLE_USERS."` ".
  $criteria_sql.
  "ORDER BY `user_id` DESC");
if($quer == false) die(DEBUG ? $s_db->error : 'Wystąpił błąd');
while($row = $quer->fetch_assoc()) array_push($users, $row);

$s_page->set_model('users', $users);
