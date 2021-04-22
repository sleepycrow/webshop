<section class="product-view">
  <h1 class="main-header"><?php echo $product['product_name']; ?></h1>

  <section class="product-view__gallery">
    <h3 class="section-header">Obrazki</h3>

    <?php
    foreach($product['imgs'] as $img)
      echo "<a class='gallery-img' href='{$img['prodimg_src']}'><img src='{$img['prodimg_src']}' alt='obrazek' /></a>";
    ?>
  </section>

  <section class="product-view__info">
    <h3 class="section-header">Informacje</h3>

    <p><strong>Cena</strong>: <?php e_price($product['product_price']); ?></p>
    <p><strong>Ilość w magazynie</strong>: <?php echo $product['product_quantity']; ?></p>

    <?php if($product['cat_id'] !== null): ?>
    <p><strong>Kategoria produktu</strong>: <a href="<?php e_page('/category/'.$product['cat_id']); ?>"><?php echo $product['cat_name']; ?></a></p>
    <?php endif; ?>
  </section>

  <section class="product-view__description">
    <h3 class="section-header">Opis</h3>

    <?php echo $product['product_description']; ?>
  </section>

  <section class="product-view__cart-form">
    <h3 class="section-header">Dodaj do koszyka</h3>

    <form action="" method="POST">
      <input type="number" name="cart_amount" value="1" min="1" max="<?php echo $product['product_quantity']; ?>" />
      <button>add to cart</button>
    </form>
  </section>
</section>
