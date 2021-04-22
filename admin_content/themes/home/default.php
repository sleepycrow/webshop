<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="<?php e_theme_uri('/resx/css.css'); ?>">
    <script src="<?php e_theme_uri('/resx/textareas.js'); ?>"></script>

    <?php include $s_page->get_head_path(); ?>

    <title><?php echo $s_page->title; ?> • <?php e_sitename(); ?></title>
  </head>
  <body>
    <aside class="sidebar">
      <header>
        <h1><?php e_sitename(); ?></h1>
      </header>

      <nav>
        <ul>
          <li><a href="<?php e_page('/overview/'); ?>">
            <span class="nav__icon material-icons">home</span>
			      <span class="nav__label">Podsumowanie</span>
          </a></li>

          <li><a href="<?php e_page('/products/'); ?>">
            <span class="nav__icon material-icons">shopping_bag</span>
      	    <span class="nav__label">Produkty</span>
      	  </a></li>

          <li><a href="<?php e_page('/categories/'); ?>">
            <span class="nav__icon material-icons">category</span>
      	    <span class="nav__label">Kategorie</span>
      	  </a></li>

          <li><a href="<?php e_page('/users/'); ?>">
            <span class="nav__icon material-icons">people</span>
      	    <span class="nav__label">Użytkownicy</span>
      	  </a></li>

          <li><a href="<?php e_page('/orders/'); ?>">
            <span class="nav__icon material-icons">receipt</span>
      	    <span class="nav__label">Zamówienia</span>
      	  </a></li>

          <li><a href="<?php e_page('/config/'); ?>">
            <span class="nav__icon material-icons">settings</span>
            <span class="nav__label">Konfiguracja</span>
          </a></li>
        </ul>
      </nav>
    </aside>

    <?php include $s_page->get_body_path(); ?>
  </body>
</html>
