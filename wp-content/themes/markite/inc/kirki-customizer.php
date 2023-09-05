<?php
/**
 * markite customizer
 *
 * @package markite
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/**
* Added Panels & Sections
*/
function markite_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'markite_customizer', array(
      'priority'    => 10,
      'title'       => esc_html__( 'Markite Customizer', 'markite' ),
    ) );


    /**
     * Customizer Section
     */
   	$wp_customize->add_section('header_top_setting', array(
        'title'       => esc_html__( 'Header Topbar Setting', 'markite' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));     

    $wp_customize->add_section('header_social', array(
        'title'       => esc_html__( 'Header Social', 'markite' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));    

    $wp_customize->add_section('section_header_logo', array(
        'title'       => esc_html__( 'Header Setting', 'markite' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));
	
	$wp_customize->add_section('blog_setting', array(
        'title'       => esc_html__( 'Blog Setting', 'markite' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));     

    $wp_customize->add_section('header_side_setting', array(
        'title'       => esc_html__( 'Side Info', 'markite' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));  
	
    $wp_customize->add_section('breadcrumb_setting', array(
        'title'       => esc_html__( 'Breadcrumb Setting', 'markite' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));      

    $wp_customize->add_section('blog_setting', array(
        'title'       => esc_html__( 'Blog Setting', 'markite' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    )); 

    $wp_customize->add_section('footer_setting', array(
        'title'       => esc_html__( 'Footer Settings', 'markite' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));        

    $wp_customize->add_section('color_setting', array(
        'title'       => esc_html__( 'Color Setting', 'markite' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    )); 

    $wp_customize->add_section('404_page', array(
        'title'       => esc_html__( '404 Page', 'markite' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    ));     


    $wp_customize->add_section('product_setting', array(
        'title'       => esc_html__( 'Product Setting', 'markite' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'markite_customizer',
    )); 
}

add_action( 'customize_register', 'markite_customizer_panels_sections' );



function _header_top_fields($fields) {

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_topbar_switch',
        'label'       => esc_html__( 'Topbar Swicher', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );    

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_cart_hide',
        'label'       => esc_html__( 'Show Cart', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_preloader',
        'label'       => esc_html__( 'Preloader On/Off', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );      

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_header_right',
        'label'       => esc_html__( 'Header Right On/Off', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );    

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_show_button',
        'label'       => esc_html__( 'Show Button On/Off', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );    

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_mail_id',
        'label'    => esc_html__( 'Mail ID', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'info@webmail.com', 'markite' ),
        'priority' => 10,
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_phone',
        'label'    => esc_html__( 'Phone Number', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '+876 864 764 764', 'markite' ),
        'priority' => 10,
    );    

    $fields[] = array(
        'type'     => 'textarea',
        'settings' => 'markite_welcome_text',
        'label'    => esc_html__( 'Welcome Text', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Welcome to Given. Most Popular Crowdfounding Agency', 'markite' ),
        'priority' => 10,
    );    

    $fields[] = array(
        'type'     => 'textarea',
        'settings' => 'markite_address',
        'label'    => esc_html__( 'Header Address', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '250 Main Street, 2nd Floor,USA', 'markite' ),
        'priority' => 10,
    );    

    // button
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_button_text',
        'label'    => esc_html__( 'Button Text', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Get A Quote', 'markite' ),
        'priority' => 10,
    );       

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_button_link',
        'label'    => esc_html__( 'Button URL', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );
    // login button
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markit_btn_login_text',
        'label'    => esc_html__( 'Sign Button Text', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Sign In', 'markite' ),
        'priority' => 10,
    );  

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markit_btn_login_link',
        'label'    => esc_html__( 'Sign Button URL', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    ); 

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_notifi',
        'label'       => esc_html__( 'Active Top Notification', 'markite' ),
        'section'     => 'header_top_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'notifi_img',
        'label'       => esc_html__( 'Notification Background', 'markite' ),
        'description' => esc_html__( 'Upload Your Image.', 'markite' ),
        'section'     => 'header_top_setting',
        'active_callback' => [
            [
                'setting'  => 'markite_notifi',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'notifi_img_link',
        'label'    => esc_html__( 'Image link', 'markite' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'markite_notifi',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'notifi_countdown',
        'label'    => esc_html__( 'Add CountDown Date', 'markite' ),
        'section'  => 'header_top_setting',
        'description'  => esc_html__( 'please, maintain the serial otherwise you will not get the perfect output. Example: Year/Month/Day', 'markite' ),
        'default'  => esc_html__( '2023/01/11', 'markite' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'markite_notifi',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ); 

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );


/*
Header Social
 */
function _header_social_fields($fields) {
    // header section social
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'markite' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );    

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'markite' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );    

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'markite' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'markite' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'markite' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );

    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
Header Settings
 */
function _header_header_fields($fields) {

    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Choose Header Style', 'markite' ),
        'section'     => 'section_header_logo',
        'default'     => 'header-style-1',
        'placeholder' => esc_html__( 'Select an option...', 'markite' ),
        'priority'    => 10,
        'choices'     => [
            'header-style-1' => esc_html__( 'Header Style 1', 'markite' ),
            'header-style-2' => esc_html__( 'Header Style 2', 'markite' ),
            'header-style-3' => esc_html__( 'Header Style 3', 'markite' ),
            'header-style-4' => esc_html__( 'Header Style 4', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'markite' ),
        'description' => esc_html__( 'Upload Your Logo.', 'markite' ),
        'section'     => 'section_header_logo',
        'default' => get_template_directory_uri() . '/assets/img/logo/logo.png'
    );    

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Logo', 'markite' ),
        'description' => esc_html__( 'Header Black Logo', 'markite' ),
        'section'     => 'section_header_logo',
        'default' => get_template_directory_uri() . '/assets/img/logo/logo-white.png'
    );    

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'favicon_url',
        'label'       => esc_html__( 'Favicon', 'markite' ),
        'description' => esc_html__( 'Favicon Icon', 'markite' ),
        'section'     => 'section_header_logo',
        'default' => get_template_directory_uri() . '/assets/img/favicon.png'
    );

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields($fields) {
    // side info settings 
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_hamburger_hide',
        'label'       => esc_html__( 'Show Hamburger On/Off', 'markite' ),
        'section'     => 'header_side_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );
    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'markite_extra_info_logo',
        'label'       => esc_html__( 'Logo Side', 'markite' ),
        'description' => esc_html__( 'Logo Side', 'markite' ),
        'section'     => 'header_side_setting',
        'default' => get_template_directory_uri() . '/assets/img/logo/logo-white.png'
    );    
    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields($fields) {
    // Breadcrumb Setting 
    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'markite' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'markite' ),
        'section'     => 'breadcrumb_setting',
        'default' => get_template_directory_uri() . '/assets/img/bg/page-title-bg.jpg'
    );
    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'markite_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'markite' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'markite' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority' => 10,
    );
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_extra_email',
        'label'    => esc_html__( 'Breadcrumb Padding Top', 'markite' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '160px', 'markite' ),
        'priority' => 10,
    );     
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_breadcrumb_bottom_spacing',
        'label'    => esc_html__( 'Breadcrumb Padding Bottom', 'markite' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '160px', 'markite' ),
        'priority' => 10,
    );     

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_breadcrumb_bottom_spacing',
        'label'    => esc_html__( 'Breadcrumb Padding Bottom', 'markite' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( '160px', 'markite' ),
        'priority' => 10,
    ); 
    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields($fields) {
// Blog Setting
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_blog_btn_switch',
        'label'       => esc_html__( 'Blog BTN On/Off', 'markite' ),
        'section'     => 'blog_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'markite' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'markite' ),
        'priority' => 10,
    );     
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_blog_btn_rtl',
        'label'    => esc_html__( 'Blog Button text rtl', 'markite' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'markite' ),
        'priority' => 10,
    );     

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'markite' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'markite' ),
        'priority' => 10,
    );     

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'markite' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'markite' ),
        'priority' => 10,
    ); 
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields($fields) {
    // Footer Setting
    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => 'footer-style-1',
        'placeholder' => esc_html__( 'Select an option...', 'markite' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1' => esc_html__( 'Footer Style 1', 'markite' ),
            'footer-style-2' => esc_html__( 'Footer Style 2', 'markite' ),
        ],
    );    

    $fields[] = array(
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'markite' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'markite' ),
            '3' => esc_html__( 'Widget Number 3', 'markite' ),
            '2' => esc_html__( 'Widget Number 2', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'markite_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'markite' ),
        'description' => esc_html__( 'Footer Background Image.', 'markite' ),
        'section'     => 'footer_setting',
        'default' => get_template_directory_uri() . '/assets/img/logo/logo.png'
    ); 
    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'markite_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'markite' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => '#f4f9fc',
        'priority' => 10,
    );    

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'markite_footer_logo',
        'label'       => esc_html__( 'Footer Logo.', 'markite' ),
        'description' => esc_html__( 'Footer Logo.', 'markite' ),
        'section'     => 'footer_setting',
        'default' => get_template_directory_uri() . '/assets/img/logo/logo.png'
    ); 
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_footer_social',
        'label'       => esc_html__( 'Footer Social On/Off', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );     
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'markite_footer_menu',
        'label'       => esc_html__( 'Footer Menu On/Off', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );       
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'footer_style_2_switch',
        'label'       => esc_html__( 'Footer Style 2 On/Off', 'markite' ),
        'section'     => 'footer_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_copyright',
        'label'    => esc_html__( 'Copy Right', 'markite' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2021 BDevs. All Rights Reserved', 'markite' ),
        'priority' => 10,
    ); 
    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function markite_color_fields( $fields ) {  
    // Color Settings
    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'markite_color_option',
        'label'       => __( 'Theme Color', 'markite' ),
        'description' => esc_html__( 'This is a Theme color control.', 'markite' ),
        'section'     => 'color_setting',
        'default'     => '#5f3afc',
        'priority' => 10,
    );     
    return $fields; 
}
add_filter( 'kirki/fields', 'markite_color_fields' );

