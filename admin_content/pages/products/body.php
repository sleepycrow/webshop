<main class="page page-products">
  <h1 class="main__header">Produkty</h1>

  <section class="page-products__criteria">
    <h3 class="section__header">Utwórz nowy</h3>

    <form action="" method="POST">
      <div class="buttons">
        <button name="intent-add-product">Utwórz nowy produkt</button>
      </div>
    </form>
  </section>

  <section class="page-products__criteria">
    <h3 class="section__header">Filtruj</h3>

    <form action="" method="GET">
      <div class="field">
        <label for="cat_id">Kategoria</label>
        <select id="cat_id" name="cat_id">
          <option value="">---</option>
          <?php
            foreach(s_model('categories') as $category){
              echo "<option value='{$category['cat_id']}'".(s_model('cat_id') == $category['cat_id'] ? ' selected' : '').">{$category['cat_name']}</option>";
            }
          ?>
        </select>
      </div>

      <div class="field">
        <label for="q">Wyszukiwanie</label>
        <input type="text" id="q" name="q" placeholder="Szukaj..." value="<?php echo s_model('search_term'); ?>" />
      </div>

      <div class="buttons">
        <button>Szukaj</button>
      </div>
    </form>
  </section>

  <section class="page-products__results">
    <h3 class="section__header">Produkty</h3>

    <table class="prod-table">
      <tr>
        <th class="prod-table__img-col">Obrazek</th>
        <th class="prod-table__name-col">Nazwa</th>
        <th class="prod-table__category-col">Kategoria</th>
        <th class="prod-table__quantity-col">Ilość dostępnych sztuk</th>
        <th class="prod-table__price-col">Cena</th>
      </tr>

      <?php
        foreach(s_model('products') as $product){
          echo '<tr>';

          echo '<td class="prod-table__img-col"> <img src="'.($product["product_thumbnail_src"] ?: $s_site->conf('default_thumbnail')).'" alt="obrazek lol" /> </td>';
          echo '<td class="prod-table__name-col"> <a href="'.s_page('/edit-product/'.$product["product_id"]).'">'.$product["product_name"].'</a> </td>';
          echo '<td class="prod-table__category-col"> <a href="'.s_page('/products/?cat_id='.$product["cat_id"]).'">'.$product["cat_name"].'</a> </td>';
          echo '<td class="prod-table__quantity-col"> '.$product["product_quantity"].'</a> </td>';
          echo '<td class="prod-table__price-col"> '.s_price($product["product_price"]).' </td>';

          echo '</tr>';
        }
      ?>
    </table>
  </section>
</main>
