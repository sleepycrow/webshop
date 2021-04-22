<nav class="headernav">
  <div class="headernav__row headernav__row--flex">
    <div class="flex-filler"></div>
    <header class="headernav__logo">
      <a href="<?php e_page(); ?>"><?php e_sitename(); ?></a>
    </header>
    <div class="headernav__links">
      <a href="<?php e_page('/cart/'); ?>">
        <span class="material-icons">shopping_bag</span>
        <?php if(count($_SESSION['cart']) > 0) echo '<sup class="shopping-cart-counter">'.count($_SESSION['cart']).'</sup>'; ?>
      </a>
      <a href="<?php echo (s_logged_in() ? e_page('/user/') : e_page('/auth/')); ?>">
        <span class="material-icons">person</span>
      </a>
    </div>
  </div>

  <div class="headernav__row headernav__row--flex">
    <div class="flex-filler"></div>
    <div class="headernav__search">
      <form action="<?php e_page('/search'); ?>" method="GET">
        <input type="text" name="q" placeholder="Szukaj..." value="<?php e_model('search_term', ''); ?>" autocomplete="off" onkeydown="hs.keydown(this, 'hotsearch')" />
        <button><span class="material-icons">search</span></button>
      </form>

      <ul class="search__hotsearch" id="hotsearch" style="display: none;"></ul>
    </div>
    <div class="flex-filler"></div>
  </div>

  <ul class="headernav__row headernav__navrow">
    <?php
      for($i = 0; $i < count($g_categories); $i++){
        echo '<a href="'.s_page('/category/'.$g_categories[$i]['cat_id']).'"><li>'.$g_categories[$i]['cat_name'].'</li></a>';
      }
    ?>
  </ul>
</nav>
