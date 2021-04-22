<?php
/**
 * Kilka funkcji pomocniczych, aby łatwiej było pisać szablony xd
 **/

function s_get($thing = 'site'){
  global $s_site, $s_req, $s_page;

  switch($thing){
    case 'site': return $s_site;
    case 'req': return $s_req;
    case 'page': return $s_page;
  }
}

function s_theme_uri($path = ''){
  global $s_site;
  return $s_site->theme_uri.$path;
}

function s_theme_path($path = ''){
  global $s_site;
  return $s_site->theme_path.$path;
}

function s_common_path($path = ''){
  global $s_site;
  return $s_site->get_common_path($path);
}

function s_page($path = '/'){
  global $s_site;
  return $s_site->root_uri.$path;
}

function s_model($key = null, $default = null){
  global $s_page;
  return $s_page->get_model($key, $default);
}

function s_sitename(){
  global $s_conf;
  return $s_conf['sitename'];
}

function s_price($number, $include_currency = true){
  global $s_conf;
  return sprintf($s_conf['currency_format'], number_format($number, 2, $s_conf['currency_decimal_separator'], $s_conf['currency_thousand_separator']));
}

function s_logged_in(){
  return isset($_SESSION['user']);
}

function e_404(){
  global $s_conf;
  http_response_code(404);
  header('Location:'.s_page('/'.$s_conf['err_404_page']));
  die(404);
}

function e_page($path = '/'){
  echo s_page($path);
}

function e_theme_uri($path = ''){
  echo s_theme_uri($path);
}

function e_sitename(){
  echo s_sitename();
}

function e_model($key = null, $default = null){
  echo s_model($key, $default);
}

function e_price($number, $include_currency = true){
  print s_price($number, $include_currency);
}
