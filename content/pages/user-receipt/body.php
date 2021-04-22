<main class="page page-orders">
  <h1 class="main-header">Zamówienie #<?php echo s_model('order')['order_id']; ?></h1>

  <section class="page-order__info">
    <h3 class="section-header">Informacje o zamówieniu</h3>
    <p>
      <strong>Zamówiono</strong>:
      <?php echo s_model('order')['order_date_made']; ?>
    </p>
    <p>
      <strong>Opłacono</strong>:
      <?php echo (s_model('order')['order_date_paid'] !== null ? s_model('order')['order_date_paid'] : "Nie opłacono"); ?>
    </p>
    <p>
      <strong>Adres do wysyłki</strong>:<br>
      <?php echo str_replace("\n", "<br>", s_model('order')['order_address']); ?>
    </p>
  </section>

  <section class="order-products">
    <h3 class="section-header">Zamówione produkty (<?php echo count(s_model('order')['products']); ?>)</h3>
    <?php
    echo '<ul>';
    foreach(s_model('order')['products'] as $product){
      $price_paid = $product['product_price']*$product['orders_products_amount'];

      echo '<li>';

      echo "{$product['orders_products_amount']}x ";
      echo "<a href='".s_page('/product/'.$product['product_id'])."'>{$product['product_name']}</a> ";
      echo "(w sumie ".s_price($price_paid).")";

      echo '</li>';
    }
    echo '</ul>';
    ?>

    <div class="order-total">Suma: <span class="order-total__number"><?php echo s_price(s_model('order')['order_total']); ?></span></div>
  </section>

  <section class="page-order__pay">
    <h3 class="section-header">Opłać zamówienie</h3>
    <?php
      if(s_model('order')['order_date_paid'] === null){
        $message = $s_site->conf('pay_order_message', '');
        $message = str_replace('{total}', s_price(s_model('order')['order_total']), $message);
        $message = str_replace('{order_id}', s_model('order')['order_id'], $message);

        echo $message;
      }else{
        echo "<p>Zamówienie zostało już opłacone.</p>";
      }
    ?>
  </section>
</main>
