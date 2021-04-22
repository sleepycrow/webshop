<?php
namespace Sklep;

/**
 * flagi
 */
abstract class ProdSelOpts {
  const INCLUDE_CATEGORY = 1;
  const ALL_IMGS = 2;
  const BRIEF = 4;
}

/**
 * Klasa zawierająca funkcje ułatwiające wykonywanie najczęstszych zapytań
 * do bazy danych związanych ze sklepem. <3
 */
abstract class ShopUtils{

  /**
   * zwraca listę kategorii.
   *
   * $link - obiekt typu MySQLi
   */
  public static function fetch_categories($link){
    $quer = $link->query('SELECT * FROM `'.TABLE_CATEGORIES.'`');
    if($quer == false){
      throw new \Exception($link->error);
      return [];
    }

    $results = [];
    while($row = $quer->fetch_assoc())
      array_push($results, $row);
    return $results;
  }

  public static function fetch_product_imgs($link, $product_id){
    $imgs = [];
    $quer = $link->query("SELECT * FROM `".TABLE_PRODUCTS_IMAGES."` WHERE `product_id`={$product_id}");
    if($quer == false) throw new \Exception("Nie udało się zdobyć obrazków dla produktu o ID {$product_id}!");
    while($row = $quer->fetch_assoc()) array_push($imgs, $row);
    return $imgs;
  }

  public static function fetch_products($link, $criteria = '', $flags = 0){
    $fields = "*";
    if($flags & ProdSelOpts::BRIEF)
      $fields = "`product_id`, `product_name`, `product_quantity`, `product_price`, `product_thumbnail_src`";

    $select = 'SELECT '.$fields.' FROM `'.TABLE_PRODUCTS.'` ';

    if($flags & ProdSelOpts::INCLUDE_CATEGORY)
      $select .= 'LEFT JOIN `'.TABLE_CATEGORIES.'` ON `'.TABLE_CATEGORIES.'`.`cat_id`=`'.TABLE_PRODUCTS.'`.`cat_id` ';

    $products = [];
    $quer = $link->query($select.$criteria);
    if($quer == false) throw new \Exception($link->error);
    while($row = $quer->fetch_assoc()) array_push($products, $row);

    if($flags & ProdSelOpts::ALL_IMGS){
      for($i = 0; $i < count($products); $i++){
        $products[$i]['imgs'] = ShopUtils::fetch_product_imgs($link, $products[$i]['product_id']);
      }
    }

    return $products;
  }

  public static function fetch_product($link, $criteria = '', $flags = 0){
    $products = ShopUtils::fetch_products($link, $criteria, $flags);

    if(count($products) >= 1){
      return $products[0];
    }else{
      return false;
    }
  }

}
