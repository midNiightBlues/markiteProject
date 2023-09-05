<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package markite
 */

/**
*
* markite header
*/

function markite_check_header() {
    $markite_header_style = function_exists('get_field') ? get_field( 'header_style' ) : NULL;

    $markite_default_header_style = get_theme_mod('choose_default_header', 'header-style-1' );

    if( $markite_header_style == 'header-style-1' && empty($_GET['s']) ) {
        markite_header_style_1();
    }
    elseif( $markite_header_style == 'header-style-2' && empty($_GET['s']) ) {
        markite_header_style_2();
    }
    elseif( $markite_header_style == 'header-style-3' && empty($_GET['s']) ) {
        markite_header_style_3();
    }    
    elseif( $markite_header_style == 'header-style-4' && empty($_GET['s']) ) {
        markite_header_style_4();
    }
    else {

        /** default header style **/
        if($markite_default_header_style == 'header-style-2') {
            markite_header_style_2();
        }
        elseif($markite_default_header_style == 'header-style-3') {
            markite_header_style_3();
        }
        elseif($markite_default_header_style == 'header-style-4') {
            markite_header_style_4();
        }
        else {
            markite_header_style_1();
        }
    }

}
add_action('markite_header_style', 'markite_check_header', 10);

/**
* header style 1 + default
*/
function markite_header_style_1() {
    $markite_topbar_switch = get_theme_mod('markite_topbar_switch', false);
    $markite_cart_hide = get_theme_mod('markite_cart_hide', false);
    $markite_show_button = get_theme_mod('markite_show_button', false);
    $markite_show_cta = get_theme_mod('markite_show_cta', false);
    $markite_hamburger_hide = get_theme_mod('markite_hamburger_hide', false);
    $markite_show_header_search = get_theme_mod('markite_show_header_search' , false);

    $markite_mail_id = get_theme_mod('markite_mail_id', __('info@consulting.com','markite'));
    $markite_phone = get_theme_mod('markite_phone', __('(+468) 254 762 443','markite'));

    $markite_header_right = get_theme_mod('markite_header_right', false);
    $markite_menu_col =  $markite_header_right ? 'col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xl-9 col-lg-10 d-none d-lg-block';
    $markite_menu_right =  $markite_header_right ? 'text-center' : 'text-right';

    // login btn
    $btn_login_text = get_theme_mod('markit_btn_login_text', __('Log In','markite'));
    $btn_login_link = get_theme_mod('markit_btn_login_link',  __('#','markite'));

    // btn
    $btn_text = get_theme_mod('markite_button_text', __('Log In','markite'));
    $btn_link = get_theme_mod('markite_button_link', __('#','markite'));

    ?>

      <!-- header area start -->
      <header>
         <div class="header__area header__shadow white-bg" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-6">
                     <div class="logo">
                        <?php markite_header_logo(); ?>
                     </div>
                  </div>
                  <div class="col-xxl-8 col-xl-8 col-lg-8 d-none d-lg-block">
                     <div class="main-menu">
                        <nav id="mobile-menu">
                           <?php markite_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-8 col-6 pl-0">
                     <div class="header__action d-flex align-items-center justify-content-end">
                        <?php if( !empty($markite_header_right) ): ?>
                        <?php if( !empty($btn_login_link) ): ?>
                        <div class="header__login d-none d-sm-block">
                         <?php if ( is_user_logged_in() ) : ?>
                           <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="fal fa-unlock"></i> <?php print esc_html__('My account','markite'); ?></a>
                           <?php else :  ?>
                           <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="fal fa-unlock"></i> <?php print esc_html($btn_login_text); ?></a>
                           <?php endif;  ?>
                        </div>
                        <?php endif;  ?>
                        <?php endif;  ?>
                        <?php if ( !empty($markite_cart_hide) ): ?>
                        <div class="header__cart d-none d-sm-block">
                           <a href="<?php echo wc_get_cart_url(); ?>" class="cart-toggle-btn">
                              <i class="fal fa-shopping-cart"></i>
                              <span><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                           </a>
                        </div>
                        <?php endif;  ?>
                        <div class="sidebar__menu d-lg-none">
                           <div class="sidebar-toggle-btn" id="sidebar-toggle">
                               <span class="line"></span>
                               <span class="line"></span>
                               <span class="line"></span>
                           </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->


      <?php markite_mobile_info(); ?>

<?php
}

/**
* header style 2
*/
function markite_header_style_2() {
    $markite_cart_hide = get_theme_mod('markite_cart_hide', false);
    $markite_show_button = get_theme_mod('markite_show_button', false);
    $markite_show_cta = get_theme_mod('markite_show_cta', false);
    $markite_hamburger_hide = get_theme_mod('markite_hamburger_hide', false);
    $markite_show_header_search = get_theme_mod('markite_show_header_search' , false);
    $btn_text_from_page = get_post_meta(get_the_ID(), 'button_text_from_page', true);

    $markite_header_right = get_theme_mod('markite_header_right', false);

    // login btn
    $btn_login_text = get_theme_mod('markit_btn_login_text', __('Log In','markite'));
    $btn_login_link = get_theme_mod('markit_btn_login_link',  __('#','markite'));

    // btn
    $btn_text = get_theme_mod('markite_button_text', __('Get Started','markite'));
    $btn_link = get_theme_mod('markite_button_link',  __('#','markite'));

    ?>

      <!-- header area start -->
      <header class="2">
         <div class="header__area header__shadow-2 white-bg" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-6">
                     <div class="logo">
                        <?php markite_header_logo(); ?>
                     </div>
                  </div>
                  <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-6 d-flex justify-content-end">
                     <div class="main-menu d-none  d-lg-flex justify-content-end">
                        <nav id="mobile-menu">
                           <?php markite_header_menu(); ?>
                        </nav>
                     </div>
                     <div class="header__action d-flex align-items-center justify-content-end ml-45">
                        <?php if( !empty($btn_login_link) ): ?>
                        <div class="header__login header__login-2 d-none d-sm-block">
                         <?php if ( is_user_logged_in() ) : ?>
                           <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="far fa-unlock"></i> <?php print esc_html__('My account','markite'); ?></a>
                           <?php else :  ?>
                           <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="far fa-unlock"></i> <?php print esc_html($btn_login_text); ?></a>
                           <?php endif;  ?>
                        </div>
                        <?php endif;  ?>

                        <?php if( !empty($btn_link) ): ?>
                        <div class="header__btn d-none d-xl-block">
                           <a href="<?php print esc_url( $btn_link ); ?>" class="m-btn m-btn-2 hbtn-2"><?php print esc_html($btn_text); ?></a>
                        </div>
                        <?php endif;  ?>
                        <div class="sidebar__menu d-lg-none">
                           <div class="sidebar-toggle-btn" id="sidebar-toggle">
                               <span class="line"></span>
                               <span class="line"></span>
                               <span class="line"></span>
                           </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->

    <?php markite_mobile_info(); ?>

<?php
}


