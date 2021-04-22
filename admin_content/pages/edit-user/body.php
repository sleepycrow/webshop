<main class="page page--user">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Użytkownik "<?php echo s_model('user')['username']; ?>"</h1>

  <?php
  $user = s_model('user');
  ?>
  <section class="user-info">
    <h3 class="section__header">Informacje o użytkowniku</h3>

    <p>
      <strong>ID użytkownika</strong>:
      <?php echo $user['user_id']; ?>
    </p>

    <p>
      <strong>Adres e-mail</strong>:
      <?php echo $user['email']; ?>
    </p>

    <p>
      <strong>Ranga</strong>:
      <?php echo ($user['is_admin'] ? "Administrator" : "Użytkownik"); ?>

      <form action="" method="POST">
        <input type="hidden" name="intent-toggle-admin" value="plisss" />
        <button>Zmień rangę</button>
      </form>
    </p>

    <p>
      <a href="<?php echo s_page('/orders/?user_id='.$user['user_id']); ?>">Zobacz zamówienia użytkownika</a>
    </p>
  </section>

  <section class="user-delete">
    <h3 class="section__header">Usuń użytkownika</h3>

    <form action="" method="POST">
      <div class="buttons">
        <input type="hidden" name="intent-delete-user" value="yes" />
        <button>Usuń użytkownika</button>
      </div>
    </form>
  </section>
</main>
