<?php
// Upewnij się, że podano wszystkie potrzebne dane.
if(!isset($_POST['order_address']) || empty(trim($_POST['order_address']))){
  $s_page->add_notice('error', 'Nie podano adresu do wysyłki!');
}else{
  // Przygotuj wartości
  $user_id = $_SESSION['user']['user_id'];
  $order_address = mysqli_escape_string($s_db, $_POST['order_address']);
  $order_total = 0.0;
  foreach($_SESSION['cart'] as $cart_item)
    $order_total += $cart_item['amount'] * $cart_item['product']['product_price'];

  // Dodaj zamówienie do tabeli z zamówieniami
  $quer = $s_db->query("INSERT INTO `".TABLE_ORDERS."` (`user_id`, `order_address`, `order_total`) VALUES ($user_id, '$order_address', $order_total)");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");
  $order_id = $s_db->insert_id;

  // Utwórz zapytanie,
  foreach($_SESSION['cart'] as $cart_item){
    $s_db->query("UPDATE `".TABLE_PRODUCTS."` SET `product_quantity` = (`product_quantity` - {$cart_item['amount']}) WHERE `product_id` = {$cart_item['product']['product_id']}");
  }

  // Utwórz zapytanie, które umożliwi dodanie wszystkich produktów do tabeli łączącej produkty z zamówieniami
  $inserts = [];
  foreach($_SESSION['cart'] as $cart_item){
    array_push($inserts, "({$order_id}, {$cart_item['product']['product_id']}, {$cart_item['amount']})");
  }
  $inserts_sql = implode(', ', $inserts);

  // Wykonaj to zapytanie
  $quer = $s_db->query("INSERT INTO `".TABLE_ORDERS_PRODUCTS."` (`order_id`, `product_id`, `orders_products_amount`) VALUES {$inserts_sql}");
  if($quer == false) die(DEBUG ? mysqli_error($s_db) : "Wystąpił błąd");

  // Usuń koszyk
  unset($_SESSION['cart']);

  // Przekieruj do strony z rachunkiem
  header('Location:'.s_page('/user-receipt/'.$order_id));
  die('Udało się złożyć zamówienie!');
}