/**
* header style 3
*/
function markite_header_style_3() {
    $markite_topbar_switch = get_theme_mod('markite_topbar_switch', false);
    $markite_cart_hide = get_theme_mod('markite_cart_hide', false);
    $markite_show_button = get_theme_mod('markite_show_button', false);
    $markite_show_cta = get_theme_mod('markite_show_cta', false);
    $markite_hamburger_hide = get_theme_mod('markite_hamburger_hide', false);
    $markite_show_header_search = get_theme_mod('markite_show_header_search' , false);

    $markite_mail_id = get_theme_mod('markite_mail_id', __('info@consulting.com','markite'));
    $markite_phone = get_theme_mod('markite_phone', __('(+468) 254 762 443','markite'));

    $markite_header_right = get_theme_mod('markite_header_right', false);
    $markite_menu_col =  $markite_header_right ? 'col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xl-9 col-lg-10 d-none d-lg-block';
    $markite_menu_right =  $markite_header_right ? 'text-center' : 'text-right';

    // login btn
    $btn_login_text = get_theme_mod('markit_btn_login_text', __('Log In','markite'));
    $btn_login_link = get_theme_mod('markit_btn_login_link',  __('#','markite'));

    // btn
    $btn_text = get_theme_mod('markite_button_text', __('Log In','markite'));
    $btn_link = get_theme_mod('markite_button_link', __('#','markite'));

    ?>

      <!-- header area start -->
      <header>
         <div class="header__area header__shadow header-transparent" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-6">
                     <div class="logo">
                        <?php markite_header_logo(); ?>
                     </div>
                  </div>
                  <div class="col-xxl-8 col-xl-8 col-lg-8 d-none d-lg-block">
                     <div class="main-menu text-center">
                        <nav id="mobile-menu">
                           <?php markite_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-8 col-6 pl-0">
                     <div class="header__action d-flex align-items-center justify-content-end">
                        <?php if( !empty($markite_header_right) ): ?>
                        <?php if( !empty($btn_login_link) ): ?>
                        <div class="header__login d-none d-sm-block">
                           <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="far fa-unlock"></i> <?php print esc_html($btn_login_text); ?></a>
                        </div>
                        <?php endif;  ?>
                        <?php endif;  ?>
                        <?php if ( !empty($markite_cart_hide) ): ?>
                        <div class="header__cart d-none d-sm-block">
                           <a href="<?php echo wc_get_cart_url(); ?>" class="cart-toggle-btn">
                              <i class="far fa-shopping-cart"></i>
                              <span><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                           </a>
                        </div>
                        <?php endif;  ?>
                        <div class="sidebar__menu d-lg-none">
                           <div class="sidebar-toggle-btn" id="sidebar-toggle">
                               <span class="line"></span>
                               <span class="line"></span>
                               <span class="line"></span>
                           </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->


      <?php markite_mobile_info(); ?>

<?php
}

// header 4

function markite_header_style_4() {
    $markite_topbar_switch = get_theme_mod('markite_topbar_switch', false);
    $markite_cart_hide = get_theme_mod('markite_cart_hide', false);
    $markite_show_button = get_theme_mod('markite_show_button', false);
    $markite_show_cta = get_theme_mod('markite_show_cta', false);
    $markite_hamburger_hide = get_theme_mod('markite_hamburger_hide', false);
    $markite_show_header_search = get_theme_mod('markite_show_header_search' , false);

    $markite_mail_id = get_theme_mod('markite_mail_id', __('info@consulting.com','markite'));
    $markite_phone = get_theme_mod('markite_phone', __('(+468) 254 762 443','markite'));

    $markite_header_right = get_theme_mod('markite_header_right', false);
    $markite_menu_col =  $markite_header_right ? 'col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xl-9 col-lg-10 d-none d-lg-block';
    $markite_menu_right =  $markite_header_right ? 'text-center' : 'text-right';

    // login btn
    $btn_login_text = get_theme_mod('markit_btn_login_text', __('Log In','markite'));
    $btn_login_link = get_theme_mod('markit_btn_login_link',  __('#','markite'));

    // btn
    $btn_text = get_theme_mod('markite_button_text', __('Log In','markite'));
    $btn_link = get_theme_mod('markite_button_link', __('#','markite'));

    $markite_notifi = get_theme_mod('markite_notifi', false);
    $notifi_img = get_theme_mod('notifi_img');
    $notifi_img_link = get_theme_mod('notifi_img_link', __('#','markite'));
    $notifi_countdown = get_theme_mod('notifi_countdown', __('2023/01/11','markite'));

    ?>

      <!-- header area start -->
      <header class="header-new-bg-4">

        <?php if(!empty($markite_notifi)) : ?>
         <div class="header-time-count banner-bg d-none d-lg-block">
            <div class="container">
                <div class="tp-header-banner-img">
                    <?php if(!empty($notifi_img)) : ?>
                    <a href="<?php echo esc_url($notifi_img_link); ?>">
                        <img src="<?php echo esc_url($notifi_img); ?>" alt="<?php echo esc_html__('notifi_img', 'markite'); ?>">
                    </a>
                    <?php endif; ?>
                    <?php if(!empty($notifi_countdown)) : ?>
                    <div class="tp-headerbanne-counter fix">
                        <div class="tp-coundown__countdown" data-countdown="<?php echo esc_attr($notifi_countdown)?>"></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
         </div>
        <?php endif; ?>

         <div class="header-search-area d-none d-lg-block">
            <div class="container-fluid">
                <div class="custom-header-4">
                    <div class="logo">
                         <?php markite_header_logo(); ?>
                      </div>
                      <div class="tp-header-search">
                            <form name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
 
                             <div class="tp-cat-select">
                                 <?php if (class_exists('WooCommerce')) : ?>
                                   <?php 
                                   if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']))
                                   {
                                    $optsetlect=$_REQUEST['product_cat'];
                                   }
                                  else{
                                   $optsetlect=0;  
                                   }
                                          $args = array(
                                                     'show_option_all' => esc_html__( 'All Items', 'markite' ),
                                                     'hierarchical' => 1,
                                                     'class' => 'cat',
                                                     'echo' => 1,
                                                     'value_field' => 'slug',
                                                     'selected' => $optsetlect
                                                 );
                                           $args['taxonomy'] = 'product_cat';
                                           $args['name'] = 'product_cat';              
                                           $args['class'] = 'cate-dropdown hidden-xs';
                                           wp_dropdown_categories($args);
                                    ?>
                             </div>
                           <input type="hidden" value="product" name="post_type" class="tp-woo-cat">
                         <?php endif; ?>
                                        <input type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search', 'markite'); ?>">
 
                             <button type="submit" title="<?php esc_attr_e('Search', 'markite'); ?>" class="search-btn-bg"><span><i class="fal fa-search"></i></span></button>
                           </form>
                      </div>
                    <div class="tp-exttra-menu d-flex align-items-center justify-content-end">
                         <div class="main-menu extra-menu mr-10 d-none d-xl-block">
                             <nav>
                                 <?php markite_header_top_menu(); ?>
                             </nav>
                         </div>
                         <div class="tp-login-btn">
                            <?php if(!empty($btn_login_text)) : ?>
                             <a href="<?php echo esc_url($btn_login_link); ?>">
                             <span>
                                
                                 <i class="far fa-user"></i>
                                 
                             </span>
                             <span> <?php echo esc_html($btn_login_text); ?></span>
                             </a>
                            <?php endif; ?>
                         </div>
                     </div>
                </div>
                </div>
            </div>
         </div>
         <div class="header__area header__shadow white-bg" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
               <div class="col-6 d-lg-none">
                     <div class="logo">
                        <?php markite_header_logo(); ?>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 d-none d-lg-block">
                     <div class="main-menu text-centers">
                        <nav id="mobile-menu">
                           <?php markite_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-6 pl-0 d-lg-none">
                     <div class="header__action d-flex align-items-center justify-content-end">
                        <div class="sidebar__menu d-lg-none">
                           <div class="sidebar-toggle-btn" id="sidebar-toggle">
                               <span class="line"></span>
                               <span class="line"></span>
                               <span class="line"></span>
                           </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->


      <?php markite_mobile_info(); ?>

<?php
}


