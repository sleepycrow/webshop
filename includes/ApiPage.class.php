<?php
namespace Sklep;

/**
* Klasa zawierająca dane i funkcje pomocnicze nt. jakiejś podstrony
**/
class ApiPage {

  public $site = null;
  private $req = null;

  public $page_dir_path = '';

  /**
   * $site - Obiekt Site reprezentujący stronę, będącą rodzicem tej podstrony
   * $page_id - ID żądanej podstrony
   */
  public function __construct($site, $req, $page_dir_path){
    $this->site = $site;
    $this->req = $req;
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

    return $includes;
  }

  public function get_logic_path(){
    return $this->page_dir_path.'/logic.php';
  }

}
