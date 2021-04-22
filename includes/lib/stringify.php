<?php
// Funkcja do zamieniania rzeczy PHP na kod PHP
function stringify($input, $fmt = false){
  $type = gettype($input);

  if($type == 'array'){
    $result = '[' . ($fmt?"\n":'');
    foreach($input as $key => $val){
      $result .= stringify($key, $fmt).' => '.stringify($val, $fmt).', ' . ($fmt?"\n":'');
    }
    $result .= "]";
    return $result;

  }elseif($type == 'boolean'){
    if($input === true) return 'true';
    else return 'false';

  }elseif($type == 'string'){
    $escaped_input = str_replace("'", "\'", $input);
    return "'{$escaped_input}'";

  }elseif($type == 'double' || $type == 'integer'){
    return strval($input);

  }else{
    return 'null';
  }
}
