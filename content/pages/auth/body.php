<main class="page page--auth">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <section class="forms">
    <section class="login-form">
      <h3 class="section-header">Zaloguj się</h3>
      <form action="<?php e_page('/auth/'); ?>" method="POST">
        <input type="hidden" name="intent-login" value="yes" />

        <div class="field">
          <label for="login-username">Nazwa użytkownika</label>
          <input type="text" id="login-username" name="username" placeholder="Nazwa użytkownika" />
        </div>

        <div class="field">
          <label for="login-password">Hasło</label>
          <input type="password" id="login-password" name="password" placeholder="Hasło" />
        </div>

        <div class="buttons">
          <button>Zaloguj się</button>
        </div>
      </form>
    </section>

    <section class="signup-form">
      <h3 class="section-header">Zarejestruj się</h3>
      <form action="<?php e_page('/auth/'); ?>" method="POST">
        <input type="hidden" name="intent-signup" value="yes" />

        <div class="field">
          <label for="signup-username">Nazwa użytkownika</label>
          <input type="text" id="signup-username" name="username" placeholder="Nazwa użytkownika" />
        </div>

        <div class="field">
          <label for="signup-email">Adres e-mail</label>
          <input type="email" id="signup-email" name="email" placeholder="Adres e-mail" />
        </div>

        <div class="field">
          <label for="signup-password">Hasło</label>
          <input type="password" id="signup-password" name="password" placeholder="Hasło" />
        </div>

        <div class="field">
          <label for="signup-password2">Powtórz hasło</label>
          <input type="password" id="signup-password2" name="password2" placeholder="Powtórz hasło" />
        </div>

        <div class="buttons">
          <button>Zarejestruj się</button>
        </div>
      </form>
    </section>
  </section>
</main>
