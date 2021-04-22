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

    form input,
    form textarea,
    form button {
      display: block;
    }

    label{
      display: block;
      font-size: 0.9rem;
    }

    .prodimg_preview,
    .product_thumbnail_preview img{
      width: 128px;
      height: auto;
    }
    </style>

    <?php include $s_page->get_head_path(); ?>

    <title><?php echo $s_page->title.' | '.s_sitename(); ?></title>
  </head>
  <body>
    <aside>
      <h1><a href="<?php e_page(); ?>"><?php e_sitename(); ?></a></h1>
      <h3>Panel administratora</h3>

      <hr>

      <ul>
        <li><a href="<?php e_page('/overview/'); ?>">Podsumowanie</a></li>
        <li><a href="<?php e_page('/config/'); ?>">Konfiguracja</a></li>
        <li><a href="<?php e_page('/products/'); ?>">Produkty</a></li>
        <li><a href="<?php e_page('/categories/'); ?>">Kategorie</a></li>
        <li><a href="<?php e_page('/users/'); ?>">Użytkownicy</a></li>
        <li><a href="<?php e_page('/orders/'); ?>">Zamówienia</a></li>
      </ul>
    </aside>

    <main>
      <?php include $s_page->get_body_path(); ?>
    </main>
  </body>
</html>
