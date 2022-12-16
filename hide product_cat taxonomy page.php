<?php

function hide_product_cat_taxonomy_page($array)
{
    $array['public'] = false;
    $array['show_ui'] = true;
    return $array;
}

add_filter('woocommerce_taxonomy_args_product_cat', 'hide_product_cat_taxonomy_page');
