<?php
// Zdobywanie informacji nt. produktu
$prod_id = intval($s_req->get_arg(0));
if($prod_id < 1) e_404();

try{
  $product = \Sklep\ShopUtils::fetch_product($s_db, "WHERE `product_id`={$prod_id}", (\Sklep\ProdSelOpts::INCLUDE_CATEGORY + \Sklep\ProdSelOpts::ALL_IMGS));
  if($product == false) e_404();
  $s_page->set_model($product);
}catch(Exception $e){
  if(DEBUG) die("<pre>{$e}</pre>");
  die($e->getMessage());
}

// Ewentualne dodawanie do koszyka
if(isset($_POST['cart_amount'])){
  $cart_amount = intval($_POST['cart_amount']);
  $amount_already_in_cart = 0;

  if(isset($_SESSION['cart'][$prod_id])) $amount_already_in_cart = $_SESSION['cart'][$prod_id]['amount'];

  if($cart_amount > 0){
    if(($amount_already_in_cart + $cart_amount) > $product['product_quantity']){
      $cart_amount = $product['product_quantity'] - $amount_already_in_cart;
      $s_page->add_notice('warn', "Ilość, którą chciałeś dodać do koszyka przekracza ilość sztuk w magazynie! Dodano jedynie {$cart_amount} sztuki.");
    }

    $_SESSION['cart'][$prod_id] = [
      'product' => $product,
      'amount' => $amount_already_in_cart + $cart_amount
    ];
  }
}
