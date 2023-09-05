<?php

namespace BdevsElement\Widget;

use Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Testimonial_Slider extends BDevs_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'testimonial_slider';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __( 'Testimonial Slider', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/slider/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-blockquote';
    }

    public function get_keywords() {
        return ['slider', 'testimonial', 'gallery', 'carousel'];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'bdevs-element' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Sub Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Sub Title', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Title', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Description', 'bdevs-element' ),
                'placeholder' => __( 'Type Description', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => __( 'Title HTML Tag', 'bdevs-element' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h2',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Alignment', 'bdevs-element' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'type'    => Controls_Manager::MEDIA,
                'label'   => __( 'Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // icon
        $this->start_controls_section(
            '_section_mediad',
            [
                'label' => __( 'Icon / Image', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label'          => __( 'Media Type', 'bdevs-element' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => __( 'Icon', 'bdevs-element' ),
                        'icon'  => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'bdevs-element' ),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label'     => __( 'Image', 'bdevs-element' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image',
                ],
                'dynamic'   => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_icon',
                'default'   => 'medium_large',
                'separator' => 'none',
                'exclude'   => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail',
                ],
                'condition' => [
                    'type' => 'image',
                ],
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'icon',
                [
                    'label'       => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type'        => Controls_Manager::ICON,
                    'options'     => bdevs_element_get_bdevs_element_icons(),
                    'default'     => 'fa fa-smile-o',
                    'condition'   => [
                        'type' => 'icon',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'selected_icon',
                [
                    'type'             => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block'      => true,
                    'default'          => [
                        'value'   => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition'        => [
                        'type' => 'icon',
                    ],
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Slides', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'type'    => Controls_Manager::MEDIA,
                'label'   => __( 'profile Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ], 
            ]
        );

        $repeater->add_control(
            'message',
            [
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label'  => false,
                'placeholder' => __( 'Message', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis similique vitae, molestias deleniti', 'bdevs-element' ),
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label'  => false,
                'placeholder' => __( 'Client Name', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __( 'Tom Holand', 'bdevs-element' ),
            ]
        );

        $repeater->add_control(
            'designation_name',
            [
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label'  => false,
                'placeholder' => __( 'Designation Name', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __( 'CEO', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label'  => false,
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '<# print(client_name || "Carousel Item"); #>',
                'default'     => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium_large',
                'separator' => 'before',
                'exclude'   => [
                    'custom',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ],
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // message
        $this->add_control(
            '_content_message',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Message', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'message_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-message' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'message_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-message' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'message',
                'selector' => '{{WRAPPER}} .bdevs-el-message',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );


        // author
        $this->add_control(
            '_heading_author',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Author', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'author_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-author' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-author' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author',
                'selector' => '{{WRAPPER}} .bdevs-el-author',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // designation
        $this->add_control(
            '_heading_designation',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Designation', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'designation_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation',
                'selector' => '{{WRAPPER}} .bdevs-el-designation',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();


        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $title = bdevs_element_kses_basic( $settings['title'] );
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title section__title-4' );
        ?>
    <?php if ( $settings['design_style'] == 'style_4' ):


        $title = bdevs_element_kses_basic( $settings['title'] );
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title-5 mb-15 bdevs-el-title' );


    ?>

        <section class="testimonial__area dark-blue-bg pt-110 pb-200 fix p-relative">
            <?php if ( !empty($settings['shape_switch']) ): ?>
            <div class="testimonial__5-img d-none d-md-block">
               <img class="testi-big testi-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-1.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-big testi-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-2.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-big testi-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-3.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-big testi-4" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-4.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-big testi-5" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-5.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-sm testi-6" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-sm-1.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="testi-sm testi-7" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-5/testi-sm-2.jpg" alt="<?php print esc_attr__('image','wetland'); ?>">
            </div>
            <?php endif;?>  
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3">
                     <div class="section__title-wrapper section__title-wrapper-5 section__title-white text-center mb-55 wow fadeInUp2" data-wow-delay=".3s">
                        <?php if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                bdevs_element_kses_basic( $settings['title' ] )
                                );
                        endif;
                        ?>
                        <?php if ( $settings['description'] ) : ?>
                            <p class="bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-10 offset-md-1">
                     <div class="testimonial__slider-5 owl-carousel pb-10">
                        <?php foreach ( $settings['slides'] as $slide ):
                            if ( !empty( $slide['image']['id'] ) ) {
                                $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                            }
                        ?>
                        <div class="testimonial__item-5 text-center">
                            <?php if ( $slide['message'] ): ?>
                                <p class="bdevs-el-message"><?php echo bdevs_element_kses_basic( $slide['message'] ); ?></p>
                            <?php endif;?>

                           <div class="testimonial__info">
                                <?php if ( !empty( $slide['client_name'] ) ): ?>
                                    <h4 class="bdevs-el-author"><?php echo bdevs_element_kses_basic( $slide['client_name'] ); ?></h4>
                                <?php endif;?>

                                <?php if ( !empty( $slide['designation_name'] ) ): ?>
                                    <span class="bdevs-el-designation"><?php echo bdevs_element_kses_basic( $slide['designation_name'] ); ?></span>
                                <?php endif;?>
                           </div>
                        </div>
                        <?php endforeach;?>
                     </div>
                  </div>
               </div>
            </div>
        </section>

    <?php elseif ( $settings['design_style'] == 'style_3' ): 

        $title = bdevs_element_kses_basic( $settings['title'] );
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title section__title-4 bdevs-el-title' );

    ?>

      <section class="testimonial__area pt-105 pb-175 overflow-y-visible p-relative z-index-1">
        <?php if ( !empty($settings['shape_switch']) ): ?>
         <div class="testimonial__shape-4">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-4/testi-shape.png" alt="<?php print esc_attr__('image','wetland'); ?>">
         </div>
        <?php endif;?>   
         <div class="container">
            <div class="row">
               <div class="col-xxl-8 offset-xxl-2">
                  <div class="section__title-wrapper section__title-wrapper-4 text-center mb-50 wow fadeInUp2" data-wow-delay=".3s">
                        <?php if ( $settings['title' ] ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    bdevs_element_kses_basic( $settings['title' ] )
                                    );
                            endif;
                        ?>
                        <?php if ( $settings['description'] ) : ?>
                            <p class="bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif; ?>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xxl-12">
                    <div class="testimonial__slider-3 testimonial__slider-4 owl-carousel wow fadeInUp2" data-wow-delay=".5s">
                        <?php foreach ( $settings['slides'] as $slide ):
                                if ( !empty( $slide['image']['id'] ) ) {
                                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                                }
                        ?>
                        <div class="testimonial__item-3 white-bg mb-30">
                            <div class="rating">
                               <ul>
                                  <li><i class="icon_star"></i></li>
                                  <li><i class="icon_star"></i></li>
                                  <li><i class="icon_star"></i></li>
                                  <li><i class="icon_star"></i></li>
                                  <li><i class="icon_star"></i></li>
                               </ul>
                            </div>

                            <?php if ( $slide['message'] ): ?>
                               <div class="testimonial__text-4">
                                  <p class="bdevs-el-message"><?php echo bdevs_element_kses_basic( $slide['message'] ); ?></p>
                               </div>
                            <?php endif;?>
                            <div class="testimonial__person d-flex align-items-center">
                                <?php if ( !empty( $image ) ): ?>
                                    <div class="testimonial__avater mr-20">
                                        <img src="<?php print esc_url( $slide['image']['url'] );?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                    </div>
                                <?php endif;?>
                               <div class="testimonial__author-3">
                                    <?php if ( !empty( $slide['client_name'] ) ): ?>
                                        <h4 class="bdevs-el-author"><?php echo bdevs_element_kses_basic( $slide['client_name'] ); ?></h4>
                                    <?php endif;?>

                                    <?php if ( !empty( $slide['designation_name'] ) ): ?>
                                        <span class="bdevs-el-designation"><?php echo bdevs_element_kses_basic( $slide['designation_name'] ); ?></span>
                                    <?php endif;?>
                               </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                  </div>
               </div>
            </div>
         </div>
      </section>

     <?php elseif ( $settings['design_style'] == 'style_2' ):

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title section__title-3 section-mb-15' );            

        if ( !empty( $settings['image']['id'] ) ) {
                $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['thumbnail_size'] );
        }

        ?>

        <section class="testimonial__area fix">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="testimonial__wrapper p-relative pb-135 wow fadeInUp2" data-wow-delay=".5s">
                        <?php if ( !empty($image) ) : ?>
                        <div class="testimonial__shape">
                           <img src="<?php echo esc_url($image); ?>" alt="img">
                        </div>
                        <?php endif; ?>

                        <div class="testimonial__slider-2 owl-carousel">
                            <?php foreach ( $settings['slides'] as $slide ):
                                if ( !empty( $slide['image']['id'] ) ) {
                                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                                }
                            ?>
                           <div class="testimonial__item-2">
                              <div class="testimonial__person-wrapper">
                                 <div class="testimonial__person d-flex">
                                    <?php if ( !empty( $image ) ): ?>
                                    <div class="testimonial__avater">
                                       <img src="<?php print esc_url( $slide['image']['url'] );?>" alt="img">
                                    </div>
                                    <?php endif;?>

                                    <div class="testimonial__info ml-15">
                                        <?php if ( !empty( $slide['client_name'] ) ): ?>
                                            <h5 class="bdevs-el-author"><?php echo bdevs_element_kses_basic( $slide['client_name'] ); ?></h5>
                                        <?php endif;?>

                                        <?php if ( !empty( $slide['designation_name'] ) ): ?>
                                            <span class="bdevs-el-designation"><?php echo bdevs_element_kses_basic( $slide['designation_name'] ); ?></span>
                                        <?php endif;?>
                                    </div>

                                 </div>
                              </div> 

                              <div class="testimonial__text testimonial__text-2 white-bg mt--40">
                                 <div class="rating mb-5">
                                    <ul>
                                       <li><a href="#"><i class="fas fa-star"></i></a></li>
                                       <li><a href="#"><i class="fas fa-star"></i></a></li>
                                       <li><a href="#"><i class="fas fa-star"></i></a></li>
                                       <li><a href="#"><i class="fas fa-star"></i></a></li>
                                       <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    </ul>
                                 </div>

                                <?php if ( $slide['message'] ): ?>
                                    <p class="bdevs-el-message"><?php echo bdevs_element_kses_basic( $slide['message'] ); ?></p>
                                <?php endif;?>
                              </div>
                           </div>
                           <?php endforeach;?>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
        </section>

        <?php else:
            if ( !empty( $settings['image']['id'] ) ) {
                $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['thumbnail_size'] );
            }
        ?>

        <div class="testimonial__area  fix">
            <div class="container">
               <div class="testimonial__inner p-relative pb-110">
                    <?php if ( !empty($image) ) : ?>
                    <div class="testimonial__bg p-absolute">
                        <img src="<?php echo esc_url($image); ?>" alt="">
                    </div>
                    <?php endif; ?>

                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="testimonial__slider owl-carousel wow fadeInUp2" data-wow-delay=".5s">
                            <?php foreach ( $settings['slides'] as $slide ):
                                if ( !empty( $slide['image']['id'] ) ) {
                                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                                }
                            ?>
                            <div class="testimonial__item white-bg">
                                <div class="testimonial__person d-flex mb-20">
                                    <?php if ( !empty( $image ) ): ?>
                                    <div class="testimonial__avater"> 
                                        <img src="<?php print esc_url( $slide['image']['url'] );?>" alt="">
                                    </div> 
                                    <?php endif;?>

                                    <div class="testimonial__info ml-15">
                                        <?php if ( !empty( $slide['client_name'] ) ): ?>
                                        <h5 class="bdevs-el-author"><?php echo bdevs_element_kses_basic( $slide['client_name'] ); ?></h5>
                                        <?php endif;?>

                                        <?php if ( !empty( $slide['designation_name'] ) ): ?>
                                        <span class="bdevs-el-designation"><?php echo bdevs_element_kses_basic( $slide['designation_name'] ); ?></span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <?php if ( $slide['message'] ): ?>
                                <div class="testimonial__text">
                                    <p class="bdevs-el-message"><?php echo bdevs_element_kses_basic( $slide['message'] ); ?></p>
                                </div>
                                <?php endif;?>
                            </div>
                           <?php endforeach;?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>

    <?php endif;?>
        <?php
}
}
