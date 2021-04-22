<?php
namespace Sklep;

/**
* Klasa zawierająca dane i funkcje pomocnicze nt. jakiejś podstrony
**/
class Page {

  public $site = null;

  public $template_path = '';
  public $page_dir_path = '';

  public $title = '';
  public $model = [];
  public $notices = [];

  /**
   * $site - Obiekt Site reprezentujący stronę, będącą rodzicem tej podstrony
   * $page_id - ID żądanej podstrony
   */
  public function __construct($site, $page_dir_path, $template_path){
    $this->site = $site;
    $this->template_path = $template_path;
    $this->page_dir_path = $page_dir_path;
  }

  /**
   * Zdobądź tablicę ścieżek do plików, które należy zaincludować aby pokazać
   * tę stronę.
   */
  public function get_includes(){
    $includes = [];

    if($this->site->get_global_logic_path()) array_push($includes, $this->site->get_global_logic_path());

    array_push($includes, $this->get_logic_path());
    array_push($includes, $this->template_path);

    if(DEBUG && $this->site->get_debug_include_path()) array_push($includes, $this->site->get_debug_include_path());

    return $includes;
  }

  public function get_logic_path(){
    return $this->page_dir_path.'/logic.php';
  }

  public function get_head_path(){
    return $this->page_dir_path.'/head.php';
  }

  public function get_body_path(){
    return $this->page_dir_path.'/body.php';
  }

  /**
   * Ustawia model, lub jakąś wartość w modelu.
   *
   * $val1 - cały nowy model, lub klucz do ustawienia
   * $val2 - wartość klucza. tylko używane jeśli $val1 jest kluczem
   */
  public function set_model($val1, $val2 = null){
    if($val2 !== null){
      $this->model[$val1] = $val2;
    }else{
      $this->model = $val1;
    }
  }

  /**
   * Zwraca jakąś wartość z modelu, albo, jeśli w modelu podanej wartości
   * nie ma, może zwrócić wartość domyślną.
   *
   * $key - klucz do zdobycia z modelu
   * $default - opcjonalna wartość domyślna, gdyby podany klucz nie istniał
   */
  public function get_model($key = null, $default = null){
    if($key === null)
      return $this->model;
    else
      return (isset($this->model[$key]) ? $this->model[$key] : $default);
  }

  /**
   * Dodaj powiadomienie do powiadomień strony.
   *
   * $severity - string, 'error', 'warn' lub 'info'
   * $message - string, tekst powiadomienia
   */
  public function add_notice($severity, $message){
    array_push($this->notices, ['severity' => $severity, 'message' => $message]);
  }

}
