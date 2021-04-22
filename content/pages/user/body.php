<main class="page page--user">
  <h1 class="main-header">Witaj, <?php echo $_SESSION['user']['username']; ?>!</h1>

  <ul>
    <li><a href="<?php e_page('/user-orders/'); ?>">Twoje zamówienia</a></li>
    <li><a href="<?php e_page('/user-manage/'); ?>">Zarządzaj kontem</a></li>
    <li><a href="<?php e_page('/auth/logout'); ?>">Wyloguj się</a></li>
  </ul>
</main>
