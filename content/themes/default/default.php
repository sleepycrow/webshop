<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <style>
    body{
      margin-left: 250px;
    }

    body *{
      box-sizing: border-box;
    }

    a{
      color: blue;
      text-decoration: underline;
    }

    img{
      max-width: 100%;
    }

    main{
      padding: 8px;
    }

    aside{
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      max-height: 100vh;
      overflow: hidden auto;
      border-right: 1px solid #000;
      padding: 8px;
      background-color: #FFF;
    }

    .product-list__sold-out {
      opacity: 0.5;
    }

    .product-list__sold-out span {
      text-decoration: line-through !important;
    }

    .product-list__product img,
    .cart-table img{
      width: 96px;
    }

    .product-list *{
      margin-right: 4px;
    }

    .cart-table{
      width: 800px;
      border: 1px solid #000;
    }

    .cart-table td, .cart-table th{
      border: 1px solid #000;
    }

    .gallery-img{
      margin: 4px;
    }

    .gallery-img img{
      width: auto;
      height: 96px;
    }

    .notice{
      padding: 4px;
      margin: 4px;
      font-weight: bold;
      border: 1px solid #000;
    }
    </style>

    <?php include $s_page->get_head_path(); ?>

    <title><?php echo $s_page->title.' | '.s_sitename(); ?></title>
  </head>
  <body>
    <aside>
      <h1><a href="<?php e_page(); ?>"><?php e_sitename(); ?></a></h1>

      <hr>

      <h3>Kategorie</h3>
      <ul>
      <?php
        foreach($g_categories as $category)
          echo '<li><a href="'.s_page('/category/'.$category['cat_id']).'">'.$category['cat_name'].'</a></li>';
      ?>
      </ul>

      <h3>Szukaj</h3>
      <form class="search_form" action="<?php e_page('/search'); ?>" method="GET">
        <input type="text" name="q" placeholder="Szukaj..." value="<?php e_model('search_term', ''); ?>" />
        <button>&gt;</button>
      </form>

      <h3><?php echo (s_logged_in() ? "Witaj, {$_SESSION['user']['username']}!" : "Nie jesteś zalogowany"); ?></h3>
      <ul>
        <?php
        if(s_logged_in()){
          echo "<li><a href=".s_page('/user/').">Panel użytkownika</a></li>";
          echo "<li><a href=".s_page('/auth/logout').">Wyloguj się</a></li>";
        }else{
          echo "<li><a href=".s_page('/auth/').">Zaloguj/Zarejestruj się</a></li>";
        }
        ?>

      </ul>

      <h3>Inne</h3>
      <ul>
        <li><a href="<?php e_page('/cart/'); ?>">Koszyk</a></li>
      </ul>
    </aside>

    <?php include $s_page->get_body_path(); ?>
  </body>
</html>
