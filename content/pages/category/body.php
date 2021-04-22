<main class="page page--category product-list-page">
  <h1 class="main-header"><?php echo s_model('cat_name'); ?></h1>

  <?php
  // TODO: Dodaj stronicowanie
  $products = s_model('products');
  include s_common_path('/product-list.php');
  ?>
</main>
