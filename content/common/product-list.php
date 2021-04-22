<ul class="product-list">
<?php
foreach($products as $product){
  echo '<a class="incognito" href="'.s_page('/product/'.$product['product_id']).'">';
  echo '<li class="product-list__product'.($product['product_quantity'] <= 0 ? ' product-list__sold-out' : '').'">';

  echo '<img src="'.($product['product_thumbnail_src'] ?: $s_site->conf('default_thumbnail')).'" alt="obrazek" />';
  echo '<span class="product-name">'.$product['product_name'].'</span>';
  echo '<span class="product-price">'.s_price($product['product_price']).'</span>';

  echo '</li>';
  echo '</a>';
}
?>
</ul>