/**
 * [markite_extra_info description]
 * @return [type] [description]
 */
function markite_mobile_info(){
    $markite_extra_info_logo   = get_theme_mod('markite_extra_info_logo',get_template_directory_uri() . '/assets/img/logo/logo-white.png');
    $markite_cart_hide = get_theme_mod('markite_cart_hide', false);
    // login btn
    $btn_login_text = get_theme_mod('markit_btn_login_text', __('Log In','markite'));
    $btn_login_link = get_theme_mod('markit_btn_login_link',  __('#','markite'));

?>

      <!-- sidebar area start -->
      <div class="sidebar__area">
         <div class="sidebar__wrapper">
            <div class="sidebar__close">
               <button class="sidebar__close-btn" id="sidebar__close-btn">
               <span><i class="fal fa-times"></i></span>
               <span><?php print esc_html__('close','markite'); ?></span>
               </button>
            </div>
            <div class="sidebar__content">
              <?php if( !empty($markite_extra_info_logo) ) : ?>
               <div class="logo mb-40">
                  <a href="<?php print esc_url(home_url('/')); ?>">
                  <img src="<?php print esc_url($markite_extra_info_logo); ?>" alt="<?php print esc_html__('markite logo','markite'); ?>">
                  </a>
               </div>
               <?php endif; ?>
               <div class="mobile-menu fix"></div>
               <div class="sidebar__action">
                  <?php if( !empty($btn_login_text) ) : ?>
                  <div class="sidebar__login mt-15">
                     <a href="<?php print esc_url( $btn_login_link ); ?>"><i class="far fa-unlock"></i> <?php print esc_html( $btn_login_text ); ?></a>
                  </div>
                  <?php endif; ?>

                  <?php if ( !empty($markite_cart_hide) ): ?>
                  <div class="sidebar__cart mt-20">
                     <a href="<?php echo wc_get_cart_url(); ?>" class="cart-toggle-btn">
                        <i class="far fa-shopping-cart"></i>
                        <span><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                     </a>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
      <!-- sidebar area end -->
      <div class="body-overlay"></div>
      <!-- sidebar area end -->


<?php }



/**
 * [markite_extra_info description]
 * @return [type] [description]
 */
function markite_extra_info(){
    $markite_extra_info_logo   = get_theme_mod('markite_extra_info_logo',get_template_directory_uri() . '/assets/img/logo/logo.png');

    // about title
    $markite_extra_about_text     = get_theme_mod('markite_extra_about_text', __('We must explain to you how all seds this mistakens idea off denouncing pleasures and praising pain was born and I will give you a completed accounts of the system and expound.','markite'));
    $markite_extra_button     = get_theme_mod('markite_extra_button', __('Contact Us','markite'));
    $markite_extra_button_url     = get_theme_mod('markite_extra_button_url', __('#','markite'));

    // address
    $markite_extra_address     = get_theme_mod('markite_extra_address', __('Ave 14th Street, Mirpur 210, San Franciso, USA 3296.','markite'));

    // phone
    $markite_extra_phone   = get_theme_mod('markite_extra_phone', __('+0989 7876 9865 9','markite'));

    // email
    $markite_extra_email  = get_theme_mod('markite_extra_email', __('info@example.com','markite'));

?>

    <!-- sidebar area start -->
    <section class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <span><i class="fal fa-times"></i></span>
                    <span><?php print esc_html__('close','markite'); ?></span>
                </button>
            </div>
            <div class="sidebar__tab">
                <ul class="nav nav-tabs" id="sidebar-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="true"><?php print esc_html__('menu','markite'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><?php print esc_html__('info','markite'); ?></a>
                    </li>
                </ul>
            </div>
            <div class="sidebar__content">
                <div class="tab-content" id="sidebar-tab-content">
                    <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                        <?php if( !empty($markite_extra_info_logo) ) : ?>
                        <div class="logo mb-40">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php print esc_url( $markite_extra_info_logo ); ?>" alt="<?php print esc_attr__('Logo', 'markite'); ?>">
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="mobile-menu"></div>
                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <div class="sidebar__info">
                            <?php if( !empty($markite_extra_info_logo) ) : ?>
                            <div class="logo mb-40">
                                <a href="<?php print esc_url(home_url('/')); ?>">
                                    <img src="<?php print esc_url( $markite_extra_info_logo ); ?>" alt="<?php print esc_attr__('Logo', 'markite'); ?>">
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if( !empty($markite_extra_about_text) ) : ?>
                            <p><?php print esc_html( $markite_extra_about_text ); ?></p>
                            <?php endif; ?>

                            <?php if( !empty($markite_extra_button) ) : ?>
                            <a href="<?php print esc_url( $markite_extra_button_url ); ?>" class="z-btn z-btn-white"><?php print esc_html( $markite_extra_button ); ?></a>
                            <?php endif; ?>

                            <div class="sidebar__search">
                                <form action="#">
                                    <input type="text" placeholder="<?php print esc_attr('Your Keywords', 'markite'); ?>">
                                    <button type="submit"><i class="fal fa-search"></i></button>
                                </form>
                            </div>
                            <div class="sidebar__contact mt-30">
                                <ul>
                                    <?php if( !empty($markite_extra_address) ) : ?>
                                    <li>
                                        <div class="icon">
                                            <i class="fal fa-map-marker-alt"></i>
                                        </div>
                                        <div class="text">
                                            <span><?php print esc_html( $markite_extra_address ); ?></span>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if( !empty($markite_extra_email) ) : ?>
                                    <li>
                                        <div class="icon">
                                            <i class="fal fa-envelope"></i>
                                        </div>
                                        <div class="text ">
                                            <span><a href="mailto:<?php print esc_url( $markite_extra_email ); ?>"><?php print esc_html( $markite_extra_email ); ?></a></span>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if( !empty($markite_extra_phone) ) : ?>
                                    <li>
                                        <div class="icon">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <div class="text">
                                            <span><a href="tel:<?php print esc_url( $markite_extra_phone ); ?>"><?php print esc_html( $markite_extra_phone ); ?></a></span>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="body-overlay"></div>
    <!-- sidebar area end -->


<?php }

