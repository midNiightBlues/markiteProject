<?php
/**
 * markite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package markite
 */

if ( ! function_exists( 'markite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function markite_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on markite, use a find and replace
		 * to change 'markite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'markite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'markite' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'markite' ),
			'header-top-menu' => esc_html__( 'Header Top Menu', 'markite' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'markite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		//Enable custom header
		add_theme_support('custom-header');

        // enable woocommerce
        add_theme_support('woocommerce');
		

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Enable suporrt for Post Formats
		 *
		 * see: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'audio',
			'video',
			'gallery',
			'quote',
		) );

		// Add theme support for selective refresh for widgets.
		//add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		remove_theme_support( 'widgets-block-editor' );


		add_image_size( 'markite-pro-sm', 500, 598, array('center','center') );
	}
endif;
add_action( 'after_setup_theme', 'markite_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function markite_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'markite_content_width', 640 );
}
add_action( 'after_setup_theme', 'markite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function markite_widgets_init() {

	$footer_style_2_switch = get_theme_mod('footer_style_2_switch', true );
	$footer_style_3_switch = get_theme_mod('footer_style_3_switch', true );
	$footer_style_4_switch = get_theme_mod('footer_style_4_switch', true );

	/**
	* blog sidebar
	*/
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'markite' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar__widget mb-30 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar__widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

    register_sidebar(array(
        'name' => esc_html__('Product Sidebar', 'markite'),
        'id' => 'product-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar__widgets mb-20 %2$s mb-45">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar__widget-head d-flex align-items-center justify-content-between"><h4 class="sidebar__widget-title">',
        'after_title' => '</h4></div>',

    ));


	$footer_widgets = get_theme_mod('footer_widget_number', 4);

	for( $num=1; $num <= $footer_widgets; $num++ ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer '. $num, 'markite'),
			'id'            => 'footer-'. $num,
			'description'   => esc_html__( 'Footer '. $num, 'markite' ),
			'before_widget' => '<div id="%1$s" class="footer__widget mb-40 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer__widget-head"><h4 class="footer__widget-title footer__widget-title-2">',
			'after_title'   => '</h4></div>',
		) );			
	}


	// footer 2
	if ( $footer_style_2_switch ) {
		for( $num=1; $num <= $footer_widgets+1; $num++ ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Style 2: '. $num, 'markite'),
				'id'            => 'footer-2-'. $num,
				'description'   => esc_html__( 'Footer Style 2: '. $num, 'markite' ),
				'before_widget' => '<div id="%1$s" class="footer__widget mb-40 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="footer__widget-head mb-35"><h4 class="footer__widget-title">',
				'after_title'   => '</h4></div>',
			) );			
		}
	}

	// footer 3
	if ( $footer_style_3_switch ) {
		for( $num=1; $num <= $footer_widgets; $num++ ) {
			register_sidebar( array(
				'name'          => esc_html__(  'Footer Style 3: '. $num, 'markite'),
				'id'            => 'footer-3-'. $num,
				'description'   => esc_html__( 'Footer Style 3: '. $num, 'markite' ),
				'before_widget' => '<div id="%1$s" class="footer__widget mb-50 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="footer__widget-title"><h4>',
				'after_title'   => '</h4></div>',
			) );			
		}
	}		

	// footer 4
	if ( $footer_style_4_switch ) {
		for( $num=1; $num <= $footer_widgets; $num++ ) {
			register_sidebar( array(
				'name'          => esc_html__(  'Footer Style 4: '. $num, 'markite'),
				'id'            => 'footer-4-'. $num,
				'description'   => esc_html__( 'Footer Style 4: '. $num, 'markite' ),
				'before_widget' => '<div id="%1$s" class="footer__widget mb-50 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="footer__widget-title"><h4>',
				'after_title'   => '</h4></div>',
			) );			
		}
	}	

	/**
	* Service Widget
	*/
	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Service Sidebar', 'markite' ),
			'id' 			=> 'services-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown on Service Details Sidebar.', 'markite' ),
			'before_widget' => '<div class="services__widget grey-bg-18 mb-40 %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="services__widget-title"><h4>',
			'after_title' 	=> '</h4></div>',
		)
	);	

	/**
	* Portfolio Widget
	*/
	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Portfolio Sidebar', 'markite' ),
			'id' 			=> 'portfolio-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown on Portfolio Details Sidebar.', 'markite' ),
			'before_title' 	=> '<div class="widget-title-box mb-30"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
			'before_widget' => '<div class="service-widget sidebar-wrap widget mb-50 %2$s">',
			'after_widget' 	=> '</div>',
		)
	);	




}
add_action( 'widgets_init', 'markite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

define('MARKITE_THEME_DIR', get_template_directory());
define('MARKITE_THEME_URI', get_template_directory_uri());
define('MARKITE_THEME_CSS_DIR', MARKITE_THEME_URI . '/assets/css/');
define('MARKITE_THEME_JS_DIR', MARKITE_THEME_URI . '/assets/js/');
define('MARKITE_THEME_INC', MARKITE_THEME_DIR . '/inc/');

/** 
 * markite_scripts description
 * @return [type] [description]
 */
function markite_scripts() {
	/**
	* all css files
	*/

	wp_enqueue_style( 'markite-fonts', markite_fonts_url(), array(), '1.0.0' );

	if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', MARKITE_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', MARKITE_THEME_CSS_DIR.'bootstrap.min.css', array() );
    }

	wp_enqueue_style( 'preloader', MARKITE_THEME_CSS_DIR.'preloader.css', array() );
	wp_enqueue_style( 'slick', MARKITE_THEME_CSS_DIR.'slick.css', array() );
	wp_enqueue_style( 'meanmenu', MARKITE_THEME_CSS_DIR.'meanmenu.css', array() );
	wp_enqueue_style( 'owl-carousel', MARKITE_THEME_CSS_DIR.'owl.carousel.min.css', array() );
	wp_enqueue_style( 'animate', MARKITE_THEME_CSS_DIR.'animate.min.css', array() );
	wp_enqueue_style( 'backootop', MARKITE_THEME_CSS_DIR.'backToTop.css', array() );
	wp_enqueue_style( 'jquery-fancybox', MARKITE_THEME_CSS_DIR.'jquery.fancybox.min.css', array() );
	wp_enqueue_style( 'fontawesome-pro', MARKITE_THEME_CSS_DIR.'fontAwesome5Pro.css', array() );
	wp_enqueue_style( 'elegantfont', MARKITE_THEME_CSS_DIR.'elegantFont.css', array() );
	wp_enqueue_style( 'nice-select', MARKITE_THEME_CSS_DIR.'nice-select.css', array() );
	wp_enqueue_style( 'imagetooltip', MARKITE_THEME_CSS_DIR.'imagetooltip.min.css', array() );
	wp_enqueue_style( 'markite-default', MARKITE_THEME_CSS_DIR.'default.css', array() );
	wp_enqueue_style( 'markite-core', MARKITE_THEME_CSS_DIR.'markite-core.css', array() );
	wp_enqueue_style( 'markite-unit', MARKITE_THEME_CSS_DIR.'markite-unit.css', array() );
	wp_enqueue_style( 'markite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'markite-responsive', MARKITE_THEME_CSS_DIR.'responsive.css', array() );


	// all js
	wp_enqueue_script( 'bootstrap-bundle', MARKITE_THEME_JS_DIR.'bootstrap.bundle.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'waypoints', MARKITE_THEME_JS_DIR.'waypoints.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'jquery-meanmenu', MARKITE_THEME_JS_DIR.'jquery.meanmenu.js', array('jquery'), '', true );
	wp_enqueue_script( 'slick', MARKITE_THEME_JS_DIR.'slick.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'jquery-fancybox', MARKITE_THEME_JS_DIR.'jquery.fancybox.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'countdown', MARKITE_THEME_JS_DIR.'countdown.js', array('jquery'), false, true );
	wp_enqueue_script( 'isotope-pkgd', MARKITE_THEME_JS_DIR.'isotope.pkgd.min.js', array('imagesloaded'), false, true );
	wp_enqueue_script( 'parallax', MARKITE_THEME_JS_DIR.'parallax.min.js', array('imagesloaded'), false, true );
	wp_enqueue_script( 'owl-carousel', MARKITE_THEME_JS_DIR.'owl.carousel.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'backtotop', MARKITE_THEME_JS_DIR.'backToTop.js', array('jquery'), false, true );
	wp_enqueue_script( 'jquery-nice-select', MARKITE_THEME_JS_DIR.'jquery.nice-select.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'jquery-counterup', MARKITE_THEME_JS_DIR.'jquery.counterup.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'imagetooltip', MARKITE_THEME_JS_DIR.'imagetooltip.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'wow', MARKITE_THEME_JS_DIR.'wow.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'markite-main', MARKITE_THEME_JS_DIR.'main.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'markite_scripts' );

/*
Register Fonts
*/
function markite_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'markite' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Be Vietnam:300,400,500,600,700,800' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}



// wp_body_open
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
            do_action( 'wp_body_open' );
    }
}



/**
 * Implement the Custom Header feature.
 */
require MARKITE_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require MARKITE_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require MARKITE_THEME_INC . 'template-helper.php';

if (!defined('MARKITE_WOOCOMMERCE_ACTIVED')) {
    define('MARKITE_WOOCOMMERCE_ACTIVED', in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))));
}

