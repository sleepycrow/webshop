<main class="page page--product">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Edytowanie produktu "<?php echo s_model('product')['product_name']; ?>"</h1>

  <?php
  $product = s_model('product');
  $categories = s_model('categories');
  ?>
  <section class="product-edit">
    <h3 class="section__header">Szczegóły produktu</h3>

    <form action="" method="POST">
      <input type="hidden" name="intent-edit-product" value="yes" />

      <div class="field">
        <label for="product_name">Nazwa produktu</label>
        <input type="text" id="product_name" name="product_name" placeholder="Nazwa produktu" value="<?php echo $product['product_name']; ?>" />
      </div>

      <div class="field field-product-thumbnail">
        <label for="product_thumbnail_src">Miniaturka produktu</label>
        <div class="product_thumbnail_preview">
          <a href="<?php echo ($product['product_thumbnail_src'] ?: $s_site->conf('default_thumbnail')); ?>">
            <img src="<?php echo ($product['product_thumbnail_src'] ?: $s_site->conf('default_thumbnail')); ?>" alt="Obrazek" />
          </a>
        </div>
        <input type="text" id="product_thumbnail_src" name="product_thumbnail_src" placeholder="Adres miniaturki produktu" value="<?php echo $product['product_thumbnail_src']; ?>" />
      </div>

      <div class="field">
        <label for="cat_id">Kategoria produktu</label>
        <select id="cat_id" name="cat_id">
          <option value="0">---</option>
          <?php
            foreach($categories as $category){
              echo "<option value='{$category['cat_id']}'".($category['cat_id'] == $product['cat_id'] ? ' selected' : '').">{$category['cat_name']}</option>";
            }
          ?>
        </select>
      </div>

      <div class="field">
        <label for="product_price">Cena za sztukę</label>
        <input type="text" id="product_price" name="product_price" placeholder="9.99" value="<?php echo $product['product_price']; ?>" />
      </div>

      <div class="field">
        <label for="product_quantity">Ilość sztuk na stanie</label>
        <input type="number" id="product_quantity" name="product_quantity" value="<?php echo $product['product_quantity']; ?>" />
      </div>

      <div class="field">
        <label for="product_description">Opis produktu</label>
        <textarea name="product_description" id="product_description" placeholder="Opis produktu"><?php echo $product['product_description']; ?></textarea>
      </div>

      <div class="buttons">
        <button>Zapisz</button>
      </div>
    </form>
  </section>

  <section class="product-image-add">
    <h3 class="section__header">Dodaj obraz do galerii produktu</h3>

    <form action="" method="POST">
      <input type="hidden" name="intent-add-img" value="okay" />

      <div class="field">
        <label for="prodimg_src">Adres obrazu</label>
        <input type="text" id="prodimg_src" name="prodimg_src" placeholder="Adres obrazu" />
      </div>

      <div class="buttons">
        <button>Dodaj</button>
      </div>
    </form>
  </section>

  <section class="product-image-edit">
    <h3 class="section__header">Galeria produktu</h3>

    <ul class="product-image-list">
    <?php
    foreach($product['imgs'] as $img){
      echo '<li class="product-image-list__image">';

      echo '<a href="'.$img['prodimg_src'].'"><img class="prodimg_preview" src="'.$img['prodimg_src'].'" alt="obrazek lol" /></a>';

      echo '<div class="img__delbtn">';
      echo '<form action="" method="POST">';
      echo '<input type="hidden" name="intent-delete-img" value="'.$img['prodimg_id'].'" />';
      echo '<button>Usuń</button>';
      echo '</form>';
      echo '</div>';

      echo '</li>';
    }
    ?>
    </ul>
  </section>

  <section class="product-delete">
    <h3 class="section__header">Usuń produkt</h3>

    <form action="" method="POST">
      <div class="buttons">
        <input type="hidden" name="intent-delete-product" value="yes" />
        <button>Usuń produkt</button>
      </div>
    </form>
  </section>
</main>
