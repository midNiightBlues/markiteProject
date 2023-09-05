<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$i    = $j = 0;
if ( ! empty( $tabs ) ) : ?>
    <div class="product__details-content">
        <div class="product__tab mb-40">
            <ul class="nav nav-tabs" id="proTab" role="tablist">
                <?php foreach ( $tabs as $key => $tab ) : ?>
                <?php $cl = ( $j == 0 ) ? ' active' : ''; ?>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link <?php print esc_html( $cl ); ?>" id="overview-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" data-bs-target="#overview_<?php echo esc_attr( $key ); ?>" type="button" role="tab" aria-selected="true"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></button>
                 </li>
                 <?php $j ++; endforeach; ?>
            </ul>
        </div>
        <div class="product__tab-content">
            <div class="tab-content" id="proTabContent_info">
                <?php foreach ( $tabs as $key => $tab ) : ?>
                    <?php $cl = ( $i == 0 ) ? 'show active' : ''; ?>
                 <div class="tab-pane fade <?php print esc_html( $cl ); ?>" id="overview_<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="overview-<?php echo esc_attr( $key ); ?>">
                    <div class="product__overview">
                       <?php if ( isset( $tab['callback'] ) ) {
                            call_user_func( $tab['callback'], $key, $tab );
                        } ?>
                    </div>
                 </div>
                <?php
                    $i ++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>