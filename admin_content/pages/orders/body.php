<main class="page page-orders">
  <h1 class="main__header">Zamówienia</h1>

  <section class="page-orders__criteria">
    <h3 class="section__header">Filtruj</h3>

    <form action="" method="GET">
      <div class="field">
        <label for="user_id">ID Użytkownika</label>
        <input type="text" id="user_id" name="user_id" placeholder="ID Użytkownika" value="<?php echo s_model('user_id'); ?>" />
      </div>

      <div class="field">
        <input type="checkbox" name="only_unseen" id="only_unseen" value="1" <?php if(s_model('only_unseen')) echo "checked"; ?> />
        <label style="display: inline-block; width: auto;" for="only_unseen">Tylko jeszcze nie widziane</label>
      </div>

      <div class="buttons">
        <button>Szukaj</button>
      </div>
    </form>
  </section>

  <section class="page-orders__results">
    <h3 class="section__header">Zamówienia</h3>

    <table class="order-table">
      <tr>
        <th class="order-table__order-id-col">ID Zamówienia</th>
        <th class="order-table__user-col">Użytkownik</th>
        <th class="order-table__date-made-col">Data Złożenia</th>
        <th class="order-table__date-paid-col">Data Opłaty</th>
        <th class="order-table__order-seen-col">Już widziane?</th>
        <th class="order-table__total-col">Suma</th>
      </tr>

      <?php
        foreach(s_model('orders') as $order){
          echo '<tr>';

          echo "<td class='order-table__order-id-col'> <a href='".s_page('/edit-order/'.$order['order_id'])."'>{$order['order_id']}</a> </td>";
          echo "<td class='order-table__user-col'> {$order['username']} (ID: {$order['user_id']}) </td>";
          echo "<td class='order-table__date-made-col'> {$order['order_date_made']} </td>";
          echo '<td class="order-table__date-paid-col"> '.($order['order_date_paid'] ?: "<strong>NIEOPŁACONE</strong>").' </td>';
          echo "<td class='order-table__order-seen-col'> ".($order['order_seen_by_admin'] ? "Tak" : "<strong>Nie</strong>")." </td>";
          echo '<td class="order-table__total-col"> '.s_price($order["order_total"]).' </td>';

          echo '</tr>';
        }
      ?>
    </table>
  </section>
</main>
