<?php
namespace Sklep;

/**
* Klasa zawierająca dane i funkcje pomocnicze nt. ogólnej strony oraz jej
* systemu zarządzania treścią.
**/
class SiteController {

  public $config = [];

  /**
   * $conf - tablica asocjacyjna zawierająca konfigurację serwera
   */
  public function __construct($conf){
    $this->config = $conf;

    $this->root_uri = ROOT_URI;

    $this->content_path = ROOT_PATH.'/content';
    $this->content_uri = ROOT_URI.'/content';

    $this->theme_path = $this->content_path.'/themes/'.$this->config['theme'];
    $this->theme_uri = $this->content_uri.'/themes/'.$this->config['theme'];

    $this->default_page_id = $this->config['default_page'];
  }

  /**
   * Łączy z bazą danych ustawioną w konfiguracji strony. Zwraca obiekt
   * MySQLi lub FALSE, w zależności od tego, czy udało się połączyć.
   */
  public function connect_db(){
    $conf = $this->config;
    $sql = @new \MySQLi($conf['db_address'], $conf['db_username'], $conf['db_password'], $conf['db_database']);
    if($sql == false || $sql->connect_error) return false;
    if($sql->set_charset("utf8") == false) return false;
    return $sql;
  }

  /**
   * Zwraca pojedynczą wartość z konfiguracji.
   *
   * $key - string będący kluczem, dla którego wartość chcemy otrzymać
   */
  public function conf($key, $default = null){
    return (isset($this->config[$key])) ? $this->config[$key] : $default;
  }

  /**
   * Tworzy nowy obiekt Page, reprezentujący stronę, w odpowiedzi na podane
   * zapytanie.
   *
   * $req - Obiekt Request reprezentujący zapytanie na które strona ma odpowiedzieć
   */
  public function generate_page($req){
    $page_id = $req->get_page($this->default_page_id);

    // sprawdź czy w ogóle istnieje żądana strona. jeśli nie, chcemy 404
    if(!is_dir($this->get_page_path($page_id)))
      $page_id = $this->conf('err_404_page');

    // znajdź odpowiednie elementy dla generowanej strony
    $page_dir_path = $this->get_page_path($page_id);
    $template_path = $this->get_template_path($page_id);

    return new Page($this, $page_dir_path, $template_path);
  }

  /**
   * Zwraca ścieżkę wewnętrzną do podanego elementu podstrony (bez żadnej
   * gwarancji, że istnieje tam plik)
   *
   * $element - string zawierający nazwę żądanego elementu
   * $page_id - string zawierający nazwę podstrony
   */
  public function get_page_path($page_id){
    return $this->content_path."/pages/{$page_id}";
  }

  /**
   * Zwraca ścieżkę wewnętrzną do odpowiedniego dla danej podstrony
   * szablonu stronu, z aktualnie ustawionego w konfiguracji strony tematu
   * graficznego.
   *
   * $page_id - string zawierający id żądanego widoku
   */
  public function get_template_path($page_id){
    if(file_exists($this->theme_path."/{$page_id}.php"))
      return $this->theme_path."/{$page_id}.php";
    else
      return $this->theme_path.'/default.php';
  }

  /**
   * Zwraca ścieżkę wewnętrzną do odpowiedniego dla danej podstrony
   * szablonu stronu, z aktualnie ustawionego w konfiguracji strony tematu
   * graficznego.
   *
   * $view_id - string zawierający id żądanego widoku
   */
  public function get_common_path($path){
    if(file_exists($this->theme_path.'/common'.$path))
      return $this->theme_path.'/common'.$path;
    else
      return $this->content_path.'/common'.$path;
  }

  /**
   * Zwraca ścieżkę wewnętrzną do logiki globalnej.
   */
  public function get_global_logic_path(){
    return $this->content_path.'/global_logic.php';
  }

  /**
   * Zwraca ścieżkę wewnętrzną do dodatków do debugowania.
   */
  public function get_debug_include_path(){
    return $this->content_path.'/debug.php';
  }

}
