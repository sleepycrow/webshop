<?php
// usuń HTML z opisu
$safe_desc = s_model('product_description');
$safe_desc = preg_replace("/<[^>]+>/", "", $safe_desc);
$safe_desc = str_replace("\"", "\\\"", $safe_desc);

echo '<meta name="description" content="'.$safe_desc.'">'."\n";
echo '<meta property="og:description" content="'.$safe_desc.'">'."\n";
echo '<meta property="twitter:description" content="'.$safe_desc.'">'."\n";

if(s_model('product_thumbnail_src')){
  echo '<meta property="og:image" content="'.s_model('product_thumbnail_src').'">'."\n";
  echo '<meta property="twitter:image" content="'.s_model('product_thumbnail_src').'">'."\n";
}

$s_page->title = s_model('product_name');
