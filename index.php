<?php
/**
 * turbosklepik 2000 super pro edition 2025(tm)
 * (c) danio space enterprises limited 2020
 **/

$root_uri = dirname($_SERVER['PHP_SELF']);
if($root_uri == "/") $root_uri = "";

define('ROOT_PATH', __DIR__);
define('ROOT_URI', $root_uri);

include_once 'includes/config.php';
include_once 'includes/init.php';
include_once 'includes/utils.php';

// Utwórz obiekt reprezentujący zapytanie, aby je przeanalizować
$s_req = new \Sklep\Request(['admin', 'api']);

// Utwórz odpowiedni kontroler strony
if($s_req->mode == 'admin')
  $s_site = new \Sklep\AdminSiteController($s_conf);
elseif($s_req->mode == 'api')
  $s_site = new \Sklep\ApiSiteController($s_conf);
else
  $s_site = new \Sklep\SiteController($s_conf);

// Poproś kontroler strony w wygenerowanie podstrony w odpowiedzi na zapytanie
$s_page = $s_site->generate_page($s_req);

// Połącz się z bazą danych
$s_db = $s_site->connect_db() or die("Nie udało się połączyć z bazą danych.");

// Załaduj wszystkie elementy wygenerowanej podstrony
foreach($s_page->get_includes() as $include){
  require $include;
}

// rozłącz się od bazy danych :)
$s_db->close();
