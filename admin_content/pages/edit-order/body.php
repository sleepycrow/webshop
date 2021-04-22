<main class="page page--order">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Zamówienie #<?php echo s_model('order')['order_id']; ?></h1>

  <?php
  $order = s_model('order');
  ?>
  <section class="order-info">
    <h3 class="section__header">Szczegóły zamówienia</h3>

    <p>
      <strong>Użytkownik</strong>:
      <?php echo "<a href='".s_page('/edit-user/'.$order['user_id'])."'>{$order['username']} (ID: {$order['user_id']})</a>"; ?>
    </p>

    <p>
      <strong>Data złożenia</strong>:
      <?php echo $order['order_date_made']; ?>
    </p>

    <p>
      <strong>Data opłacenia</strong>:
      <?php echo ($order['order_date_paid'] !== null ? $order['order_date_paid'] : "Nie opłacono"); ?>

      <form action="" method="POST">
        <input type="hidden" name="intent-toggle-paid" value="pleas" />
        <button>Zmień stan</button>
      </form>
    </p>

    <p>
      <strong>Adres do wysyłki</strong>:<br>
      <?php echo str_replace("\n", "<br>", $order['order_address']); ?>
    </p>
  </section>

  <section class="order-products">
    <h3 class="section-header">Zamówione produkty (<?php echo count($order['products']); ?>)</h3>
    <?php
    echo '<ul>';
    foreach($order['products'] as $product){
      $price_paid = $product['product_price']*$product['orders_products_amount'];

      echo '<li>';

      echo "{$product['orders_products_amount']}x ";
      echo "<a href='".s_page('/edit-product/'.$product['product_id'])."'>{$product['product_name']}</a> ";
      echo "(w sumie ".s_price($price_paid).")";

      echo '</li>';
    }
    echo '</ul>';
    ?>

    <div class="order-total">Suma: <span class="order-total__number"><?php echo s_price(s_model('order')['order_total']); ?></span></div>
  </section>

  <section class="order-delete">
    <h3 class="section__header">Usuń zamówienie</h3>

    <form action="" method="POST">
      <div class="buttons">
        <input type="hidden" name="intent-delete-order" value="yes" />
        <button>Usuń zamówienie</button>
      </div>
    </form>
  </section>
</main>
