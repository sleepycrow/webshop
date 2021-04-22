<main class="page page-orders">
  <h1 class="main-header">Twoje zamówienia</h1>

  <ul>
  <?php
  foreach(s_model('orders') as $order){
    echo '<li>';
    echo '<a href="'.s_page('/user-receipt/'.$order['order_id']).'">';

    echo "Zamówienie #{$order['order_id']} z dnia {$order['order_date_made']}";
    echo ($order['order_date_paid'] == NULL ? ' - <strong>NIEOPŁACONE!</strong>' : ' - Opłacone!');

    echo '</a>';
    echo '</li>';
  }
  ?>
  </ul>
</main>
