<main class="page page--product">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <?php
  $product = s_model();
  include s_common_path('/product-view.php');
  ?>
</main>
