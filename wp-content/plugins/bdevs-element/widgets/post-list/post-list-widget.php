<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Background;
use \BdevsElement\BDevs_El_Select2;

defined('ABSPATH') || die();


class Post_List extends BDevs_El_Widget
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
        return 'post_list';
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
        return __('Post List', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/widgets/post-list/';
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
        return 'eicon-parallax';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-list', 'list', 'news'];
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
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-element'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
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

        $this->start_controls_section(
            '_section_media_',
            [
                'label' => __('Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label' => __('Icon Image', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Heading Sub Title',
                'placeholder' => __( 'Heading Sub Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Description Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            's_title_tag',
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
                'default' => 'h3',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            's_align',
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
                    '{{WRAPPER}} .section__title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-element'),
                'placeholder' => __('Type button text here', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-element'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __('Icon', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-element'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-element'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 

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
                'list_btn_text',
                [
                    'label' => __('BTN Text', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __('Read More', 'bdevs-element'),
                    'placeholder' => __('Link Text', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'list_count_number',
                [
                    'label' => __('Count Number', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __('01', 'bdevs-element'),
                    'placeholder' => __('Count Number', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'service_author_name',
                [
                    'label' => __('Author Name', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __('Jon Williamson', 'bdevs-element'),
                    'placeholder' => __('Author Name', 'bdevs-element'),
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
            'view',
            [
                'label' => __('Layout', 'bdevs-element'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'list',
                'options' => [
                    'list' => [
                        'title' => __('List', 'bdevs-element'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => __('Inline', 'bdevs-element'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => __('Featured Image', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_image',
                'default' => 'thumbnail',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'feature_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_icon',
            [
                'label' => __('List Icon', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'feature_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'bdevs-element'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'far fa-check-circle',
                    'library' => 'reguler'
                ],
                'condition' => [
                    'list_icon' => 'yes',
                    'feature_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'meta',
            [
                'label' => __('Show Meta', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'author_meta',
            [
                'label' => __('Author', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'author_icon',
            [
                'label' => __('Author Icon', 'bdevs-element'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'author_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'date_meta',
            [
                'label' => __('Date', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label' => __('Date Icon', 'bdevs-element'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-calendar-check',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'date_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'category_meta',
            [
                'label' => __('Category', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label' => __('Category Icon', 'bdevs-element'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-folder-open',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'category_meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'meta_position',
            [
                'label' => __('Meta Position', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => __('Top', 'bdevs-element'),
                    'bottom' => __('Bottom', 'bdevs-element'),
                ],
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-element'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-element'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-element'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-element'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-element'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-element'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'item_align',
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
                'condition' => [
                    'design_style' => ['style_10'],
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
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-element' ),
                'separator' => 'before',
                'condition' => [
                    'design_style' => ['style_10'],
                ],
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
                'condition' => [
                    'design_style' => ['style_10'],
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
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-element' ),
                'separator' => 'before',
                'condition' => [
                    'design_style' => ['style_10'],
                ],
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
                'condition' => [
                    'design_style' => ['style_10'],
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
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        // List Title
        $this->add_control(
            '_heading_listtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Blog Title', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'listtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-blog-title a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'listtitle_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-blog-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'listtitle',
                'selector' => '{{WRAPPER}} .bdevs-blog-title a',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // List Cat
        $this->add_control(
            '_heading_category',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Blog Category', 'bdevselement' ),
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
                    '{{WRAPPER}} .bdevs-el-cat' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-cat' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category',
                'selector' => '{{WRAPPER}} .bdevs-el-cat',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );


        // List Author
        $this->add_control(
            '_heading_author',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Blog Author', 'bdevselement' ),
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

        // List Date
        $this->add_control(
            '_heading_date',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Blog date', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'date_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date',
                'selector' => '{{WRAPPER}} .bdevs-el-date',
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
                    $post_id = !empty($value['post_id']) ? $value['post_id'] : 0;
                    $ids[] = $post_id;
                    if ($value['title']) $customize_title[$post_id] = $value['title'];
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

        $this->add_render_attribute('title', 'class', 'item_title');
        

        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'): ?>
            <?php foreach ($posts as $inx => $post):
                $categories = get_the_category($post->ID);
                ?>
                <div class="blog_fullimage_2 text-white">
                    <?php if ('yes' === $settings['feature_image']): ?>
                        <?php echo get_the_post_thumbnail($post->ID, $settings['post_image_size']); ?>
                    <?php endif; ?>
                    <div class="item_content">
                        <?php if ('top' == $settings['meta_position']) : ?>
                            <?php if ('yes' === $settings['meta']): ?>
                                <ul class="post_meta ul_li clearfix">
                                    <?php if ('yes' === $settings['author_meta']): ?>
                                        <li>
                                            <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php if ($settings['author_icon']):
                                                    Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                            </a></li>
                                    <?php endif; ?>
                                    <?php if ('yes' === $settings['date_meta']): ?>
                                        <li><a href="<?php echo esc_url(get_day_link(false, false, false)); ?>">
                                                <?php if ($settings['date_icon']):
                                                    Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo get_the_date("M d, Y"); ?>
                                            </a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php $title = $post->post_title;
                        if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                            $title = $customize_title[$post->ID];
                        }
                        printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            esc_html($title),
                            esc_url(get_the_permalink($post->ID))
                        ); ?>
                        <?php if ('top' !== $settings['meta_position']) : ?>
                            <?php if ('yes' === $settings['meta']): ?>
                                <ul class="post_meta ul_li clearfix">
                                    <?php if ('yes' === $settings['author_meta']): ?>
                                        <li>
                                            <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php if ($settings['author_icon']):
                                                    Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                            </a></li>
                                    <?php endif; ?>
                                    <?php if ('yes' === $settings['date_meta']): ?>
                                        <li><a href="<?php echo esc_url(get_day_link(false, false, false)); ?>">
                                                <?php if ($settings['date_icon']):
                                                    Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo get_the_date("M d, Y"); ?>
                                            </a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <a class="text_btn absolute_btn" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><span>Read More</span>
                        <i class="far fa-arrow-right"></i></a>

                </div>
            <?php endforeach; ?>

        <?php elseif ( $settings['design_style'] == 'style_2'): 
            $title = bdevs_element_kses_basic( $settings['title'] );
            $this->add_render_attribute('title', 'class', 'blog__title-3');
            $this->add_render_attribute( 'title_s', 'class', 'section__title section__title-3 section-mb-15 bdevs-blog-title' );
            if (!empty($settings['icon_image']['id'])) {
                $icon_image = wp_get_attachment_image_url($settings['icon_image']['id'], 'full');
            }
        ?>
         <section class="blog__area pt-120 pb-80">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                    <?php if ( !empty($icon_image) ): ?>
                    <span class="section__pre-title-img">
                        <img src="<?php echo esc_url($icon_image); ?>">
                    </span>
                    <?php endif;?>
                        <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['s_title_tag'] ),
                            $this->get_render_attribute_string( 'title_s' ),
                            $title
                            );
                        ?>
                        <?php if ( $settings['description'] ): ?>
                            <p><?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif;?>
                  </div>
               </div>
               <div class="row">
                    <?php foreach ($posts as $inx => $post):
                    $categories = get_the_category($post->ID);
                    ?>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                     <div class="blog__item-3 white-bg mb-30">
                        <?php if ('yes' === $settings['feature_image']): ?>
                        <div class="blog__thumb-3 p-relative w-img fix">
                           <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                              <img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                           </a>
                           <?php if ('post' === $settings['post_type'] && 'yes' === $settings['category_meta']):
                            $categories = get_the_category($post->ID); ?>
                           <div class="blog__meta-3">
                                <span class="tag-3">
                                    <a class="bdevs-el-cat" href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                        <?php if ($settings['category_icon']):
                                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo esc_html($categories[0]->name); ?>
                                    </a>
                                </span>
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="blog__content-3">
                         <?php if ('top' == $settings['meta_position']) : ?>
                           <?php if ('yes' === $settings['meta']): ?>
                           <div class="blog__meta-3 mb-10">
                            <?php if ('yes' === $settings['author_meta']): ?>
                                <span class="tag">
                                    <a class="bdevs-el-author" href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php if ($settings['author_icon']):
                                            Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                            <?php if ('yes' === $settings['date_meta']): ?>
                                <span class="bdevs-el-date" class="date">
                                        <?php if ($settings['date_icon']):
                                            Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo get_the_date("M d, Y"); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ('post' === $settings['post_type'] && 'yes' === $settings['category_meta']):
                                $categories = get_the_category($post->ID); ?>
                                <span class="bdevs-el-cat" class="tag">
                                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                        <?php if ($settings['category_icon']):
                                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo esc_html($categories[0]->name); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                           </div>
                           <?php endif; ?>
                            <?php endif; ?>

                            <?php $title = $post->post_title;
                            if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                $title = $customize_title[$post->ID];
                            }
                            printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                esc_html($title),
                                esc_url(get_the_permalink($post->ID))
                            ); ?> 

                         <?php if ('top' !== $settings['meta_position']) : ?>
                           <?php if ('yes' === $settings['meta']): ?>
                           <div class="blog__meta-3 mt-40 mb-10">
                            <?php if ('yes' === $settings['author_meta']): ?>
                                <span class="tag">
                                    <a class="bdevs-el-cat" href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php if ($settings['author_icon']):
                                            Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                            <?php if ('yes' === $settings['date_meta']): ?>
                                <span class="bdevs-el-date" class="date">
                                        <?php if ($settings['date_icon']):
                                            Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo get_the_date("M d, Y"); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ('post' === $settings['post_type'] && 'yes' === $settings['category_meta']):
                                $categories = get_the_category($post->ID); ?>
                                <span class="bdevs-el-cat" class="tag">
                                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                        <?php if ($settings['category_icon']):
                                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                        endif;
                                        echo esc_html($categories[0]->name); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                           </div>
                           <?php endif; ?>
                            <?php endif; ?>

                            <?php if ( !empty($settings[$selected_post_type][$inx]['list_btn_text']) ): ?>
                            <a class="link-btn bdevs-el-btn" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" class="inline-btn">
                                <?php print $settings[$selected_post_type][$inx]['list_btn_text'] ; ?> <i class="arrow_right"></i>
                            </a>
                            <?php endif; ?>

                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>


        <?php else:
            $this->add_render_attribute( 'title_s', 'class', 'section__title section__title-2' );
            $this->add_render_attribute('title', 'class', 'latest-blog-title bdevs-blog-title');
            $title = bdevs_element_kses_basic( $settings['title'] );

            if (!empty($settings['icon_image']['id'])) {
                $icon_image = wp_get_attachment_image_url($settings['icon_image']['id'], 'full');
            }
            if (!empty($posts)): ?>

                <section class="blog__area">
                    <div class="container">
                       <div class="row">
                        <?php foreach ($posts as $inx => $post):
                        $categories = get_the_category($post->ID);
                        ?>
                          <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                             <div class="latest-blog mb-30">
                                <?php if ('yes' === $settings['feature_image']): ?>
                                <div class="latest-blog-img pos-rel">
                                   <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                      <img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                   </a>
                                   <?php if ('post' === $settings['post_type'] && 'yes' === $settings['category_meta']):
                                        $categories = get_the_category($post->ID); ?>
                                   <div class="top-date">
                                        <a class="bdevs-el-cat" href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                            <?php if ($settings['category_icon']):
                                                Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                            endif;
                                            echo esc_html($categories[0]->name); ?>
                                        </a>
                                   </div>
                                   <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="latest-blog-content">
                                   <?php if ('top' == $settings['meta_position']) : ?>
                                   <?php if ('yes' === $settings['meta']): ?>
                                   <div class="latest-post-meta mb-15">
                                    <?php if ('yes' === $settings['author_meta']): ?>
                                        <span>
                                            <a class="bdevs-el-author" href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php if ($settings['author_icon']):
                                                    Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ('yes' === $settings['date_meta']): ?>
                                        <span class="bdevs-el-date">
                                                <?php if ($settings['date_icon']):
                                                    Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                endif;
                                                echo get_the_date("M d, Y"); ?>
                                        </span>
                                    <?php endif; ?>
                                   </div>
                                   <?php endif; ?>
                                    <?php endif; ?>

                                    <?php $title = $post->post_title;
                                    if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                        $title = $customize_title[$post->ID];
                                    }
                                    printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        esc_html($title),
                                        esc_url(get_the_permalink($post->ID))
                                    ); ?>


                                   <?php if ( 'top' !== $settings['meta_position']) : ?>
                                   <?php if ('yes' === $settings['meta']): ?>
                                    <div class="latest-post-meta mb-15">
                                        <?php if ('yes' === $settings['author_meta']): ?>
                                            <span>
                                                <a class="bdevs-el-author" href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                    <?php if ($settings['author_icon']):
                                                        Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
                                                    endif;
                                                    echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ('yes' === $settings['date_meta']): ?>
                                            <span class="bdevs-el-dat">
                                                    <?php if ($settings['date_icon']):
                                                        Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
                                                    endif;
                                                    echo get_the_date("M d, Y"); ?>
                                            </span>
                                        <?php endif; ?>
                                       </div>
                                   <?php endif; ?>
                                    <?php endif; ?> 

                                    <?php if ( !empty($settings[$selected_post_type][$inx]['post_short_text']) ): ?>
                                    <div class="blog-info-text bdevs-el-content mb-10">
                                        <p><?php print $settings[$selected_post_type][$inx]['post_short_text'] ; ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($settings[$selected_post_type][$inx]['list_btn_text']) ): ?>
                                    <div class="blog-arrow">    
                                        <a class="link-btn bdevs-el-btn" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" class="inline-btn">
                                            <?php print $settings[$selected_post_type][$inx]['list_btn_text'] ; ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
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