define('MARKITE_WISHLIST_ACTIVED', in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))));

define('MARKITE_QUICK_VIEW_ACTIVED', in_array('yith-woocommerce-quick-view/init.php', apply_filters('active_plugins', get_option('active_plugins'))));

if (MARKITE_WOOCOMMERCE_ACTIVED) {
    require_once MARKITE_THEME_INC . 'markite-woocommerce.php';
}


/**
 * initialize kirki customizer class.
 */
include_once MARKITE_THEME_INC . 'kirki-customizer.php';
include_once MARKITE_THEME_INC . 'class-markite-kirki.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require MARKITE_THEME_INC . 'jetpack.php';
}

/**
* include markite functions file
*/
require_once MARKITE_THEME_INC . 'class-breadcrumb.php';
require_once MARKITE_THEME_INC . 'class-navwalker.php';
require_once MARKITE_THEME_INC . 'class-tgm-plugin-activation.php';
require_once MARKITE_THEME_INC . 'add_plugin.php';



/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function markite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'markite_pingback_header' );


/**
*
* comment section
*
*/
add_filter('comment_form_default_fields', 'markite_comment_form_default_fields_func');

function markite_comment_form_default_fields_func($default){

	$default['author'] = '<div class="row">
    <div class="col-xl-6 col-md-6">
    	<div class="comment__input-wrapper mb-25">
    		<h5>Full Name</h5>
    		<div class="comment__input">
        		<input type="text" name="author" placeholder="'.esc_attr__('Full name','markite').'">
        		<i class="fal fa-user"></i>
        	</div>
        </div>
    </div>';
	$default['email'] = '
	<div class="col-xl-6 col-md-6">
		<div class="comment__input-wrapper mb-25">
			<h5>Work email</h5>
			<div class="comment__input">
        		<input type="text" name="email" placeholder="'.esc_attr__('Your Email','markite').'">
        		<i class="fal fa-envelope"></i>
    		</div>
    	</div>
    </div>';
	$defaults['comment_field'] = '';

	$default['comapny'] = '<div class="col-xl-6">
		<div class="comment__input-wrapper mb-25">
			<h5>Company Name</h5>
			<div class="comment__input">
		        <input type="text" name="comapny" placeholder="'.esc_attr__('Company Name','markite').'">
		        <i class="fal fa-smile"></i>
	    	</div>
    	</div>
    </div>';

	$default['url'] = '<div class="col-xl-6">
		<div class="comment__input-wrapper mb-25">
			<h5>Website</h5>
			<div class="comment__input">
		        <input type="text" name="url" placeholder="'.esc_attr__('Website','markite').'">
		        <i class="fal fa-globe"></i>
	    	</div>
    	</div>
    </div>';

	return $default;
}