/**
 * [markite_header_lang description]
 * @return [type] [description]
 */
function markite_header_lang_defualt() {
    $markite_header_lang            = get_theme_mod('markite_header_lang',false);
    if( $markite_header_lang ): ?>

    <ul>
        <li><a href="#0" class="lang__btn"><?php print esc_html__('EN', 'markite'); ?> <i class="ti-arrow-down"></i></a>
        <?php do_action('markite_language'); ?>
        </li>
    </ul>

    <?php endif; ?>
<?php
}


/**
 * [markite_language_list description]
 * @return [type] [description]
 */
function _markite_language($mar) {
        return $mar;
}
function markite_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul>';
            foreach($languages as $lan){
                $active = $lan['active']==1?'active':'';
                $mar .= '<li class="'.$active.'"><a href="'.$lan['url'].'">'.$lan['translated_name'].'</a></li>';
            }
        $mar .= '</ul>';
    }else{
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
            $mar .= '<li><a href="#">'.esc_html__('USA','markite').'</a></li>';
            $mar .= '<li><a href="#">'.esc_html__('UK','markite').'</a></li>';
            $mar .= '<li><a href="#">'.esc_html__('CA','markite').'</a></li>';
            $mar .= '<li><a href="#">'.esc_html__('AU','markite').'</a></li>';
        $mar .= ' </ul>';
    }
    print _markite_language($mar);
}
add_action('markite_language','markite_language_list');

// header logo
function markite_header_logo() {
    ?>
        <?php
        $markite_logo_on = function_exists('get_field') ? get_field('is_enable_sec_logo') : NULL;
        $markite_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $markite_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-white.png';

        $markite_site_logo = get_theme_mod('logo', $markite_logo);
        $markite_secondary_logo = get_theme_mod('seconday_logo', $markite_logo_black);
        ?>

        <?php
        if( has_custom_logo()){
            the_custom_logo();
        }else{

            if( !empty($markite_logo_on) && empty($_GET['s']) ) { ?>
                <a class="standard-logo" href="<?php print esc_url(home_url('/')); ?>">
                    <img src="<?php print esc_url($markite_secondary_logo); ?>" alt="<?php print esc_attr__('logo','markite'); ?>" />
                </a>
            <?php
            }
            else{ ?>
                <a class="standard-logo-white" href="<?php print esc_url(home_url('/')); ?>">
                    <img src="<?php print esc_url($markite_site_logo); ?>" alt="<?php print esc_attr__('logo','markite'); ?>" />
                </a>
            <?php
            }
        }
        ?>
    <?php
}

// header logo
function markite_header_sticky_logo() {
    ?>
        <?php
        $markite_logo = get_template_directory_uri() . '/assets/img/logo/logo-gradient.png';

        $markite_site_logo = get_theme_mod('logo_sticky', $markite_logo);
        ?>

        <?php
        if( has_custom_logo()){
            the_custom_logo();
        }else{?>

            <a class="standard-logo-white" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($markite_site_logo); ?>" alt="<?php print esc_attr__('logo','markite'); ?>" />
            </a>
           <?php

        }
        ?>
    <?php
}



/**
 * [markite_header_social_profiles description]
 * @return [type] [description]
 */
function markite_header_social_profiles() {
    $markite_topbar_fb_url             = get_theme_mod('markite_topbar_fb_url', __('#','markite'));
    $markite_topbar_twitter_url       = get_theme_mod('markite_topbar_twitter_url', __('#','markite'));
    $markite_topbar_instagram_url      = get_theme_mod('markite_topbar_instagram_url', __('#','markite'));
    $markite_topbar_linkedin_url      = get_theme_mod('markite_topbar_linkedin_url', __('#','markite'));
    $markite_topbar_youtube_url        = get_theme_mod('markite_topbar_youtube_url', __('#','markite'));
    ?>
        <ul>
        <?php if (!empty($markite_topbar_fb_url)): ?>
          <li><a href="<?php print esc_url($markite_topbar_fb_url); ?>"><i class="fab fa-facebook-f"></i></a></li>
        <?php endif; ?>

        <?php if (!empty($markite_topbar_twitter_url)): ?>
            <li><a href="<?php print esc_url($markite_topbar_twitter_url); ?>"><i class="fab fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if (!empty($markite_topbar_instagram_url)): ?>
            <li><a href="<?php print esc_url($markite_topbar_instagram_url); ?>"><i class="fab fa-instagram"></i></a></li>
        <?php endif; ?>

        <?php if (!empty($markite_topbar_linkedin_url)): ?>
            <li><a href="<?php print esc_url($markite_topbar_linkedin_url); ?>"><i class="fab fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if (!empty($markite_topbar_youtube_url)): ?>
            <li><a href="<?php print esc_url($markite_topbar_youtube_url); ?>"><i class="fab fa-youtube"></i></a></li>
        <?php endif; ?>
        </ul>
<?php
}


