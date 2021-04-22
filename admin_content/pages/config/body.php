<main class="page page--config">
  <?php
  $notices = $s_page->notices;
  include s_common_path('/notice-list.php');
  ?>

  <h1 class="main__header">Konfiguracja sklepu</h1>

  <section class="site-config">
    <form action="" method="POST">
      <input type="hidden" name="intent-edit-config" value="yesss" />

      <h3 class="section__header">Wygląd sklepu</h3>

      <div class="field">
        <label for="sitename">Nazwa sklepu</label>
        <input type="text" id="sitename" name="sitename" placeholder="Nazwa sklepu" value="<?php echo $s_site->conf('sitename'); ?>" />
      </div>

      <div class="field">
        <label for="products_per_page">Ilość produktów na stronę</label>
        <input type="number" id="products_per_page" name="products_per_page" value="<?php echo $s_site->conf('products_per_page'); ?>" />
      </div>

      <div class="field">
        <label for="theme">Temat graficzny</label>
        <select id="theme" name="theme">
        <?php
          foreach(s_model('themes') as $theme){
            echo "<option value='{$theme}'".($s_site->conf('theme') == $theme ? ' selected' : '').">{$theme}</option>";
          }
        ?>
        </select>
      </div>

      <div class="field">
        <label for="currency_format">Format wyświetlania waluty</label>
        <input type="text" id="currency_format" name="currency_format" placeholder="%s zł" value="<?php echo $s_site->conf('currency_format'); ?>" />
      </div>

      <div class="field">
        <label for="currency_decimal_separator">Oddzielacz miejsc po przecinku w walucie</label>
        <input type="text" id="currency_decimal_separator" name="currency_decimal_separator" placeholder="," value="<?php echo $s_site->conf('currency_decimal_separator'); ?>" />
      </div>

      <div class="field">
        <label for="currency_thousand_separator">Oddzielacz tysięcy w walucie</label>
        <input type="text" id="currency_thousand_separator" name="currency_thousand_separator" placeholder=" " value="<?php echo $s_site->conf('currency_thousand_separator'); ?>" />
      </div>

      <div class="field">
        <label for="default_thumbnail">Domyślna miniaturka produktu</label>
        <input type="text" id="default_thumbnail" name="default_thumbnail" placeholder=" " value="<?php echo $s_site->conf('default_thumbnail'); ?>" />
      </div>

      <div class="field">
        <label for="pay_order_message">Instrukcja opłacenia zamówienie</label>
        <textarea id="pay_order_message" name="pay_order_message"><?php echo $s_site->conf('pay_order_message'); ?></textarea>
      </div>

      <!-- ---------------------- -->

      <div class="buttons">
        <button>Zapisz</button>
      </div>
    </form>
  </section>
</main>
