<?php
// Weź ID użytkownika
$user_id = intval($s_req->get_arg(0, -1));
if($user_id < 0) e_404();

// ## Zmienianie użytkownika ##
if(isset($_POST['intent-toggle-admin'])){
  $quer = $s_db->query("SELECT `is_admin` FROM `".TABLE_USERS."` WHERE `user_id`='{$user_id}'");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
  if($quer->num_rows > 0){
    $is_admin = $quer->fetch_assoc()['is_admin'];

    if($is_admin)
      $quer = $s_db->query("UPDATE `".TABLE_USERS."` SET `is_admin`=FALSE WHERE `user_id` = {$user_id}");
    else
      $quer = $s_db->query("UPDATE `".TABLE_USERS."` SET `is_admin`=TRUE WHERE `user_id` = {$user_id}");

    if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
  }
}

if(isset($_POST['intent-delete-user'])){
  $quer = $s_db->query("DELETE FROM `".TABLE_USERS."` WHERE `user_id`={$user_id}");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
}

// ## Przygotowanie do wyświetlania ##
// Zdobywanie informacji nt. użytkownika
$quer = $s_db->query("SELECT * FROM `".TABLE_USERS."` WHERE `user_id`={$user_id}");
if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
if($quer->num_rows <= 0) e_404();
$user = $quer->fetch_assoc();

// Wsadź wszystko do modelu strony
$s_page->set_model('user', $user);

