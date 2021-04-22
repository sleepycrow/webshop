<main class="page page--cart">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main-header">Koszyk</h1>
  <section class="cart">
    <table class="cart-table">
      <tr>
        <th class="cart__delbtn-row"></th>
        <th class="cart__img-row">Obrazek</th>
        <th class="cart__name-row">Nazwa</th>
        <th class="cart__price-row">Cena</th>
        <th class="cart__amount-row">Ilość</th>
        <th class="cart__sum-row">Suma</th>
      </tr>

      <?php
        $total = 0.0;

        foreach(s_model('cart') as $cart_item){
          $total += $cart_item['amount'] * $cart_item['product']['product_price'];

          echo '<tr>';

          echo '<td class="cart__delbtn-row">';
          echo '<form action="" method="POST">';
          echo '<input type="hidden" name="removefromcart" value="'.$cart_item["product"]["product_id"].'" />';
          echo '<button>x</button>';
          echo '</form>';
          echo '</td>';

          echo '<td class="cart__img-row"> <img src="'.($cart_item["product"]["product_thumbnail_src"] ?: $s_site->conf('default_thumbnail')).'" alt="obrazek lol" /> </td>';
          echo '<td class="cart__name-row"> <a href="'.s_page('/product/'.$cart_item["product"]["product_id"]).'">'.$cart_item["product"]["product_name"].'</a> </td>';
          echo '<td class="cart__price-row"> '.s_price($cart_item["product"]["product_price"]).' </td>';
          echo '<td class="cart__amount-row"> '.$cart_item["amount"].' </td>';
          echo '<td class="cart__sum-row"> '.s_price($cart_item["amount"] * $cart_item["product"]["product_price"]).' </td>';

          echo '</tr>';
        }
      ?>
    </table>

    <div class="cart-total">Suma: <span class="cart-total__number"><?php echo s_price($total); ?></span></div>
  </section>

  <section class="checkout-form">
    <h3 class="section-header">Złóż zamówienie</h3>
    <?php
      if(s_model('hide_checkout')){
        echo "<div class='checkout-disable-notice'>".s_model('hide_reason')."</div>";
      }else{
        include $s_page->page_dir_path.'/checkout_form.php';
      }
    ?>
  </section>
</main>
