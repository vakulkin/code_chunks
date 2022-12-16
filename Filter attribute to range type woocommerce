function get_tax_prod( $query ) {
	global $wpdb;
	
	if(isset($_GET['pa_sq_min' ]) && isset( $_GET[ 'pa_sq_max' ]) && is_numeric($_GET['pa_sq_min' ]) && is_numeric( $_GET[ 'pa_sq_max' ])) {

		$terms_sqm = $wpdb->get_col(
			$wpdb->prepare("SELECT t.slug FROM {$wpdb->prefix}term_taxonomy tt
				JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
				WHERE tt.taxonomy LIKE 'pa_sq-m'
				AND t.slug * 1 BETWEEN %d AND %d",
				$_GET['pa_sq_min'], $_GET['pa_sq_max']
			),			
		);

		$query->set( 'posts_per_page', -1);
		$query->set( 'tax_query', array(
		'relation'    => 'AND',
				array(
				'taxonomy'   =>  'pa_sq-m',
				'field'		=> 'slug',
				'terms'     =>  $terms_sqm,
				'operator'   => 'IN',
			)
		) );
	  
	}


		
}
add_filter( 'pre_get_posts', 'get_tax_prod');
