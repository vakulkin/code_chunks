<?php

function get_tax_prod($query)
{
	global $wpdb;

	$att_name = 'pa_sq-m';

	if (isset($_GET["[$att_name}_min"]) && isset($_GET["[$att_name}_max"]) && is_numeric($_GET["[$att_name}_min"]) && is_numeric($_GET["[$att_name}_max"])) {
		$terms_sqm = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT t.slug FROM {$wpdb->prefix}term_taxonomy tt
				JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
				WHERE tt.taxonomy LIKE 'pa_sq-m'
				AND t.slug * 1 BETWEEN %d AND %d",
				$_GET["[$att_name}_min"],
				$_GET["[$att_name}_max"]
			),
		);

		$query->set('posts_per_page', -1);
		$query->set('tax_query', array(
			'relation' => 'AND',
			array(
				'taxonomy' =>  $att_name,
				'field' => 'slug',
				'terms' =>  $terms_sqm,
				'operator' => 'IN',
			)
		));
	}
}

add_filter('pre_get_posts', 'get_tax_prod');