add_action( 'comment_form_top', 'markite_add_comments_textarea' );
function markite_add_comments_textarea()
{
	if( !is_user_logged_in() ){
    echo '<div class="row">
    <div class="col-xl-12">
    	<div class="comment__input-wrapper">
	    	<h5>Comment</h5>
	    		<div class="comment__input textarea mb-25">
		    		<textarea id="comment" name="comment" cols="60" rows="6" placeholder="'.esc_attr__('Write your comment here...','markite').'" aria-required="true"></textarea>
		    		<i class="fal fa-comment"></i>
		    	</div>
	    	</div>
	    </div>
    </div>';
	}
}

add_filter('comment_form_defaults', 'markite_comment_form_defaults_func');

function markite_comment_form_defaults_func($info){
	if( !is_user_logged_in() ){
		$info['comment_field'] = '';
		$info['submit_field'] = '%1$s %2$s</div>';
	}else {
		$info['comment_field'] = '<div class="comment__input-wrapper mt-25">
		<h5>Comment</h5>
		<div class="comment__input textarea mb-25">
		<textarea id="comment" name="comment" cols="30" rows="10" placeholder="'.esc_attr__('Write your comment here...','markite').'"></textarea> <i class="fal fa-comment"></i></div>';
        $info['submit_field'] = '%1$s %2$s</div>';
	}


	$info['submit_button'] = '<div class="col-xl-12"><button class="m-btn m-btn-4 mpc-btn" type="submit">'.esc_html__('Post Comment','markite').' </button></div>';

	$info['title_reply_before'] = '<div class="post-comments-title mb-40">
                                        <h3>';
	$info['title_reply_after'] = '</h3></div>';
	$info['comment_notes_before'] = '';

	return $info;
}

