<?php
namespace Sklep;

/**
* Klasa zawierająca dane i funkcje pomocnicze nt. ogólnej strony oraz jej
* systemu zarządzania treścią.
**/
class ApiSiteController extends SiteController {

  public $config = [];

  /**
   * $conf - tablica asocjacyjna zawierająca konfigurację serwera
   */
  public function __construct($conf){
    parent::__construct($conf);

    $this->root_uri = ROOT_URI.'/api';

    $this->content_path = ROOT_PATH.'/api_content';
    $this->content_uri = ROOT_URI.'/api_content';
  }

  /**
   * Tworzy nowy obiekt Page, reprezentujący stronę, w odpowiedzi na podane
   * zapytanie.
   *
   * $req - Obiekt Request reprezentujący zapytanie na które strona ma odpowiedzieć
   */
  public function generate_page($req){
    $page_id = $req->get_page();

    // sprawdź czy w ogóle istnieje żądana strona. jeśli nie, chcemy 404
    if($page_id == null || !is_dir($this->get_page_path($page_id)))
      $page_id = '404';

    $page_dir_path = $this->get_page_path($page_id);
    return new ApiPage($this, $req, $page_dir_path);
  }

  /**
   * Zwraca ścieżkę wewnętrzną do podanego elementu podstrony (bez żadnej
   * gwarancji, że istnieje tam plik)
   *
   * $element - string zawierający nazwę żądanego elementu
   * $page_id - string zawierający nazwę podstrony
   */
  public function get_page_path($page_id){
    return $this->content_path."/{$page_id}";
  }

}