function markite_footer_social_profiles() {
    $markite_footer_fb_url             = get_theme_mod('markite_footer_fb_url', __('#','markite'));
    $markite_footer_twitter_url       = get_theme_mod('markite_footer_twitter_url', __('#','markite'));
    $markite_footer_instagram_url      = get_theme_mod('markite_footer_instagram_url', __('#','markite'));
    $markite_footer_linkedin_url      = get_theme_mod('markite_footer_linkedin_url', __('#','markite'));
    $markite_footer_youtube_url        = get_theme_mod('markite_footer_youtube_url', __('#','markite'));
    ?>

        <ul>
        <?php if (!empty($markite_footer_fb_url)): ?>
            <li>
                <a href="<?php print esc_url($markite_footer_fb_url); ?>">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($markite_footer_twitter_url)): ?>
            <li>
                <a href="<?php print esc_url($markite_footer_twitter_url); ?>">
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($markite_footer_instagram_url)): ?>
            <li>
                <a href="<?php print esc_url($markite_footer_instagram_url); ?>">
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($markite_footer_linkedin_url)): ?>
            <li>
                <a href="<?php print esc_url($markite_footer_linkedin_url); ?>">
                    <i class="fab fa-linkedin"></i>
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($markite_footer_youtube_url)): ?>
            <li>
                <a href="<?php print esc_url($markite_footer_youtube_url); ?>">
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif; ?>
        </ul>
<?php
}


/**
 * [markite_header_menu description]
 * @return [type] [description]
 */
function markite_header_menu() { ?>
            <?php
            wp_nav_menu(array(
                'theme_location'    => 'main-menu',
                'menu_class'        => '',
                'container'         => '',
                'fallback_cb'       => 'Navwalker_Class::fallback',
                'walker'            => new Navwalker_Class
            ));
           ?>
    <?php
}

/**
 * [markite_header_top_menu description]
 * @return [type] [description]
 */
function markite_header_top_menu() { ?>
            <?php
            wp_nav_menu(array(
                'theme_location'    => 'header-top-menu',
                'menu_class'        => '',
                'container'         => '',
                'fallback_cb'       => 'Navwalker_Class::fallback',
                'walker'            => new Navwalker_Class
            ));
           ?>
    <?php
}

/**
 * [markite_header_menu description]
 * @return [type] [description]
 */
function markite_mobile_menu() { ?>
    <?php
    $markite_menu = wp_nav_menu( array(
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'menu_id'        => 'mobile-menu-active',
        'echo'           => false
    ) );

    $markite_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $markite_menu );
    echo wp_kses_post( $markite_menu );
    ?>
    <?php
}

/**
 * [markite_footer_menu description]
 * @return [type] [description]
 */
function markite_footer_menu() {
    wp_nav_menu(array(
        'theme_location'    => 'footer-menu',
        'menu_class'        => 'm-0',
        'container'         => '',
        'fallback_cb'       => 'Navwalker_Class::fallback',
        'walker'            => new Navwalker_Class
    ));
}

/**
*
* markite footer
*/
add_action('markite_footer_style', 'markite_check_footer', 10);

function markite_check_footer() {
    $markite_footer_style = function_exists('get_field') ? get_field( 'footer_style' ) : NULL;
    $markite_default_footer_style = get_theme_mod('choose_default_footer', 'footer-style-1' );


    if( $markite_footer_style == 'footer-style-1' ) {
        markite_footer_style_1();
    }
    elseif( $markite_footer_style == 'footer-style-2' ) {
        markite_footer_style_2();
    }
    else{

        /** default footer style **/
        if($markite_default_footer_style == 'footer-style-2') {
           markite_footer_style_2();
        }
        else {
            markite_footer_style_1();
        }

    }
}