if( !function_exists('markite_comment') ) {
	function markite_comment($comment, $args, $depth) {
		$GLOBAL['comment'] = $comment;
		extract($args, EXTR_SKIP);
		$args['reply_text'] = '<i class="fal fa-comment-alt-dots"></i> Reply';
		$replayClass = 'comment-depth-' . esc_attr($depth);
		?>
			<li id="comment-<?php comment_ID(); ?>">
				<div class="comments-box grey-bg-2">
					<div class="comments-avatar">
						<?php print get_avatar($comment, 102, null, null, array('class'=> array())); ?>
					</div>
					<div class="comments-text">
						<div class="avatar-name">
							<h5><?php print get_comment_author_link(); ?></h5>
							<span><?php comment_time( get_option('date_format') ); ?></span>
						</div>
						<?php comment_text(); ?>
						<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?>
					</div>
				</div>
		<?php
	}
}



/**
* shortcode supports for removing extra p, spance etc
*
*/
add_filter( 'the_content', 'markite_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function markite_shortcode_extra_content_remove( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}


// markite_search_filter_form
if( !function_exists('markite_search_filter_form')) {
  function markite_search_filter_form( $form ) {
    
    $form = sprintf( 
    	'<div class="sidebar__widget-content"><div class="sidebar__search-wrapper"><form class="sidebar-widget-form" action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="fal fa-search"></i>  </button>
		</form></div></div>',
		esc_url( home_url('/') ),
		esc_attr( get_search_query() ),
		esc_html__('Search','markite')
	);

    return $form;
  }
  add_filter( 'get_search_form','markite_search_filter_form');
}

add_action('admin_enqueue_scripts', 'markite_admin_custom_scripts');

add_action('admin_enqueue_scripts', 'markite_admin_custom_scripts');

function markite_admin_custom_scripts() {
	wp_enqueue_media();
	wp_register_script('markite-admin-custom', get_template_directory_uri().'/inc/js/admin_custom.js', array('jquery'), '', true);
	wp_enqueue_script('markite-admin-custom');
}