<main class="page page-users">
  <h1 class="main__header">Użytkownicy</h1>

  <section class="page-users__criteria">
    <h3 class="section__header">Filtruj</h3>

    <form action="" method="GET">
      <div class="field">
        <label for="q">Szukaj</label>
        <input type="text" id="q" name="q" placeholder="Szukaj" value="<?php echo s_model('q'); ?>" />
      </div>

      <div class="buttons">
        <button>Szukaj</button>
      </div>
    </form>
  </section>

  <section class="page-users__results">
    <h3 class="section__header">Użytkownicy</h3>

    <table class="users-table">
      <tr>
        <th class="users-table__id-col">ID Użytkownika</th>
        <th class="users-table__username-col">Nazwa użytkownika</th>
        <th class="users-table__role-col">Ranga</th>
      </tr>

      <?php
        foreach(s_model('users') as $user){
          echo '<tr>';

          echo "<td class='users-table__user-id-col'> <a href='".s_page('/edit-user/'.$user['user_id'])."'>{$user['user_id']}</a> </td>";
          echo "<td class='users-table__username-col'> <a href='".s_page('/edit-user/'.$user['user_id'])."'>{$user['username']}</a> </td>";
          echo "<td class='users-table__role-col'> ".($user['is_admin'] ? "Administrator" : "Użytkownik")." </td>";

          echo '</tr>';
        }
      ?>
    </table>
  </section>
</main>
