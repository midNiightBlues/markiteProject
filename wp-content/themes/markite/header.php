<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package markite
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <?php endif; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- <meta name="google-site-verification" content="uv5x6ZnrbKIluPUGsibkO70f2v2jCGfiDMAEwDzfyuQ" />
   <meta name="p:domain_verify" content="91aa8383706cae820734ec39c7315d25"/> -->
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

    <?php    
        $markite_preloader = get_theme_mod('markite_preloader', true); 
    ?>

    <?php if(!empty($markite_preloader)) : ?>
      
     <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <div class="object" id="object_one"></div>
               <div class="object" id="object_two"></div>
               <div class="object" id="object_three"></div>
               <div class="object" id="object_four"></div>
               <div class="object" id="object_five"></div>
            </div>
         </div>  
      </div>
      <!-- pre loader area end -->
      <?php endif; ?>
    


    <!-- back to top start -->
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <!-- back to top end -->

    

    <!-- header start -->
    <?php do_action('markite_header_style'); ?>
    <!-- header end -->
    <!-- wrapper-box start -->
    <?php do_action('markite_before_main_content'); ?>
    





        