/**
* footer  style_defaut
*/
function markite_footer_style_1() {

    $footer_bg_img = get_theme_mod('markite_footer_bg');
    $markite_footer_logo = get_theme_mod('markite_footer_logo');
    $markite_footer_menu = get_theme_mod('markite_footer_menu');
    $markite_copyright_center = $markite_footer_menu ? 'col-xxl-6 col-xl-6 col-md-6' : 'col-lg-12 text-center';
    $markite_footer_bg_url_from_page = function_exists('get_field') ? get_field('markite_footer_bg') : '';
    $markite_footer_bg_color_from_page = function_exists('get_field') ? get_field('markite_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('markite_footer_bg_color');

    // bg image
    $bg_img = !empty($markite_footer_bg_url_from_page['url']) ? $markite_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty($markite_footer_bg_color_from_page) ? $markite_footer_bg_color_from_page : $footer_bg_color;

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for( $num=1; $num <= $footer_widgets; $num++ ) {
        if ( is_active_sidebar( 'footer-'. $num ) ){
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
        case '1':
        $footer_class[1] = 'col-lg-12';
        break;
        case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
        case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
        case '4':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 footer-col-1';
        $footer_class[2] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer-col-2';
        $footer_class[3] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 footer-col-3';
        $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6 footer-col-4';
        break;
        default:
        $footer_class = 'col-xl-4 col-lg-4 col-md-6';
        break;
    }

?>

      <footer class="footer-style-1">
         <div class="footer__area footer-bg-2" data-bg-color="<?php print esc_attr($bg_color); ?>" data-background="<?php print esc_url($bg_img); ?>">
            <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
            <div class="footer__top pt-90 pb-50">
               <div class="container">
                  <div class="row">
                        <?php
                        if ( $footer_columns < 4 ) {
                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                            dynamic_sidebar( 'footer-1');
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6">';
                            dynamic_sidebar( 'footer-2');
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                            dynamic_sidebar( 'footer-3');
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6">';
                            dynamic_sidebar( 'footer-4');
                            print '</div>';
                        }
                        else{
                            for( $num=1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-'. $num ) ) continue;
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-'. $num );
                                print '</div>';
                            }
                        }

                        ?>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <div class="footer__bottom">
               <div class="container">
                  <div class="footer__bottom-inner footer__bottom-inner-2">
                     <div class="row">
                        <div class="<?php print esc_attr($markite_copyright_center); ?>">
                           <div class="footer__copyright footer__copyright-2 wow fadeInUp" data-wow-delay=".5s">
                              <p><?php print markite_copyright_text(); ?></p>
                           </div>
                        </div>
                        <?php if ( $markite_footer_menu ) : ?>
                        <div class="col-xxl-6 col-xl-6 col-md-6">
                           <div class="footer__bottom-link footer__bottom-link-2 wow fadeInUp text-md-end" data-wow-delay=".8s">
                              <?php markite_footer_menu(); ?>
                           </div>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>

<?php
}

/**
* footer  style 2
*/
function markite_footer_style_2() {
    $footer_bg_img = get_theme_mod('markite_footer_bg');
    $markite_footer_social = get_theme_mod('markite_footer_social');
    $markite_copyright_center = $markite_footer_social ? 'col-xl-6 col-lg-6 col-md-6' : 'col-lg-12 text-center';
    $markite_footer_bg_url_from_page = function_exists('get_field') ? get_field('markite_footer_bg') : '';
    $markite_footer_bg_color_from_page = function_exists('get_field') ? get_field('markite_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('markite_footer_bg_color');

    // bg image
    $bg_img = !empty($markite_footer_bg_url_from_page['url']) ? $markite_footer_bg_url_from_page['url'] : $footer_bg_img;
    // bg color
    $bg_color = !empty($markite_footer_bg_color_from_page) ? $markite_footer_bg_color_from_page : $footer_bg_color;

    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 5);

    for( $num=1; $num <= $footer_widgets; $num++ ) {
        if ( is_active_sidebar( 'footer-2-'. $num ) ){
            $footer_columns++;
        }
    }



    switch ( $footer_columns ) {
        case '1':
        $footer_class[1] = 'col-lg-12';
        break;
        case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
        case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
        case '4':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-4';
        $footer_class[2] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-4';
        $footer_class[3] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-4';
        $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-4';
        break;
        case '5':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 footer-col-2-1';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-2';
        $footer_class[3] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 footer-col-2-3';
        $footer_class[4] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-4';
        $footer_class[5] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-5';
        break;
        default:
        $footer_class = 'col-xl-4 col-lg-4 col-md-6';
        break;
    }

?>

      <footer class="footer-style-2">
         <div class="footer__area footer-bg">
            <?php if ( is_active_sidebar('footer-2-1') OR is_active_sidebar('footer-2-2') OR is_active_sidebar('footer-2-3') OR is_active_sidebar('footer-2-4') OR is_active_sidebar('footer-2-5') ): ?>
            <div class="footer__top pt-90 pb-50">
               <div class="container">
                  <div class="row">
                        <?php
                        if ( $footer_columns < 5 ) {
                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 footer-col-2-1">';
                            dynamic_sidebar( 'footer-2-1');
                            print '</div>';

                            print '<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-2">';
                            dynamic_sidebar( 'footer-2-2');
                            print '</div>';

                            print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 footer-col-2-3">';
                            dynamic_sidebar( 'footer-2-3');
                            print '</div>';

                            print '<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-4">';
                            dynamic_sidebar( 'footer-2-4');
                            print '</div>';

                            print '<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4 footer-col-2-5">';
                            dynamic_sidebar( 'footer-2-5');
                            print '</div>';
                        }
                        else{
                            for( $num=1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-2-'. $num ) ) continue;
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-2-'. $num );
                                print '</div>';
                            }
                        }

                        ?>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <div class="footer__bottom">
               <div class="container">
                  <div class="footer__bottom-inner">
                     <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-md-6">
                           <div class="footer__copyright wow fadeInUp" data-wow-delay=".5s">
                              <p><?php print markite_copyright_text(); ?></p>
                           </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-md-6">
                           <div class="footer__bottom-link wow fadeInUp text-md-end" data-wow-delay=".8s">
                              <?php markite_footer_menu(); ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>

<?php
}


/**
* footer 3
*/
function markite_footer_style_3() {

    $footer_bg_img = get_theme_mod('markite_footer_bg');
    $markite_footer_bg_url_from_page = function_exists('get_field') ? get_field('markite_footer_bg') : '';
    $markite_footer_bg_color_from_page = function_exists('get_field') ? get_field('markite_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('markite_footer_bg_color');

    // bg image
    $bg_img = !empty($markite_footer_bg_url_from_page['url']) ? $markite_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty($markite_footer_bg_color_from_page) ? $markite_footer_bg_color_from_page : $footer_bg_color;

    $footer_columns = 0;

    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for( $num=1; $num <= $footer_widgets+1; $num++ ) {
        if ( is_active_sidebar( 'footer-3-'. $num ) ){
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
        case '1':
        $footer_class[1] = 'col-lg-12';
        break;
        case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
        case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-12';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-sm-6 col-6';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        case '4':
        $footer_class[1] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[2] = 'col-xl-2 col-lg-3 col-md-4 col-sm-6 offset-xl-1';
        $footer_class[3] = 'col-xl-2 col-lg-3 col-md-4 col-sm-6 offset-xl-1';
        $footer_class[4] = 'col-xl-3 col-lg-3 col-md-5 col-sm-6';
        break;
        default:
        $footer_class = 'col-xl-4 col-lg-4 col-md-6';
        break;
    }

?>

    <footer>
        <div class="footer__area grey-bg" data-bg-color="<?php print esc_attr($bg_color); ?>" data-background="<?php print esc_url($bg_img); ?>">
            <?php if ( is_active_sidebar('footer-3-1') OR is_active_sidebar('footer-3-2') OR is_active_sidebar('footer-3-3') OR is_active_sidebar('footer-3-4') ): ?>
            <div class="footer__top pb-45 pt-100">
                <div class="container">
                    <div class="row">
                        <?php

                            if ( $footer_columns < 4 ) {
                                print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                                dynamic_sidebar( 'footer-3-1');
                                print '</div>';

                                print '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 offset-xl-1">';
                                dynamic_sidebar( 'footer-3-2');
                                print '</div>';

                                print '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 offset-xl-1">';
                                dynamic_sidebar( 'footer-3-3');
                                print '</div>';

                                print '<div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">';
                                dynamic_sidebar( 'footer-3-4');
                                print '</div>';

                            }
                            else{
                                for( $num=1; $num <= $footer_columns; $num++ ) {
                                    if ( !is_active_sidebar( 'footer-3-'. $num ) ) continue;
                                    print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                    dynamic_sidebar( 'footer-3-'. $num );
                                    print '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="footer__copyright">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="footer__copyright-text text-center">
                                <p><?php print markite_copyright_text(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php
}

// markite_copyright_text
function markite_copyright_text(){
   print get_theme_mod('markite_copyright', __('Copyright © 2021 All Rights Reserved, Design by <a href="#">Theme Pure</a>','markite'));
}


/**
 * [markite_breadcrumb_func description]
 * @return [type] [description]
 */
function markite_breadcrumb_func() {
    $breadcrumb_class = '';
    $breadcrumb_class_shape = '';
    $breadcrumb_blog_details_none = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','markite'));
        $breadcrumb_class = 'home_front_page';
        $breadcrumb_class_shape = 'd-none';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','markite'));
        $breadcrumb_show = 0;

    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
        $breadcrumb_blog_details_none = 'd-none';
        $title = get_the_title();
    }
    elseif ( is_single() && 'product' == get_post_type() ) {
       $title = get_the_title();
    }
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'markite' ) . get_search_query();
    }
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'markite' );
    }
    elseif ( function_exists('is_woocommerce') && is_woocommerce()) {
        $title = get_theme_mod('breadcrumb_shop', __('Shop','markite'));
    }
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    }
    else {
        $title = get_the_title();
    }

    $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb') : '';

    if( !empty($_GET['s']) && $_GET['s'] == 'test' ) {
        $is_breadcrumb = false;
    }

    if( empty($is_breadcrumb) && $breadcrumb_show == 1 ) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image') : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image') : '';
        $back_title = function_exists('get_field') ? get_field('breadcrumb_back_title') : '';

        // get_theme_mod
        $bg_img = get_theme_mod('breadcrumb_bg_img');


        if( $hide_bg_img ){
            $bg_img = '';
        }
        else {
          $bg_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
        } ?>


        <!-- bg shape area start -->
        <div class="markit-blog-details-breadcrumb <?php print esc_attr($breadcrumb_blog_details_none); ?>">
         <div class="bg-shape <?php print esc_attr($breadcrumb_class_shape); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/shape-1.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
         </div>
         <!-- bg shape area end -->

         <!-- page title area -->
         <section class="page__title-area  pt-85 <?php print esc_attr($breadcrumb_class); ?>" data-background="<?php print esc_attr($bg_img);?>">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="page__title-content mb-50">
                        <h2 class="page__title"><?php echo wp_kses_post( $title );?></h2>
                        <div class="page_title__bread-crumb">
                            <?php markite_breadcrumb_callback();?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         </div>
         <!-- page title end -->




        <?php
    }
}
add_action('markite_before_main_content', 'markite_breadcrumb_func');


