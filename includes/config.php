<?php $s_conf = [

// Te trzeba wypełnić przed deployem
'db_address' => 'localhost', 
'db_username' => 'root', 
'db_password' => 'root', 
'db_database' => '', 
'table_prefix' => '', // Wordpressowy prefix do tabel
'debug_mode' => false, 

// O te już raczej nie trzeba się martwić
'theme' => 'classy', 
'admin_theme' => 'home', 
'default_page' => 'index', 
'admin_default_page' => 'overview', 
'err_404_page' => '404', 
'sitename' => 'My store', 
'products_per_page' => '20', 
'currency_format' => '%s zł', 
'currency_decimal_separator' => ',', 
'currency_thousand_separator' => ' ', 
'pay_order_message' => '<p>Wyślij przelew w wysokości <strong>{total}</strong> o opisie <strong>"Zamówienie {order_id}"</strong> na numer konta <strong>PL69 1234 6666 1233 4353 2134 1234.</strong><br>Księgowanie jest wykonywane ręcznie i może potrwać około 24 godzin.</p>', 
'default_thumbnail' => 'http://127.0.0.1/possos/PEFECTLY_GENERIC_OBJECT.webp', 
];