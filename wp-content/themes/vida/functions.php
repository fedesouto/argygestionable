<?php



function vida_enqueue_styles()
{
	$parenthandle = 'astra-style';
	$theme        = wp_get_theme();
	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get('Version')
	);
	wp_enqueue_style(
		'vida-style',
		get_stylesheet_uri(),
		array($parenthandle),
		$theme->get('Version') // This only works if you have Version defined in the style header.
	);
}

add_action('wp_enqueue_scripts', 'vida_enqueue_styles');

use Tribe\Events\Models\Post_Types\Event;

function vida_filter_events_by_attribute($post)
{
	//var_dump(get_object_vars($post));

	/*foreach(get_object_vars($post) as $prop){
		echo "<script>console.log('Event " . $prop. "' );</script>";
	}*/
	//$event = Event::from_post($post);
	//var_dump(get_object_vars($post));


	//echo "<script>console.log('Event " . $post->start_date. "' );</script>";
	//echo "<script>console.log('Event " . $post->venue. "' );</script>";
	/*echo "<script>console.log('category " . tribe_get_venue($post->ID). "' );</script>";
	if(tribe_event_in_category('retreat',$post->ID)){
		echo "<script>console.log('in retreat ' );</script>";
	}*/
	//echo "<script>console.log('Category " . get_the_category($post->ID). "' );</script>";
	//var_dump(get_the_category($post->ID));

	return $post;
}

add_filter('tribe_get_event', 'vida_filter_events_by_attribute');


/**
 * 
 * Shop functions.
 * 
 */


function vida_add_woocommerce_search_bar()
{
	wc_get_template_part('product', 'searchform');
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'vida_add_woocommerce_search_bar', 2);

function vida_add_single_product_description()
{
	get_template_part("template-parts/vida", "single-product-description");
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_after_single_product_summary', 'vida_add_single_product_description', 10);

function filter_products()
{
	$color = $_POST['color'];
	$size = $_POST['size'];

	$tax_query = [];

	if ($color !== "all") {
		$tax_query[] = array(
			'taxonomy' => 'pa_color',
			'field' => 'slug',
			'terms' => $color
		);
	}
	if ($size !== "all") {
		$tax_query[] = array(
			'taxonomy' => 'pa_size',
			'field' => 'slug',
			'terms' => $size
		);
	}

	$ajaxposts = new WP_Query([
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => $tax_query
	]);
	$response = '';

	if ($ajaxposts->have_posts()) {
		while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
			$response .= wc_get_template_part('content', 'product');
		endwhile;
	} else {
		$response = do_action('woocommerce_no_products_found');
	}
	echo $response;
	wp_reset_postdata();
	exit;
}
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

add_filter('loop_shop_per_page', 'vida_remove_pagination', 20);

function vida_remove_pagination($cols)
{
	$cols = 90;
	return $cols;
}

add_action( 'wp_enqueue_scripts', 'vida_frontpage_styles' );
function vida_frontpage_styles(){
  if( is_front_page() ){
     wp_enqueue_style( 'front-page-styles', get_stylesheet_directory_uri() . '/front-page.css', array(), false, 'screen' );
  }
}