function markite_breadcrumb_callback() {
    $args = array(
        'show_browse'   => false,
        'post_taxonomy' => array( 'product' =>'product_cat' )
    );
    $breadcrumb = new Breadcrumb_Class( $args );

    return $breadcrumb->trail();
}


// gru_search_form
function markite_search_form() { ?>
        <!-- Modal Search -->
        <div class="search-wrap d-none">
            <div class="search-inner">
                <i class="fal fa-times search-close" id="search-close"></i>
                <div class="search-cell">
                    <form method="get" action="<?php print esc_url(home_url('/')); ?>" >
                        <div class="search-field-holder">
                            <input type="search" name="s" class="main-search-input" value="<?php print esc_attr( get_search_query() ) ?>" placeholder="<?php print esc_attr('Search Your Keyword...', 'markite'); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
}

add_action('markite_before_main_content', 'markite_search_form');

/**
*
* pagination
*/
if( !function_exists('markite_pagination') ) {

    function _markite_pagi_callback($pagination) {
        return $pagination;
    }

    //page navegation
    function markite_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if( $pages=='' ){
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if(!$pages)
                $pages = 1;
        }

        $pagination = array(
            'base' => add_query_arg('paged','%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array'
        );

        //rewrite permalinks
        if( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        if( !empty($wp_query->query_vars['s']) )
            $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

        $pagi = '';
        if(paginate_links( $pagination )!=''){
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
                        foreach ($paginations as $key => $pg) {
                            $pagi.= '<li>'.$pg.'</li>';
                        }
            $pagi .= '</ul>';
        }

        print _markite_pagi_callback($pagi);
    }
}

// header top bg color
function markite_breadcrumb_bg_color(){
    $color_code = get_theme_mod( 'markite_breadcrumb_bg_color','#222');
    wp_enqueue_style( 'markite-custom', MARKITE_THEME_CSS_DIR . 'markite-custom.css', array());
    if($color_code!=''){
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: ".$color_code."}";

        wp_add_inline_style('markite-breadcrumb-bg',$custom_css);
    }
}
add_action('wp_enqueue_scripts', 'markite_breadcrumb_bg_color');

// breadcrumb-spacing top
function markite_breadcrumb_spacing(){
    $padding_px = get_theme_mod( 'markite_breadcrumb_spacing','160px');
    wp_enqueue_style( 'markite-custom', MARKITE_THEME_CSS_DIR . 'markite-custom.css', array());
    if($padding_px!=''){
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: ".$padding_px."}";

        wp_add_inline_style('markite-breadcrumb-top-spacing',$custom_css);
    }
}
add_action('wp_enqueue_scripts', 'markite_breadcrumb_spacing');

// breadcrumb-spacing bottom
function markite_breadcrumb_bottom_spacing(){
    $padding_px = get_theme_mod( 'markite_breadcrumb_bottom_spacing','160px');
    wp_enqueue_style( 'markite-custom', MARKITE_THEME_CSS_DIR . 'markite-custom.css', array());
    if($padding_px!=''){
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: ".$padding_px."}";

        wp_add_inline_style('markite-breadcrumb-bottom-spacing',$custom_css);
    }
}
add_action('wp_enqueue_scripts', 'markite_breadcrumb_bottom_spacing');


// scrollup
function markite_scrollup_switch(){
    $scrollup_switch = get_theme_mod( 'markite_scrollup_switch', false);
    wp_enqueue_style( 'markite-custom', MARKITE_THEME_CSS_DIR . 'markite-custom.css', array());
    if($scrollup_switch){
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style('markite-scrollup-switch',$custom_css);
    }
}
add_action('wp_enqueue_scripts', 'markite_scrollup_switch');


