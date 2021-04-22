<main class="page page-overview">

  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Podsumowanie</h1>

  <section class="page-overview__new-orders">
    <h3 class="section__header">Statystyki z ostatnich <?php e_model('stats_days'); ?> dni</h3>

    <?php if(s_model('stats')): ?>
      <p><strong>Ilość zamówień</strong>: <?php echo s_model('stats')['amount']; ?></p>
      <p><strong>Łączna wartość zamówień</strong>: <?php echo s_price(s_model('stats')['total']); ?></p>
    <?php endif; ?>
  </section>

  <section class="page-overview__new-orders">
    <h3 class="section__header">Nowe zamówienia</h3>

    <ul>
      <?php
        foreach($orders as $order){
          echo "<li><a href='".s_page('/edit-order/'.$order['order_id'])."'>";
          echo "Zamówienie {$order['order_id']} użytkownika {$order['username']} o wartości ".s_price($order['order_total']);
          echo "</a></li>";
        }
      ?>
    </ul>
  </section>

</main>