// 404 
function markite_404_fields( $fields ) {  
    // 404 settings
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_error_404_text',
        'label'    => esc_html__( '400 Text', 'markite' ),
        'section'  => '404_page',
        'default'  => esc_html__( '404', 'markite' ),
        'priority' => 10,
    ); 
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_error_title',
        'label'    => esc_html__( 'Not Found Title', 'markite' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'markite' ),
        'priority' => 10,
    );   
    $fields[] = array(
        'type'     => 'textarea',
        'settings' => 'markite_error_desc',
        'label'    => esc_html__( '404 Description Text', 'markite' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'markite' ),
        'priority' => 10,
    );     
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'markite' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'markite' ),
        'priority' => 10,
    ); 
    return $fields;

}
add_filter( 'kirki/fields', 'markite_404_fields' );

/**
* Product Fields
*/
function markite_product_fields( $fields ) {   
    // product settings
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_author_by',
        'label'    => esc_html__( 'Product Author By', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( 'By', 'markite' ),
        'priority' => 10,
    );  
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_cat_in',
        'label'    => esc_html__( 'Product Cat In', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( 'In', 'markite' ),
        'priority' => 10,
    ); 
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_details_button',
        'label'    => esc_html__( 'Details Button', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( 'Details', 'markite' ),
        'priority' => 10,
    );     
    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_free_price',
        'label'    => esc_html__( 'Free label', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( 'Free', 'markite' ),
        'priority' => 10,
    ); 
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'product_action_switch',
        'label'       => esc_html__( 'Product Action On/Off', 'markite' ),
        'section'     => 'product_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );     
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'product_cart_btn_switch',
        'label'       => esc_html__( 'Add To Cart BTN On/Off', 'markite' ),
        'section'     => 'product_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );    
    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'product_author_switch',
        'label'       => esc_html__( 'Author On/Off', 'markite' ),
        'section'     => 'product_setting',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'markite' ),
            'off' => esc_html__( 'Disable', 'markite' ),
        ],
    );

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_pro_banner_title',
        'label'    => esc_html__( 'Product Banner Title', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( 'Check Out Our free Templates', 'markite' ),
        'priority' => 10,
    ); 

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_banner_btn_text',
        'label'    => esc_html__( 'Banner BTN Text', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( ' free template', 'markite' ),
        'priority' => 10,
    );       

    $fields[] = array(
        'type'     => 'text',
        'settings' => 'markite_banner_btn_link',
        'label'    => esc_html__( 'Banner BTN URL', 'markite' ),
        'section'  => 'product_setting',
        'default'  => esc_html__( '#', 'markite' ),
        'priority' => 10,
    );

    $fields[] = array(
        'type'        => 'image',
        'settings'    => 'pro_banner_bg',
        'label'       => esc_html__( 'Product Banner BG', 'markite' ),
        'description' => esc_html__( 'Upload Your Banner.', 'markite' ),
        'section'     => 'product_setting',
        'default' => get_template_directory_uri() . '/assets/img/product/banner-bg.jpg'
    ); 

    return $fields;
}

add_filter( 'kirki/fields', 'markite_product_fields' );/**


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function markite_theme_option( $name ) {
	$value = '';
    if ( class_exists( 'markite' ) )
        $value = Kirki::get_option(markite_get_theme(), $name ); 

    return apply_filters( 'markite_theme_option', $value, $name );
}

/**
* Get config ID
*
* @return string
*/
function markite_get_theme() {
    return 'markite';
}