// theme color
function markite_custom_color(){
    $color_code = get_theme_mod( 'markite_color_option','#5f3afc');
    wp_enqueue_style( 'markite-custom', MARKITE_THEME_CSS_DIR . 'markite-custom.css', array());
    if($color_code!=''){
        $custom_css = '';
        $custom_css .= ".header__cart a span, .trending__tag a:hover, .product__tag a:hover, .testimonial__slider .owl-dots .owl-dot.active, .footer-style-1 .footer__widget ul li a:hover::after, .testimonial__slider-2 .owl-dots .owl-dot.active, .basic-pagination ul li span.current, .basic-pagination ul li a:hover, .sidebar__widgets .checkbox label input:checked, .product__tab .nav-tabs .nav-link::after, .faq__tab .nav-tabs .nav-item .nav-link::after, .blog__text a:hover::after, .pricing__item.active, .pricing__tab .nav .nav-item .nav-link::after, .tagcloud a:hover, .postbox__tag a:hover, .mf-btn, .hbtn-2, .mbl-btn, .mpc-btn ,.m-btn,.m-btn-border:hover,.p-btn-white:hover,.p-btn-border:hover, .woocommerce a.button, .woocommerce button.button, .dokan-btn.dokan-btn-theme.vendor-dashboard, button#place_order, body.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active, body.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover, body.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover, #bulk-product-action, .dokan-btn.dokan-btn-theme.dokan-add-new-product, .dokan-btn.dokan-btn-sm.dokan-btn-danger.dokan-btn-theme, #bulk-order-action, .dokan-update-setting-top-button.dokan-btn.dokan-btn-theme.dokan-right, .dokan-btn.dokan-btn-danger.dokan-btn-theme, .search-store-products.dokan-btn-theme, body input[type='submit'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme, span.dokan-btn-theme, button.dokan-btn-theme, .top-date a, .blog-arrow a, .new-tab-wrapper button.active, .link_prview:hover, .link_heart, .object, .cta__btn.active, .m-btn-border-2:hover { background: ".$color_code."}";

        $custom_css .= ".main-menu ul li.active > a, .main-menu ul li .submenu li:hover > a, .main-menu ul li:hover > a, .header__login a:hover, .category__title a:hover, .link-btn:hover, .trending__title a:hover, .trending__price span, .product__title a:hover, .product__author a:hover, .testimonial__info span, .section__title span, .footer-style-1 .footer__widget ul li a:hover, .featured__title a:hover, .services__title a:hover, .product__title-2 a:hover, .yith-wcan-filters .yith-wcan-filter .filter-items .filter-item > label > a:hover, .yith-wcan-filters .yith-wcan-filter .filter-items .filter-item.active > label > a, .trail-items li a:hover, .product__proprietor-name h5 a:hover, .product__proprietor-price span, .product__tab .nav-tabs .nav-link.active, .product__tab .nav-tabs .nav-link:hover, .support__thumb p a:hover, .faq__tab-content .accordion-item .accordion-header .accordion-button:hover, .faq__tab-content .accordion-item .accordion-header .accordion-button, .faq__tab-content .accordion-item .accordion-header .accordion-button::after, .faq__tab-content .accordion-item .accordion-header .accordion-button:hover::after, .faq__tab .nav-tabs .nav-item .nav-link.active, .faq__tab .nav-tabs .nav-item .nav-link:hover, .blog__text a:hover, .about__sub-title, .blog__title a:hover, .pricing__tab .nav .nav-item .nav-link.active, .pricing__tab .nav .nav-item .nav-link:hover, .pricing__switch button, .pricing__features ul.price-fe-list li i, .rc-text h6:hover, .sidebar__widget ul li a:hover, .sidebar__widget ul li a:hover::after, .postbox__meta span i, .postbox__meta a:hover, .blog-title:hover, .postbox__details p .highlight, blockquote::before, .logged-in-as a:hover, .postbox__details p.drop-cap::first-letter, .contact__content-title a:hover, .progress-wrap::after,a.m-btn-border, .latest-blog-title a:hover, .woocommerce-message::before, .woocommerce-info::before, .markite-page-content table a, .woocommerce .m-btn-disabled:disabled, body #dokan-store-listing-filter-wrap .right .toggle-view .active, .latest-post-meta span i, .mt_cat_title:hover, .product-remove a.remove:hover::before, .woocommerce-error::before { color: ".$color_code."}";

        $custom_css .= ".hero__search-input input:focus, .category__item:hover, .testimonial__slider .owl-dots .owl-dot.active, .testimonial__slider-2 .owl-dots .owl-dot.active, .documentation__search-input input:focus, .pricing__item.active, .sidebar__search-wrapper input:focus, blockquote, .comment__input textarea:focus, .contact__input input:focus, .contact__input textarea:focus,.m-btn-border:hover,.p-btn-border:hover, .woocommerce-message, .woocommerce-info, .dokan-btn.dokan-btn-theme.vendor-dashboard, .woocommerce .m-btn-disabled:disabled, button#place_order, #bulk-product-action, .dokan-btn.dokan-btn-theme.dokan-add-new-product, .dokan-btn.dokan-btn-sm.dokan-btn-danger.dokan-btn-theme, #bulk-order-action, .dokan-update-setting-top-button.dokan-btn.dokan-btn-theme.dokan-right, .dokan-btn.dokan-btn-danger.dokan-btn-theme, .search-store-products.dokan-btn-theme, body input[type='submit'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme, span.dokan-btn-theme, button.dokan-btn-theme, .new-tab-wrapper button.active, .link_prview:hover, .link_heart, .woocommerce-error, .cta__btn.active, .m-btn-border-2:hover { border-color: ".$color_code."}";

        $custom_css .= ".progress-wrap svg.progress-circle path { stroke: " . $color_code . "}";

        wp_add_inline_style('markite-custom',$custom_css);
    }
}
add_action('wp_enqueue_scripts', 'markite_custom_color');


// markite_kses_intermediate
function markite_kses_intermediate( $string = '' ) {
    return wp_kses( $string, markite_get_allowed_html_tags( 'intermediate' ) );
}

function markite_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
        'a' => [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => []
        ]
    ];

    return $allowed_html;
}

function markite_shop_subscribe() {
  $_shop_id = wc_get_page_id('shop');
  $shop_details_subscribe = function_exists('get_field') ? get_field('shop_details_subscribe' , $_shop_id) : '';
  ?>
    <?php if (!empty($shop_details_subscribe['markite_subs_title'])) : ?>
     <!-- subscribe area start -->
     <section class="subscribe__area p-relative pt-100 pb-110" data-background="<?php echo esc_url( $shop_details_subscribe['markite_subs_img']['url'] ); ?>">
        <div class="subscribe__icon">
           <img class="ps" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/ps.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
           <img class="wp" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/wp.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
           <img class="html" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/html.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
           <img class="f" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/f.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
           <img class="man" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/man.png" alt="<?php  print esc_attr__( 'banner', 'markite' ); ?>">
        </div>
        <div class="container">
           <div class="row">
              <div class="col-xxl-12">
                 <div class="subscribe__content text-center wow fadeInUp" data-wow-delay=".3s">
                    <h3 class="subscribe__title"><?php echo wp_kses_post( $shop_details_subscribe['markite_subs_title'] ); ?></h3>
                    <p><?php echo wp_kses_post( $shop_details_subscribe['markite_subs_sub_title'] ); ?></p>
                    <div class="subscribe__form wow fadeInUp" data-wow-delay=".5s">
                       <?php echo do_shortcode( $shop_details_subscribe['markite_subs_form'] ); ?>
                       <p><?php echo wp_kses_post( $shop_details_subscribe['markite_subs_content'] ); ?></p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- subscribe area end -->
     <?php endif; ?>

<?php
}
add_action('markite_shop_form', 'markite_shop_subscribe', 20);