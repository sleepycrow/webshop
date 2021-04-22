<?php
namespace Sklep;

/**
* Klasa zawierająca dane i funkcje pomocnicze nt. ogólnej strony oraz jej
* systemu zarządzania treścią.
**/
class AdminSiteController extends SiteController {

  /**
   * $conf - tablica asocjacyjna zawierająca konfigurację serwera
   */
  public function __construct($conf){
    parent::__construct($conf);

    $this->root_uri = ROOT_URI.'/admin';

    $this->content_path = ROOT_PATH.'/admin_content';
    $this->child_site_content_path = ROOT_PATH.'/content';
    $this->content_uri = ROOT_URI.'/admin_content';

    $this->theme_path = $this->content_path.'/themes/'.$this->config['admin_theme'];
    $this->theme_uri = $this->content_uri.'/themes/'.$this->config['admin_theme'];

    $this->default_page_id = $this->config['admin_default_page'];
  }

  /**
   * Zwraca ścieżkę wewnętrzną do dodatków do debugowania.
   */
  public function get_debug_include_path(){
    return ROOT_PATH.'/content/debug.php';
  }

}
