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
	function filterProducts(event) {
		event.preventDefault();

		const colorFilter = document.querySelector('#color_filter')
		const sizeFilter = document.querySelector('#size_filter')

		const query = {
			color: colorFilter.value,
			size: sizeFilter.value
		}
		jQuery.ajax({
			type: 'POST',
			url: '/argygestionable/wp-admin/admin-ajax.php',
			dataType: 'text',
			data: {
				action: 'filter_products',
				color: query.color,
				size: query.size
			},
			beforeSend: function() {
				jQuery('.products').html('<div class="vida-loader"></div>')
			},
			success: function(res) {

				jQuery('.products').html(res);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}

	function resetFilters(event) {
		const colorFilter = document.querySelector('#color_filter')
		const sizeFilter = document.querySelector('#size_filter')
		event.preventDefault();
		colorFilter.value = "all";
		sizeFilter.value = "all";
		filterProducts(event);
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
	<form onsubmit="filterProducts(event)" onreset="resetFilters(event)" class="vida-product-filter-container">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.48 6.47 2 11.99 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 11.99 22C6.47 22 2 17.52 2 12ZM15.97 8H18.92C17.96 6.35 16.43 5.07 14.59 4.44C15.19 5.55 15.65 6.75 15.97 8ZM12 4.04C12.83 5.24 13.48 6.57 13.91 8H10.09C10.52 6.57 11.17 5.24 12 4.04ZM4 12C4 12.69 4.1 13.36 4.26 14H7.64C7.56 13.34 7.5 12.68 7.5 12C7.5 11.32 7.56 10.66 7.64 10H4.26C4.1 10.64 4 11.31 4 12ZM5.08 16H8.03C8.35 17.25 8.81 18.45 9.41 19.56C7.57 18.93 6.04 17.66 5.08 16ZM5.08 8H8.03C8.35 6.75 8.81 5.55 9.41 4.44C7.57 5.07 6.04 6.34 5.08 8ZM12 19.96C11.17 18.76 10.52 17.43 10.09 16H13.91C13.48 17.43 12.83 18.76 12 19.96ZM9.5 12C9.5 12.68 9.57 13.34 9.66 14H14.34C14.43 13.34 14.5 12.68 14.5 12C14.5 11.32 14.43 10.65 14.34 10H9.66C9.57 10.65 9.5 11.32 9.5 12ZM14.59 19.56C15.19 18.45 15.65 17.25 15.97 16H18.92C17.96 17.65 16.43 18.93 14.59 19.56ZM16.5 12C16.5 12.68 16.44 13.34 16.36 14H19.74C19.9 13.36 20 12.69 20 12C20 11.31 19.9 10.64 19.74 10H16.36C16.44 10.66 16.5 11.32 16.5 12Z" fill="#F3EFEC" />
		</svg>
		<select name="color" id="color_filter" class="vida-select-filter">
			<option value="all">All</option>
			<option value="blue">Blue</option>
			<option value="red">Red</option>
			<option value="grey">Grey</option>
			<option value="green">Green</option>
		</select>
		<label>Size:</label>
		<select name="size" id="size_filter" class="vida-select-filter">
			<option value="all">All</option>
			<option value="small">Small</option>
			<option value="medium">Medium</option>
			<option value="large">Large</option>
		</select>
		<input type="submit" value="Find" id="vida-shop-submitButton" class="vida-button-outline">
		<input type="reset" value="Reset" id="vida-shop-resetButton">
	</form>
</div>