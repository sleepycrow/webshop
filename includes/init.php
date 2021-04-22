<?php
// Zdefiniuj stałe
define('DEBUG', $s_conf['debug_mode']);

define('TABLE_PREFIX', $s_conf['table_prefix']);
define('TABLE_USERS', TABLE_PREFIX.'users');
define('TABLE_CATEGORIES', TABLE_PREFIX.'categories');
define('TABLE_PRODUCTS', TABLE_PREFIX.'products');
define('TABLE_PRODUCTS_IMAGES', TABLE_PREFIX.'products_images');
define('TABLE_ORDERS', TABLE_PREFIX.'orders');
define('TABLE_ORDERS_PRODUCTS', TABLE_PREFIX.'orders_products');
define('TABLE_DELIVERY_METHODS', TABLE_PREFIX.'delivery_methods'); //TODO: OPT: Dodaj system zarządzania metodami dostawy
define('TABLE_PAYMENT_PROVIDERS', TABLE_PREFIX.'payment_providers'); //TODO: OPT: Dodaj system zarządzania metodami płatności
define('TABLE_COUPONS', TABLE_PREFIX.'coupons'); //TODO: OPT: Dodaj system kuponów

// Zaimportuj rdzenne części aplikacji
require_once ROOT_PATH.'/includes/Page.class.php';
require_once ROOT_PATH.'/includes/ApiPage.class.php';
require_once ROOT_PATH.'/includes/SiteController.class.php';
require_once ROOT_PATH.'/includes/AdminSiteController.class.php';
require_once ROOT_PATH.'/includes/ApiSiteController.class.php';
require_once ROOT_PATH.'/includes/Request.class.php';
require_once ROOT_PATH.'/includes/ShopUtils.class.php';
