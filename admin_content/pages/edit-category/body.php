<main class="page page--product">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Edytowanie kategorii "<?php echo s_model('category')['cat_name']; ?>"</h1>

  <?php
  $category = s_model('category');
  ?>
  <section class="product-edit">
    <h3 class="section__header">Szczegóły kategorii</h3>

    <form action="" method="POST">
      <input type="hidden" name="intent-edit-category" value="yes" />

      <div class="field">
        <label for="cat_name">Nazwa kategorii</label>
        <input type="text" id="cat_name" name="cat_name" placeholder="Nazwa kategorii" value="<?php echo $category['cat_name']; ?>" />
      </div>

      <div class="buttons">
        <button>Zapisz</button>
      </div>
    </form>
  </section>

  <section class="category-delete">
    <h3 class="section__header">Usuń kategorię</h3>

    <form action="" method="POST">
      <div class="buttons">
        <input type="hidden" name="intent-delete-category" value="yes" />
        <button>Usuń kategorię</button>
      </div>
    </form>
  </section>
</main>
