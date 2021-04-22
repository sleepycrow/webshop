<?php
// TODO: Pobieraj najnowsze wiadomości o produktach w koszyku

// Usuwanie rzeczy z koszyka
if(isset($_POST['removefromcart'])){
  $remove_id = intval($_POST['removefromcart']);
  unset($_SESSION['cart'][$remove_id]);
}

// Sprawdź, czy można użytkownikowi pokazać formularz do złożenia zamówienia
$hide_checkout = false;
$hide_reason = '';

if(!s_logged_in()){
  $hide_reason = "Aby złożyć zamówienie musisz być zalogowany.";
  $hide_checkout = true;
}elseif(count($_SESSION['cart']) <= 0){
  $hide_reason = "Aby złożyć zamówienie musisz mieć przynajmniej 1 przedmiot w koszyku.";
  $hide_checkout = true;
}

$s_page->set_model('hide_checkout', $hide_checkout);
$s_page->set_model('hide_reason', $hide_reason);

// Zaincluduj logikę dla składania zamówień
if(!$hide_checkout && isset($_POST['intent-checkout']))
  require_once $s_page->page_dir_path.'/checkout_logic.php';

$s_page->set_model('cart', $_SESSION['cart']);
