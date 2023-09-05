<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Background;
use \BdevsElement\BDevs_El_Select2;
use Elementor\Utils;

defined('ABSPATH') || die();

class Woo_Product extends BDevs_El_Widget
{

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
    public function get_name()
    {
        return 'woo_product';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Woo Product', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/post-list/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-product-images';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-list', 'list', 'product'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public function get_post_types()
    {
        $post_types = bdevs_element_get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
    }

    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('List', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        $this->add_control(
            'show_post_by',
            [
                'label' => __('Show post by:', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Post', 'bdevs-element'),
                    'selected' => __('Selected Post', 'bdevs-element'),
                ],

            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $repeater = [];

        foreach ($this->get_post_types() as $key => $value) {

            $repeater[$key] = new Repeater();

            $repeater[$key]->add_control(
                'title',
                [
                    'label' => __('Title', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('Customize Title', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_short_text',
                [
                    'label' => __('Short Content', 'bdevs-element'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => __('Short Content', 'bdevs-element'),
                    'rows' => 3,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );


            $repeater[$key]->add_control(
                'post_id',
                [
                    'label' => __('Select ', 'bdevs-element') . $value,
                    'label_block' => true,
                    'type' => BDevs_El_Select2::TYPE,
                    'multiple' => false,
                    'placeholder' => 'Search ' . $value,
                    'data_options' => [
                        'post_type' => $key,
                        'action' => 'bdevs_element_post_list_query'
                    ],
                ]
            );


            $this->add_control(
                'selected_list_' . $key,
                [
                    'label' => '',
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater[$key]->get_controls(),
                    'title_field' => '{{ title }}',
                    'condition' => [
                        'show_post_by' => 'selected',
                        'post_type' => $key
                    ],
                ]
            );
        }

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                    'style_4' => __('Style 4', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
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

        // product title
        $this->add_control(
            '_heading_pro-title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Product Title', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'pro-title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-pro-title a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pro-title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-pro-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pro-title',
                'selector' => '{{WRAPPER}} .bdevs-el-pro-title a',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // product desc
        $this->add_control(
            '_heading_pro-desc',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Product Description', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'pro-desc_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-pro-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pro-desc_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-pro-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pro-desc',
                'selector' => '{{WRAPPER}} .bdevs-el-pro-desc',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );


        // Price
        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Price', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-price span, .bdevs-el-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-price span, .bdevs-el-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price',
                'selector' => '{{WRAPPER}} .bdevs-el-price span, .bdevs-el-price',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // category
        $this->add_control(
            '_heading_category',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Category', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'category_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-category' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category',
                'selector' => '{{WRAPPER}} .bdevs-el-category',
                'scheme' => Typography::TYPOGRAPHY_3,
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
                    '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a',
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
                    '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn,.bdevs-el-btn a' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus,{{WRAPPER}} .bdevs-el-btn a:hover, {{WRAPPER}} .bdevs-el-btn a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus,{{WRAPPER}} .bdevs-el-btn a:hover, {{WRAPPER}} .bdevs-el-btn a:focus' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus,.bdevs-el-btn a:hover, {{WRAPPER}} .bdevs-el-btn a:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        // Button 02 style
        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __( 'Button 02', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button2_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button2_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn2',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button2_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn2',
            ]
        );

        $this->add_control(
            'button2_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button2_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn2',
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button2' );

        $this->start_controls_tab(
            '_tab_button2_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button2_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button2_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button2_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn2:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn2:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button2_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn2:hover, {{WRAPPER}} .bdevs-el-btn2:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        if (!$settings['post_type']) return;
        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];
        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $selected_post_type = 'selected_list_' . $settings['post_type'];

        $customize_title = [];
        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];
            if (!empty($lists)) {
                foreach ($lists as $index => $value) {
                    $ids[] = $value['post_id'];
                    if ($value['title']) $customize_title[$value['post_id']] = $value['title'];
                }
            }
            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = get_posts($args);
        }

        ?>

        <?php if (!empty($settings['design_style']) and $settings['design_style'] == 'style_5'):
        if (count($posts) !== 0) :
            ?>
            <section class="product-h-two">
                <div class="container">
                    <div class="row product-active common-arrows">
                        <?php foreach ($posts as $post): ?>
                            <div class="col-lg-3 col-sm-6 custom-width-20">
                                <div class="product-wrapper mb-40">
                                    <div class="pro-img mb-20">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                        </a>
                                        <div class="product-action text-center">
                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::quick_view_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                        </div>
                                    </div>
                                    <div class="pro-text">
                                        <div class="pro-title">
                                            <h6>
                                                <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                                ?>
                                            </h6>
                                            <h5 class="pro-price">
                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                            </h5>
                                        </div>
                                        <div class="cart-icon">
                                            <a href="<?php print esc_url(get_the_permalink($post->ID)); ?>">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>

    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_4'):
        if (count($posts) !== 0) :

        ?>
     <section class="product__area">
        <div class="container">
           <div class="row">
                <?php foreach ($posts as $key => $post): 
                    $args = array( 'taxonomy' => 'product_cat',);
                    $terms = wp_get_post_terms($post->ID,'product_cat', $args);
                    $product_action_switch = get_theme_mod('product_action_switch', false);
                    $product_cart_btn_switch = get_theme_mod('product_cart_btn_switch', false);
                    $product_author_switch = get_theme_mod('product_author_switch', false);
                    $markite_author_by = get_theme_mod('markite_author_by',  __('By','markite') );
                    $markite_cat_in = get_theme_mod('markite_cat_in', __('In','markite') );
                    $product_action_overlay = $product_action_switch ? 'product-thumb-overlay' : '';
                    $categories = get_the_terms( $post->ID, 'product_cat' );
                    $markite_sidebar_info_list = function_exists('get_field') ? get_field('markite_sidebar_info_list',$post->ID) : '';

                    $markite_demo_url = function_exists('get_field') ? get_field('markite_demo_url',$post->ID) : '';
                    $markite_demo_button = function_exists('get_field') ? get_field('markite_demo_button',$post->ID) : '';
                ?>

              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                 <div class="product__item white-bg mb-30 wow fadeInUp2" data-wow-delay=".3s">
                    <div class="product__thumb">
                       <div class="product__thumb-inner fix w-img">
                            <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                              <?php echo get_the_post_thumbnail($post->ID, 'retro-product-v', ['class' => 'img-fluid']);?>
                            </a>
                       </div>
                    </div>
                    <div class="product__content">
                       <h3 class="product__title product__title2 bdevs-el-pro-title">
                            <?php
                            $title = $post->post_title;
                            if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                $title = $customize_title[$post->ID];
                            }

                            printf('<a href="%2$s">%1$s</a>',
                                esc_html($title),
                                esc_url(get_the_permalink($post->ID))
                            );
                            ?>
                       </h3>
                       <p class="product__author">
                            <?php if (!empty($product_author_switch)) : ?>
                                <?php if (!empty($markite_author_by)) : ?>
                                <?php echo esc_html($markite_author_by); ?> 
                                <?php endif; ?> 
                                <a class="bdevs-el-author" href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print get_the_author(); ?></a>
                            <?php endif; ?> 
                            <?php if (!empty($markite_cat_in)) : ?>
                             <?php echo esc_html($markite_cat_in); ?> 
                            <?php endif; ?>  
                            <a class="bdevs-el-category" href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </p>
                       <div class="product__ratings-wrapper">
                            <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID, true); ?>
                       </div>
                       <div class="product__meta d-flex justify-content-between align-items-end mt-15">
                          <div class="product__price">
                             <span class="bdevs-el-price"><?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?></span>

                            <?php if( !empty($markite_sidebar_info_list['pro_download_number']) ) : ?>
                            <p><?php print wp_kses_post( $markite_sidebar_info_list['pro_download_number'] ); ?> <?php echo esc_html__('Sale','bdevs-element'); ?>  
                            <?php else : ?></p> 
                            <p><?php echo \BdevsElement\BDevs_El_Woocommerce::downloadable_count_el($post->ID); ?> <?php echo esc_html__('Sale','bdevs-element'); ?></p>
                            <?php endif; ?>
                          </div>
                          <div class="product__action-btn">
                            <?php if (!empty($markite_demo_button)) : ?>
                              <a class="link_prview bdevs-el-btn" href="<?php print esc_url($markite_demo_url); ?>" target="_blank"  class="p-btn-border"> <?php print esc_html($markite_demo_button); ?></a>
                            <?php endif; ?>

                             <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button_icon($post->ID); ?>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <?php endforeach; ?>
           </div>
        </div>
     </section>

        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'):
        if (count($posts) !== 0) :
            ?>
         <section class="trending__area">
            <div class="container">
               <div class="row">
               	<?php foreach ($posts as $inx => $post): 
				    $args = array( 'taxonomy' => 'product_cat',);
				    $terms = wp_get_post_terms($post->ID,'product_cat', $args);

				    // child cat
				    $child_term_id = '';
				    $child_term_name = '';
				    foreach ($terms as $term) {
				    	if ( $term->parent !== 0 ) {
				    		$child_term_id = $term->term_id;
				    		$child_term_name = $term->name;
		
				    	}
				    	
				    }

				    if( empty($child_term_id) ) {
				    	foreach ($terms as $term) {
				    		if ( $term->parent == 0 ) {
				    			$child_term_id = $term->term_id;
				    			$child_term_name = $term->name;
				    			
				    		}
				    	}
				    }

				    $child_term_id = '';
				    $child_term_name = '';
				    foreach ($terms as $term) {
				    	if ( $term->parent == 0 ) {
				    		$child_term_id = $term->term_id;
				    		$child_term_name = $term->name;
				 
				    	}
				    	
				    }

				    if( empty($child_term_id) ) {
				    	foreach ($terms as $term) {
				    		if ( $term->parent !== 0 ) {
				    			$child_term_id = $term->term_id;
				    			$child_term_name = $term->name;
				    	
				    		}
				    		
				    	}
				    }


               	?>
                  <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                     <div class="trending__item d-sm-flex white-bg mb-30 wow fadeInUp2" data-wow-delay=".3s">
                        <div class="trending__thumb mr-25">
                           <div class="trending__thumb-inner fix">
								<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                              		<?php echo get_the_post_thumbnail($post->ID, 'markite-pro-sm', ['class' => 'img-fluid']);?>
                              	</a>
                           </div>
                        </div>
                        <div class="trending__content">
                           <h3 class="trending__title bdevs-el-pro-title">
                           	<?php
	                            $title = $post->post_title;
	                            if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
	                                $title = $customize_title[$post->ID];
	                            }

	                            printf('<a href="%2$s">%1$s</a>',
	                                esc_html($title),
	                                esc_url(get_the_permalink($post->ID))
	                            );
	                        ?>
                           </h3>
                           <?php if ( !empty($settings[$selected_post_type][$inx]['post_short_text']) ): ?>
                           <p class="bdevs-el-pro-desc"><?php print $settings[$selected_post_type][$inx]['post_short_text'] ; ?></p>
                           <?php endif; ?>
                           <div class="trending__meta d-flex justify-content-between">
                              <div class="trending__tag">
                                 <a class="bdevs-el-category" href="<?php echo esc_url(get_category_link( $child_term_id )); ?>"><?php echo esc_html($child_term_name); ?></a>
                              </div>
                              <div class="trending__price">
                                 <span class="bdevs-el-price"><?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?> 
               </div>
            </div>
         </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>

    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
        <?php if (count($posts) !== 0) : ?>
         <section class="product__area">
            <div class="container">
               <div class="row">
               	<?php foreach ($posts as $post): 
               		$product_short_info = function_exists('get_field') && get_field( 'product_short_info',$post->ID ) ? get_field( 'product_short_info',$post->ID ) : NULL;
               		$product_sm_thumb = function_exists('get_field') && get_field( 'product_sm_thumb',$post->ID ) ? get_field( 'product_sm_thumb',$post->ID ) : NULL;

                    $product_action_switch = get_theme_mod('product_action_switch', false);
                    $product_cart_btn_switch = get_theme_mod('product_cart_btn_switch', false);
                    $product_author_switch = get_theme_mod('product_author_switch', false);
                    $markite_details_button = get_theme_mod('markite_details_button', 'Details');
               	?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="product__item-2 white-bg mb-30 fix wow fadeInUp2" data-wow-delay=".3s">
                        <div class="product__thumb-2 p-relative fix p-0">
                        	<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                           		<?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img-fluid']); ?>
                       		</a>
                        </div>
                        <div class="product__content-2 text-center">
                        	<?php if(!empty($product_sm_thumb['url'])) : ?>
                           <div class="product__icon mb-20">
                              <span><img src="<?php echo esc_url($product_sm_thumb['url']); ?>" alt="img"></span>
                           </div>
                           <?php endif; ?>

                           <h3 class="product__title-2 bdevs-el-pro-title">
								<?php
	                                $title = $post->post_title;
	                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
	                                    $title = $customize_title[$post->ID];
	                                }

	                                printf('<a href="%2$s">%1$s</a>',
	                                    esc_html($title),
	                                    esc_url(get_the_permalink($post->ID))
	                                );
                                ?>
                           </h3>
                           <?php if (!empty($product_short_info)) : ?> 
                           <p class="bdevs-el-pro-desc"><?php echo esc_html($product_short_info); ?></p>
                           <?php endif; ?>
                       		
                           <div class="product__btn mt-25">
                              <?php if (!empty($product_cart_btn_switch)) : ?>  
                              <div class="d-inline-block position-relative bdevs-el-btn mr-10">
                              	<?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                              </div>
                              <?php endif; ?>

                              <?php if (!empty($markite_details_button)) : ?>
                              <div class="d-inline-block">
                              <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="m-btn m-btn-border m-btn-border-6 bdevs-btn-border bdevs-el-btn2"> <?php echo esc_html($markite_details_button); ?> </a>
                              </div>
                              <?php endif; ?>

                           </div>
                        </div>
                     </div>
                  </div>
                <?php endforeach; ?>
               </div>
            </div>
         </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php else: ?>
        <?php if (count($posts) !== 0) : ?>
         <section class="product__area">
            <div class="container">
               <div class="row">
               	<?php foreach ($posts as $key => $post): 
				    $args = array( 'taxonomy' => 'product_cat',);
				    $terms = wp_get_post_terms($post->ID,'product_cat', $args);
                    $product_action_switch = get_theme_mod('product_action_switch', false);
                    $product_cart_btn_switch = get_theme_mod('product_cart_btn_switch', false);
                    $product_author_switch = get_theme_mod('product_author_switch', false);
                    $markite_author_by = get_theme_mod('markite_author_by',  __('By','markite') );
                    $markite_cat_in = get_theme_mod('markite_cat_in', __('In','markite') );
                    $product_action_overlay = $product_action_switch ? 'product-thumb-overlay' : '';

                    $markite_demo_url = function_exists('get_field') ? get_field('markite_demo_url',$post->ID) : '';
                    $markite_demo_button = function_exists('get_field') ? get_field('markite_demo_button',$post->ID) : '';

				    // child cat
				    $child_term_id = '';
				    $child_term_name = '';
				    foreach ($terms as $term) {
				    	if ( $term->parent !== 0 ) {
				    		$child_term_id = $term->term_id;
				    		$child_term_name = $term->name;
		
				    	}
				    	
				    }

				    $parent_term_id = '';
				    $parent_term_name = '';
				    if( empty($parent_term_id) ) {
				    	foreach ($terms as $term) {
				    		if ( $term->parent == 0 ) {
				    			$parent_term_id = $term->term_id;
				    			$parent_term_name = $term->name;
				    			
				    		}
				    	}
				    }

               	?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="product__item white-bg mb-30 wow fadeInUp2" data-wow-delay=".3s">
                        <div class="product__thumb">
                           <div class="product__thumb-inner <?php echo esc_attr($product_action_overlay); ?> fix w-img">
                              <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                              <?php echo get_the_post_thumbnail($post->ID, 'retro-product-v', ['class' => 'img-fluid']);?>
                              </a>
                              <?php if (!empty($product_action_switch)) : ?>
                              <div class="product-action-box">
                                  <?php if (!empty($product_cart_btn_switch)) : ?>
                                  <div class="d-block-block position-relative bdevs-el-btn">
                                  <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_hover_button($post->ID); ?>
                                  </div>
                                  <?php endif; ?>
                                  <?php if (!empty($markite_demo_button)) : ?>
                                  <a href="<?php print esc_url($markite_demo_url); ?>" target="_blank"  class="p-btn-border bdevs-el-btn2"> <?php print esc_html($markite_demo_button); ?></a>
                                  <?php endif; ?>
                              </div>
                              <?php endif; ?>  
                           </div>
                        </div>
                        <div class="product__content">
                           <div class="product__meta mb-10 d-flex justify-content-between align-items-center">
                              <div class="product__tag">
                                <?php if(!empty($child_term_name)) : ?>
                                 <a href="<?php echo esc_url(get_category_link( $child_term_id )); ?>"><?php echo esc_html($child_term_name); ?></a>
                                <?php else: ?>
                                <a href="<?php echo esc_url(get_category_link( $parent_term_id )); ?>"><?php echo esc_html($parent_term_name); ?></a>
                                <?php endif; ?>    
                              </div>
                              <div class="product__price">
                                 <span class="bdevs-el-price"><?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?></span>
                              </div>
                           </div>
                           <h3 class="product__title bdevs-el-pro-title">
	                            <?php
	                            $title = $post->post_title;
	                            if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
	                                $title = $customize_title[$post->ID];
	                            }

	                            printf('<a href="%2$s">%1$s</a>',
	                                esc_html($title),
	                                esc_url(get_the_permalink($post->ID))
	                            );
	                            ?>
                           </h3>
                           <p class="product__author">
                                <?php if (!empty($product_author_switch)) : ?>
                                    <?php if (!empty($markite_author_by)) : ?>
                                    <?php echo esc_html($markite_author_by); ?> 
                                    <?php endif; ?> 
                                    <a class="bdevs-el-author" href="<?php print esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php print get_the_author(); ?></a>
                                <?php endif; ?> 

                                 <?php if (!empty($markite_cat_in)) : ?>
                                 <?php echo esc_html($markite_cat_in); ?> 
                                 <?php endif; ?>  
                                 <a class="bdevs-el-category" href="<?php echo esc_url(get_category_link( $child_term_id )); ?>"><?php echo esc_html($parent_term_name); ?></a>
                            </p>
                        </div>
                     </div>
                  </div>
                <?php endforeach; ?>  
               </div>
            </div>
         </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php endif;
    }
}
