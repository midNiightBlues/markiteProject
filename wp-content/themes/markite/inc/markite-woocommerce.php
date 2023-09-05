<?php
/**
 * [markite_remove_hook description]
 * @return [type] [description]
 */
function markite_remove_hook() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	add_action( 'markite_before_shop_loop_item_thumb', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	add_action( 'woocommerce_sidebar', 'markite_woocommerce_get_sidebar', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'markite_related_products', 'woocommerce_output_related_products', 20 );

	add_action( 'woocommerce_mid_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'markite_woocommerce_product_action_cart', 'markite_product_cart_button', 5 );
	add_action( 'markite_woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'markite_woocommerce_template_loop_price', 10 );


	add_action( 'woocommerce_before_shop_loop', 'markite_product_tab', 30 );
	add_action( 'markite_woocommerce_after_shop_loop_item', 'markite_list_product_cart_button', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'markite_woocommerce_short_desc', 'markite_woocommerce_short_desc_content', 40 );
	add_action( 'woocommerce_single_product_summary', 'markite_pro_details_profile', 5 );
	add_action( 'woocommerce_single_product_summary', 'markite_pro_details_info', 20 );
	add_action( 'woocommerce_single_product_summary', 'markite_pro_details_live_preview', 40 );
	add_action( 'markite_pro_details_sidebar_banner', 'markite_pro_details_banner', 40 );

	remove_action( 'woocommerce_product_tabs', 'dokan_set_more_from_seller_tab', 10 );
    remove_action('woocommerce_product_tabs', 'dokan_seller_product_tab');
	
}

markite_remove_hook();

add_filter( 'woocommerce_show_page_title', function () {
	return false;
} );


/**
 * Single Product
 */

if ( ! function_exists( 'markite_quick_view_images' ) ) {

	/**
	 * Output the product image before the single product summary.
	 */
	function markite_quick_view_images() { ?>
        <div class="bdevs-quick-view-images">
			<?php wc_get_template( 'single-product/product-image.php' );
			?>
        </div>
		<?php
	}
}


/**
 * [markite_product_title description]
 * @return [type] [description]
 */
function markite_product_title() {
	echo '<h3 class="product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
}

/**
 * [markite_product_cart_button description]
 * @return [type] [description]
 */
function markite_product_cart_button() {
	global $product;

	$product_action_switch = get_theme_mod('product_action_switch', false);
	$product_cart_btn_switch = get_theme_mod('product_cart_btn_switch', false);
    $markite_demo_url = function_exists('get_field') ? get_field('markite_demo_url') : '';
    $markite_demo_button = function_exists('get_field') ? get_field('markite_demo_button') : '';

	$class      = 'product_type_' . $product->get_type() . ' add_to_cart_button ' . ( $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart p-btn-white' : 'p-btn-white' );
	$attributes = array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'aria-label'       => $product->add_to_cart_description(),
		'rel'              => 'nofollow',
	);

	if (!empty($product_action_switch)) {
	print '<div class="product-action-box">';
	print '<div class="d-block-block position-relative">';
	print '<a ' . http_build_query( $attributes, ' ', ' ' ) . ' class="' . $class . '" href="' . $product->add_to_cart_url() . '">'.esc_html__('buy now','markite').'</a>';
	print '</div>';
	if (!empty($markite_demo_url)) {
	print '<a href="'.esc_url($markite_demo_url).'" target="_blank"  class="p-btn-border"> '. esc_html($markite_demo_button).'</a>';
	}
	// print markite_quick_view_button( $product->get_id() );
	// print markite_vc_yith_wishlist();
	print '</div>';
	}
}

/**
 * [markite_list_product_cart_button description]
 * @return [type] [description]
 */
function markite_list_product_cart_button() {
	global $product;
	$class      = 'product_type_' . $product->get_type() . ' add_to_cart_button ' . ( $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' );
	$attributes = array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'aria-label'       => $product->add_to_cart_description(),
		'rel'              => 'nofollow',
	);
	print '<div class="product-action">';
	print '<a ' . http_build_query( $attributes, ' ', ' ' ) . ' class="' . $class . '" href="' . $product->add_to_cart_url() . '"><i class="fal fa-cart-arrow-down"></i></a>';
	print markite_quick_view_button( $product->get_id() );
	print markite_vc_yith_wishlist();
	print '</div>';
}

/**
 * [markite_woo_rating description]
 * @return [type] [description]
 */


function markite_woo_rating() {
	global $product;
	$rating = $product->get_average_rating();
	$review = 'Rating ' . $rating . ' out of 5';
	$html   = '';
	$html   .= '<div class="details-rating mb-10" title="' . $review . '">';
	for ( $i = 0; $i <= 4; $i ++ ) {
		if ( $i < floor( $rating ) ) {
			$html .= '<a href="#" class="active"><i class="fas fa-star"></i></a>';
		} else {
			$html .= '<a href="#"><i class="far fa-star"></i></a>';
		}
	}
	$html .= '<span>( ' . $rating . ' out of 5 )</span>';
	$html .= '</div>';
	print markite_woo_rating_html( $html );
}

function markite_woo_rating_html( $html ) {
	return $html;
}

/**
 * [markite_woo_rating description]
 * @return [type] [description]
 */
function markite_woo_shop_rating() {
	global $product;
	$rating = $product->get_average_rating();
	$review = esc_html( 'Rating ' . $rating . ' out of 5' );
	ob_start(); ?>
    <div class="rating mb-10" title="<?php print esc_attr( $review ); ?>">
		<?php
		for ( $i = 0; $i <= 4; $i ++ ) {
			if ( $i < floor( $rating ) ) { ?>
                <a href="#"><i class="fas fa-star"></i></a>
				<?php
			} else { ?>
                <a href="#"><i class="far fa-star"></i></a>
				<?php
			}
		}
		?>
    </div>
	<?php
	return ob_get_clean();
}

// shop page price
function markite_get_price() {
	$markite_free_price = get_theme_mod('markite_free_price', 'Free');
	global $product;
	ob_start(); ?>
		<div class="product__price">
			<?php if (empty( $product->get_price() ) || $product->get_price() == 0 ) : ?>
            <span><?php print esc_html($markite_free_price); ?></span>
        	<?php else : ?>
            <span><?php print markite_get_price_html(); ?> </span>
        	<?php endif; ?>
        </div>
	<?php
	return ob_get_clean();
}

function markite_get_price_html() {
	global $product;
	return $product->get_price_html();
}

// single product price
function markite_single_get_price() {
	$markite_free_price = get_theme_mod('markite_free_price', 'Free');
	global $product;
	ob_start(); ?>
		<?php if (empty( $product->get_price() ) || $product->get_price() == 0 ) : ?>
		<span><?php print esc_html($markite_free_price); ?></span>
        <?php else : ?>  
        <span class="d-flex align-items-start sss"><?php print markite_single_get_price_html(); ?></span>
        <?php endif; ?>

	<?php
	return ob_get_clean();
}

function markite_single_get_price_html() {
	global $product;
	return $product->get_price_html();
}


// markite_get_cat_html
function markite_get_cat_html() {

    global $post;
    $args = array( 'taxonomy' => 'product_cat',);
    $terms = wp_get_post_terms($post->ID,'product_cat', $args);



    $child_term_id = '';
    $child_term_name = '';
    foreach ($terms as $term) {
    	if ( $term->parent !== 0 ) {
    		$child_term_id = $term->term_id;
    		$child_term_name = $term->name;

    		goto end;
    	}
    	
    }

    if( empty($child_term_name) ) {
    	foreach ($terms as $term) {
    		if ( $term->parent == 0 ) {
    			$child_term_id = $term->term_id;
    			$child_term_name = $term->name;
    			goto end;
    		}
    	}
    }

    end:

    ob_start();
    if( !empty($child_term_name) ):
    ?>
    <div class="product__tag markite">
 		<a href="<?php echo get_category_link( $child_term_id ); ?>"><?php echo esc_html($child_term_name); ?></a>
	</div>
	<?php
	endif;
	print ob_get_clean();
}

function markite_get_author_meta_html() {
    global $post;
    $args = array( 'taxonomy' => 'product_cat',);
    $product_action_switch = get_theme_mod('product_action_switch', false);
    $product_cart_btn_switch = get_theme_mod('product_cart_btn_switch', false);
    $product_author_switch = get_theme_mod('product_author_switch', false);
    $markite_author_by = get_theme_mod('markite_author_by', 'By');
    $markite_cat_in = get_theme_mod('markite_cat_in', 'In');
    $product_action_overlay = $product_action_switch ? 'product-thumb-overlay' : '';

    $terms = wp_get_post_terms($post->ID,'product_cat', $args);



    $child_term_id = '';
    $child_term_name = '';
    foreach ($terms as $term) {
    	if ( $term->parent == 0 ) {
    		$child_term_id = $term->term_id;
    		$child_term_name = $term->name;
    		goto end;
    	}
    	
    }

    if( empty($child_term_name) ) {
    	foreach ($terms as $term) {
    		if ( $term->parent !== 0 ) {
    			$child_term_id = $term->term_id;
    			$child_term_name = $term->name;
    			goto end;
    		}
    		
    	}
    }

    end: 

    ob_start();
    ?>
   <p class="product__author">
        <?php if (!empty($product_author_switch)) : ?>
            <?php if (!empty($markite_author_by)) : ?>
            <?php echo esc_html($markite_author_by); ?> 
            <?php endif; ?> 
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>?author=product"><?php print get_the_author(); ?></a>
        <?php endif; ?> 

         <?php if (!empty($markite_cat_in)) : ?>
         <?php echo esc_html($markite_cat_in); ?> 
         <?php endif; ?>  
         <a href="<?php echo esc_url(get_category_link( $child_term_id )); ?>"><?php echo esc_html($child_term_name); ?></a>
    </p>	
	<?php

	print ob_get_clean();

	?>


	<?php 



}

/**
 * [markite_comment_rating description]
 *
 * @param  [type] $rating [description]
 *
 * @return [type]         [description]
 */
function markite_comment_rating( $rating ) {
	$review = 'Rating ' . $rating . ' out of 5';
	$html   = '';
	$html   .= '<div class="rating" title="' . $review . '">';
	for ( $i = 0; $i <= 4; $i ++ ) {
		if ( $i < floor( $rating ) ) {
			$html .= '<a href="#"><i class="fas fa-star"></i></a>';
		} else {
			$html .= '<a href="#"><i class="far fa-star"></i></a>';
		}
	}
	$html .= '</div>';

	return $html;
}


add_filter( 'woocommerce_add_to_cart_fragments', 'markite_woocommerce_header_add_to_cart_fragment' );

/**
 * [markite_woocommerce_header_add_to_cart_fragment description]
 *
 * @param  [type] $fragments [description]
 *
 * @return [type]            [description]
 */
function markite_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
    <a class="cp-minicart" href="<?php echo wc_get_cart_url(); ?>"><i class="fas fa-shopping-cart"></i><span
                id="markite-cart"
                class="mini-cart-items"><?php print WC()->cart->get_cart_contents_count(); ?></span></a>
	<?php
	$fragments['a.cp-minicart'] = ob_get_clean();

	return $fragments;
}

function markite_vc_yith_wishlist() {

	global $product;

	$cssclass = 'wishlist-rd';
	$mar      = 'tanzim-mar-top';

	$id   = $product->get_id();
	$type = $product->get_type();
	$link = get_site_url();

	$img    = '<img src="' . esc_attr( $link ) . '/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading tanzim_wi_loder" alt="' . esc_attr( 'loading' ) . '" width="16" height="16" style="visibility:hidden">';
	$markup = '';

	if ( MARKITE_WISHLIST_ACTIVED ) {

		$markup .= '<div class="yith-wcwl-add-to-wishlist ' . $mar . ' add-to-wishlist-' . $id . '">';
		$markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
		$markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist ' . $cssclass . '">';
		$markup .= '<i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div class="yith-wcwl-wishlistaddedbrowse wishlist hide" style="display:none;">';
		$markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div class="yith-wcwl-wishlistexistsbrowse wishlist  hide" style="display:none">';
		$markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div style="clear:both"></div>';
		$markup .= '<div class="yith-wcwl-wishlistaddresponse"></div>';
		$markup .= '</div>';

	}

	return $markup;
}

add_filter( 'woocommerce_product_additional_information_heading', 'markite_tab_heading' );
add_filter( 'woocommerce_product_description_heading', 'markite_tab_heading' );

/**
 * [markite_tab_heading description]
 *
 * @param  [type] $heading [description]
 *
 * @return [type]          [description]
 */
function markite_tab_heading( $heading ) {
	return '';
}

/**
 * [markite_woo_pagination description]
 *
 * @param  [type] $pagination [description]
 *
 * @return [type]             [description]
 */
function markite_woo_pagination( $pagination ) {
	$pagi = '';
	if ( $pagination != '' ) {
		$pagi .= '<ul class="pagination justify-content-start">';
		foreach ( $pagination as $key => $pg ) {
			$pagi .= '<li class="page-item">' . $pg . '</li>';
		}
		$pagi .= '</ul>';
	}

	return $pagi;
}

function markite_woocommerce_get_sidebar() {
	dynamic_sidebar( 'product-sidebar' );
}

function markite_woocommerce_template_loop_price() {
	print '<div class="product__content">';
	print '<div class="product__meta mb-10 d-flex justify-content-between align-items-center">';
	echo markite_get_cat_html();
	echo markite_get_price();
	print '</div>';
	markite_product_title();
	echo markite_get_author_meta_html();
	print '</div>';
}

function markite_woocommerce_template_single_price() {
	print '<div class="price mt-15 mb-20">';
	print markite_get_price_html();
	print '</div>';
}

function woocommerce_template_single_stock() {
	global $product;
	if ( $product->get_stock_quantity() > 0 ) {
		echo '<div class="cart-title">';
		echo '<h6>Availability: <span>In Stock</span></h6>';
		echo '</div>';
	} else {
		if ( $product->backorders_allowed() ) {
			echo '<div class="cart-title">';
			echo '<h6>Availability: <span>On Backorder</span></h6>';
			echo '</div>';
		} else {
			echo '<div class="cart-title">';
			echo '<h6>Availability: <span>Out of stock</span></h6>';
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'markite_header_add_to_cart_fragment' ) ) {
	function markite_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
        <span class="cart__count" id="markite-cart-item">
			<?php echo esc_html( WC()->cart->cart_contents_count ); ?>
		</span>
		<?php
		$fragments['#markite-cart-item'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'markite_header_add_to_cart_fragment' );

if ( ! function_exists( 'markite_header_add_to_cart_price' ) ) {
	function markite_header_add_to_cart_price( $fragments ) {
		ob_start();
		?>
        <span class="cart__amount" id="markite-total-price">
			<?php echo WC()->cart->get_cart_total(); ?>
		</span>
		<?php
		$fragments['#markite-total-price'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'markite_header_add_to_cart_price' );


function markite_product_tab() {
	ob_start();
	?>
    <div class="ch-left mb-20">
        <ul class="nav shop-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true"><i class="fas fa-th"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false"><i class="fas fa-list-ul"></i></a>
            </li>
        </ul>
    </div>
    </div> <!-- pro-filter parent end -->
	<?php
	print ob_get_clean();
}

function markite_quick_view_button( $product_id ) {
	if ( MARKITE_QUICK_VIEW_ACTIVED ) {
		$product = wc_get_product( $product_id );
		$button  = '';
		if ( $product_id ) {

			$button = '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fal fa-eye"></i></a>';
			$button = apply_filters( 'yith_add_quick_view_button_html', $button, '', $product );
		}

		return $button;
	}
}

function markite_product_compare_button( $product_id ) {
	if ( MARKITE_COMPARE_ACTIVED ) {
		$product = wc_get_product( $product_id );
		$button  = '';
		if ( $product_id ) {
			$url_args = array(
				'action' => 'yith-woocompare-add-product',
				'id'     => $product_id
			);
			$button   = sprintf( '<a href="%1$s" class="compare button" data-product_id="%2$s" rel="nofollow"><i class="fal fa-exchange"></i></a>',
				get_page_link() . '?action=yith-woocompare-add-product&amp;id=' . esc_attr( $product_id ),
				esc_attr( $product_id )
			);
		}

		return $button;
	}
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <div class="header-mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.header-mini-cart'] = ob_get_clean();
    return $fragments;
});

// markite_woocommerce_short_desc
function markite_woocommerce_short_desc_content(){
	if(has_excerpt()){
		$LinkExcerpt = strip_tags(substr(get_the_excerpt(), 0 ));
		return $LinkExcerpt;
	}
	return false;
}

// markite_pro_details_profile
function markite_pro_details_profile() {
	$markite_sidebar_short_info = function_exists('get_field') ? get_field( 'markite_sidebar_short_info' ) : NULL;
	$product_author_switch = get_theme_mod('product_author_switch', false);
	ob_start(); ?>
   <div class="product__proprietor-head mb-25">
      <div class="product__prorietor-info mb-20 d-flex justify-content-between">
      	<?php if (!empty($product_author_switch)) : ?>
         <div class="product__proprietor-avater d-flex align-items-center flex-wrap">
            <div class="product__proprietor-thumb">
               <?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>
            </div>
            <div class="product__proprietor-name">
               <h5><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print get_the_author(); ?></a></h5>
               <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print esc_html__('View Profile','markite'); ?></a>
            </div>
         </div>
         <?php endif; ?>
         <div class="product__proprietor-price">
         <?php print markite_single_get_price(); ?>
         </div>
      </div>

      <div class="product__proprietor-text">
      	<p><?php print markite_woocommerce_short_desc_content(); ?></p>
      </div>
   </div>
   <?php
   print ob_get_clean();
}

// downloadable_count
function downloadable_count() {
	global $product;
	return $product->get_total_sales();
}

// markite_pro_details_info
function markite_pro_details_info() {
	$markite_sidebar_info_list = function_exists('get_field') ? get_field('markite_sidebar_info_list') : '';
	ob_start(); ?>
       <div class="product__proprietor-body fix">
          <ul class="mb-10 fix">
          	<?php if (!empty($markite_sidebar_info_list['pro_download_label'])) : ?>	
             <li>
             	<?php if (!empty($markite_sidebar_info_list['pro_download_label'])) : ?>
                <h6><?php print wp_kses_post( $markite_sidebar_info_list['pro_download_label'] ); ?></h6>
                <?php endif; ?>
                <?php if( !empty($markite_sidebar_info_list['pro_download_number']) ) : ?>
                <span><?php print wp_kses_post( $markite_sidebar_info_list['pro_download_number'] ); ?></span>	
            	<?php else : ?>
                <span><?php print downloadable_count(); ?></span>
                <?php endif; ?>
             </li>
             <?php endif; ?>
             

             <?php if (!empty($markite_sidebar_info_list['pro_released_date'])) : ?>
             <li>
                <h6><?php print wp_kses_post( $markite_sidebar_info_list['pro_date_label'] ); ?></h6>
                <span><?php print wp_kses_post( $markite_sidebar_info_list['pro_released_date'] ); ?></span>
             </li>
             <?php endif; ?>

             <?php if (!empty($markite_sidebar_info_list['pro_version_number'])) : ?>
             <li>
                <h6><?php print wp_kses_post( $markite_sidebar_info_list['pro_version_label'] ); ?></h6>
                <span><?php print wp_kses_post( $markite_sidebar_info_list['pro_version_number'] ); ?></span>
             </li>
             <?php endif; ?>

             <?php if (!empty($markite_sidebar_info_list['pro_compatibility_list'])) : ?>
             <li>
                <h6><?php print wp_kses_post( $markite_sidebar_info_list['pro_compatibility_label'] ); ?></h6>
                <span><?php print wp_kses_post( $markite_sidebar_info_list['pro_compatibility_list'] ); ?></span>
             </li>
             <?php endif; ?>

             <?php if (!empty($markite_sidebar_info_list['pro_framework_list'])) : ?>
             <li>
                <h6><?php print wp_kses_post( $markite_sidebar_info_list['pro_framework_label'] ); ?></h6>
                <span><?php print wp_kses_post( $markite_sidebar_info_list['pro_framework_list'] ); ?></span>
             </li>
             <?php endif; ?>
          </ul>
       </div>   
       <?php
   print ob_get_clean();
}

// markite_pro_details_live_preview
function markite_pro_details_live_preview() {
	$markite_demo_url = function_exists('get_field') ? get_field('markite_demo_url') : '';
	$markite_demo_button = function_exists('get_field') ? get_field('markite_demo_button') : '';
	ob_start(); ?>
   <div class="product__proprietor-body fix mt-20">
		<?php if (!empty($markite_demo_button)) : ?>
          <a href="<?php print esc_url($markite_demo_url); ?>" target="_blank"  class="m-btn m-btn-border w-100"> <span></span> <?php print esc_html($markite_demo_button); ?></a>
        <?php endif; ?>
   </div>   
    <?php
   print ob_get_clean();
}




// markite_pro_details_banner
function markite_pro_details_banner() { 
	$markite_banner_bg = get_template_directory_uri() . '/assets/img/product/banner-bg.jpg';
	$pro_banner_bg = get_theme_mod('pro_banner_bg', $markite_banner_bg);

	$pro_banner_title = get_theme_mod('markite_pro_banner_title', __('Check Out Our free Templates','markite'));

	$banner_btn_text = get_theme_mod('markite_banner_btn_text', __('Free Template','markite'));
    $banner_btn_link = get_theme_mod('markite_banner_btn_link',  __('#','markite'));

	ob_start(); ?>
    <?php if (!empty($pro_banner_title)) : ?>
    <div class="sidebar__banner" data-background="<?php print esc_url($pro_banner_bg); ?>">
       <h4 class="sidebar__banner-title"><?php print esc_html($pro_banner_title); ?></h4>
       <a href="<?php print esc_url( $banner_btn_link ); ?>" class="m-btn m-btn-white"> <span></span> <?php print esc_html($banner_btn_text); ?></a>
    </div>
    <?php endif; ?>


	<?php
   print ob_get_clean();
}




//dokan product rating
function markite_dokan_product_rating($product) {
	return $product->get_rating_html();
}
//dokan product price
function markite_dokan_product_price($product) {
	return $product->get_price_html();
}


