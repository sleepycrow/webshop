<?php
namespace Sklep;

/**
* Odzwierciedlenie aktualnego zapytania.
**/
class Request {

  public $req_path = null;
  public $mode = null;
  public $page = null;
  public $args = [];
  public $method = "GET";

  public function __construct($recognized_modes){
    // zapisz metodę zapytania
    $this->method = $_SERVER['REQUEST_METHOD'];

    // Ustal ścieżkę zapytania, licząc od katalogu, w którym zainstalowany jest sklep
    $regex = "/^" . str_replace("/", "\/", ROOT_URI) . "\//";
    $req_path = $_SERVER['REQUEST_URI'];
    $req_path = preg_replace($regex, '', $req_path);
    $req_path = preg_replace('/(#|\?)([^~]+)/', '', $req_path);
    $this->req_path = $req_path;

    // Ustal kilka rzeczy o zapytaniu
    $args = explode('/', $req_path);

    // jeżeli pierwszą rzeczą w żądanej ścieżce jest /admin/, to użytkownik chce tryb admina
    if(count($args) > 0 && in_array($args[0], $recognized_modes)){
      $this->mode = $args[0];
      array_shift($args);
    }

    // pierwsza rzecz w żądanej ścieżce (lub pierwsza po nazwie trybu) to żądana podstrona
    if(count($args) > 0){
      $this->page = array_shift($args);
    }

    $this->args = $args;
  }

  /**
   * Zwraca stronę w adresie. Alternatywnie, opcjonalnie jeśli adres nie ma
   * strony, zwraca wartość domyślną.
   *
   * $default - opcjonalna wartość domyślna, gdyby nie było strony
   */
  public function get_page($default = null){
    return ($this->page != null ? $this->page : $default);
  }

  /**
   * Zwraca podany z kolei argument (czyli wszystko po id strony w adresie),
   * lub, opcjonalnie, jeśli ten nie istnieje, domyślną wartość.
   *
   * $id - int, ID argumentu z kolei
   * $default - opcjonalna wartość domyślna, gdyby podany argument nie istniał
   */
  public function get_arg($id, $default = null){
    if(isset($this->args[$id]) && !empty($this->args[$id]))
      return $this->args[$id];
    else
      return $default;
  }

}
