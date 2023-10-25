<?php

/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit;
}

?>

<script>
	const products = document.querySelectorAll('.products')[0];
	
	function filterProducts(event) {
		event.preventDefault();

		const colorFilter = document.querySelector('#color_filter')
		const sizeFilter = document.querySelector('#size_filter')

		const query = {
			color: colorFilter.value,
			size: sizeFilter.value
		}
		console.log(query)
		jQuery.ajax({
			type: 'POST',
			url: '/argygestionable/wp-admin/admin-ajax.php',
			dataType: 'text',
			data: {
				action: 'filter_products',
				color: query.color,
				size: query.size
			},
			success: function(res) {
				jQuery('.products').html(res);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
</script>


<div class="vida-shop-filter-container">
	<form role="search" method="get" class="woocommerce-product-search vida-product-search" action="<?php echo esc_url(home_url('/')); ?>">
		<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"><?php esc_html_e('Search for:', 'woocommerce'); ?></label>
		<button type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>" class="vida-product-search-button <?php echo esc_attr(wc_wp_theme_get_element_class_name('button')); ?>">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M26.6871 26.7175L27.0659 27.0935H28.1554L35 33.9541L32.954 36L26.0957 29.1517V28.0649L25.717 27.689C24.1568 29.0254 22.1355 29.8377 19.9194 29.8377C14.9931 29.8377 11 25.8448 11 20.9189C11 15.9929 14.9931 12 19.9194 12C24.8456 12 28.8388 15.9929 28.8388 20.9189C28.8388 23.1349 28.025 25.1574 26.6871 26.7175ZM20 15C16.6853 15 14 17.6867 14 21C14 24.3147 16.6853 27 20 27C23.3133 27 26 24.3147 26 21C26 17.6867 23.3133 15 20 15Z" fill="#F3EFEC" />
			</svg></button>
		<input type="search" id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>" class="search-field vida-product-search-field" placeholder="<?php echo esc_attr__('Search products&hellip;', 'woocommerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<input type="hidden" name="post_type" value="product" />
	</form>
	<form onsubmit="filterProducts(event)">
		<select name="color" id="color_filter">
			<option value="all">All</option>
			<option value="blue">Blue</option>
			<option value="red">Red</option>
			<option value="grey">Grey</option>
			<option value="green">Green</option>
		</select>
		<select name="size" id="size_filter">
			<option value="all">All</option>
			<option value="small">Small</option>
			<option value="medium">Medium</option>
			<option value="large">Large</option>
		</select>
		<input type="submit" value="Find">
	</form>
</div>