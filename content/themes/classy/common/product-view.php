<?php
  $gallery_id = "prod{$product['product_id']}-gallery";
  $just_imgs = [];

  foreach($product['imgs'] as $img) array_push($just_imgs, $img['prodimg_src']);
?>

<section class="product-view">

  <section class="product-overview">
    <div class="product-overview__gallery" id="<?php echo $gallery_id; ?>"></div>

    <div class="product-overview__overview">
      <h1 class="main-header"><?php echo $product['product_name']; ?></h1>

      <div class="product-availability"><strong>Ilość w magazynie</strong>: <?php echo $product['product_quantity']; ?></div>

      <?php if($product['cat_id'] !== null): ?>
      <div class="product-category">
        <strong>Kategoria produktu</strong>: <a href="<?php e_page('/category/'.$product['cat_id']); ?>"><?php echo $product['cat_name']; ?></a>
      </div>
      <?php endif; ?>

      <div class="product-price">Cena: <span class="product-price__number"><?php e_price($product['product_price']); ?></span></div>
      <form action="" method="POST" class="add-to-cart-form">
        <input type="number" name="cart_amount" value="1" min="1" max="<?php echo $product['product_quantity']; ?>" />
        <button>Dodaj do Koszyka</button>
      </form>
    </div>
  </section>

  <section class="product-view__description">
    <h3 class="section-header">Opis</h3>

    <?php echo $product['product_description']; ?>
  </section>

</section>

<script>
  new Gallery("<?php echo $gallery_id; ?>", <?php echo json_encode($just_imgs); ?>);
</script>
