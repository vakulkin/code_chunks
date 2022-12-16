<?php

add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments)
{
  ob_start();
  $items_count = intval(WC()->cart->get_cart_contents_count());
  echo "<span id=\"mini-cart-count\">($items_count)</span>";
  $fragments['#mini-cart-count'] = ob_get_clean();
  return $fragments;
}
