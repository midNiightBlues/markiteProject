<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package markite
 */

    if (!defined('MARKITE_WOOCOMMERCE_ACTIVED')) {
    	$_shop_id = wc_get_page_id('shop');
    	if ( is_product() || is_shop($_shop_id) ){
        do_action('markite_shop_form');   
        }  
    }

    do_action('markite_footer_style');  
    wp_footer(); ?>
    </body>
</html>
