<?php 
	 add_action( 'wp_enqueue_scripts', 'ecommerce_argy_enqueue_styles' );
	 function ecommerce_argy_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 
		   



		  function add_attributes() {
			global $product;
			$color = $product->get_attribute( 'pa_color' );
			$size = $product->get_attribute( 'pa_size' );
			echo '<p>' . $color . ' | '. $size .'</p>';
		  }


		   add_action('woocommerce_after_shop_loop_item_title', 'add_attributes', 15);


		   function filter_products() {
			$color = $_POST['color'];
		  
			$ajaxposts = new WP_Query([
			  'post_type' => 'product',
			  'posts_per_page' => -1,
			  'tax_query' => [
				[
					'taxonomy' => 'pa_color',
					'field' => 'slug',
					'terms' => $color
				]
			  ]
			]);
			$response = '';
		  
			if($ajaxposts->have_posts()) {
			  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
				$response .= wc_get_template_part('content', 'product');
			  endwhile;
			} else {
			  $response = 'empty';
			}
			echo $response;
			wp_reset_postdata();
			exit;
		  }
		  add_action('wp_ajax_filter_products', 'filter_products');
		  add_action('wp_ajax_nopriv_filter_products', 'filter_products');

		  function add_color_filter() {
			get_template_part('template-parts/content', 'filter');
		  }
 
		  add_action('woocommerce_before_shop_loop', 'add_color_filter', 40);
 ?>