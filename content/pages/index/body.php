<main class="page page--index product-list-page">
  <h1 class="main-header">Witaj w sklepie!</h1>

  <section class="page-index__random">
    <p>Wybraliśmy dla ciebie te 20 losowych produktów:</p>

    <?php
    $products = s_model('random_products');
    include s_common_path('/product-list.php');
    ?>
  </section>
</main>
