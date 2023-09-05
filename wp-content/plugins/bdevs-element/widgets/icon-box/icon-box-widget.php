<?php
namespace BdevsElement\Widget;

use Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Icon_Box extends BDevs_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'iconbox';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Icon Box', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/icon-box/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_keywords() {
        return ['info', 'box', 'icon'];
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                    'style_4' => __( 'Style 4', 'bdevs-element' ),
                    'style_5' => __( 'Style 5', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section(); 

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __( 'Icon / Image', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
            'image',
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
                'name'      => 'thumbnail',
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
            '_section_icon',
            [
                'label' => __( 'Content', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Icon Box', 'bdevs-element' ),
                'placeholder' => __( 'Type Icon Box Title', 'bdevs-element' ),
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
                'label_block' => true,
                'placeholder' => __( 'Icon Description', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ],
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label'       => __( 'Link', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'URL', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => __( 'Title HTML Tag', 'bdevs-element' ),
                'type'      => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'options'   => [
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
                'default'   => 'h3',
                'toggle'    => false,
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_5']
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'bdevs-element' ),
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://elementor.bdevs.net/', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
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
                'label' => __( 'Icon Position', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevs-element' ),
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
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
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

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
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


    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'description', 'none' );
        $this->add_render_attribute( 'description', 'class', 'content-desc' );

        if ( !empty( $settings['image']['url'] ) ) {
            $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
            $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
            $this->add_render_attribute( 'image', 'class', 'w-100' );
        }

        if ( !empty( $settings['shape_image']['url'] ) ) {
            $this->add_render_attribute( 'shape_image', 'src', $settings['shape_image']['url'] );
            $this->add_render_attribute( 'shape_image', 'alt', Control_Media::get_image_alt( $settings['shape_image'] ) );
            $this->add_render_attribute( 'shape_image', 'title', Control_Media::get_image_title( $settings['shape_image'] ) );
        }

        if ( $settings['design_style'] === 'style_5' ):
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'services__title-4' );
            $this->add_inline_editing_attributes( 'button', 'none' );
            $this->add_render_attribute( 'button', 'class', 'link-btn' );
        ?>
        
        <div class="services__item-5 d-flex justify-content-between align-items-center transition-3">
            <div class="services__content-5 d-flex align-items-center">
                <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ):
                    $this->get_render_attribute_string( 'image' );
                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                    <figure>
                     <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                    </figure>
                    <?php elseif ( !empty( $settings['icon'] ) || !empty( $settings['selected_icon']['value'] ) ): ?>
                    <figure>
                        <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' );?>
                    </figure>
                <?php endif;?>

                <?php if ( $settings['title'] ): ?>
                    <h3 class="services__title-5"><a class="bdevs-el-title" href="<?php echo esc_url( $settings['title_link'] ); ?>">
                    <?php echo esc_html( $settings['title'] ); ?>
                    </a></h3>
                <?php endif;?>
            </div>
            <div class="services__more-5 d-flex align-items-center">
               <a href="<?php echo esc_url( $settings['title_link'] ); ?>"><i class="arrow_right"></i></a>
            </div>
        </div>

        <?php elseif ( $settings['design_style'] === 'style_4' ):

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'services__title-4' );
            $this->add_inline_editing_attributes( 'button', 'none' );
            $this->add_render_attribute( 'button', 'class', 'link-btn' );
        ?>
         
        <div class="services__item-5 d-flex justify-content-between align-items-center transition-3">
            <div class="services__content-5 d-flex align-items-center">
                <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ):
                    $this->get_render_attribute_string( 'image' );
                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                    <figure>
                     <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                    </figure>
                    <?php elseif ( !empty( $settings['icon'] ) || !empty( $settings['selected_icon']['value'] ) ): ?>
                    <figure>
                        <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' );?>
                    </figure>
                <?php endif;?>

                <?php if ( $settings['title_link'] ): ?>
                    <h3 class="services__title-5"><a class="bdevs-el-title" href="<?php echo esc_url( $settings['title_link'] ); ?>">
                    <?php echo esc_html( $settings['title'] ); ?>
                    </a></h3>
                <?php endif;?>
            </div>
            <div class="services__more-5 d-flex align-items-center">
               <a href="<?php echo esc_url( $settings['title_link'] ); ?>"><i class="arrow_right"></i></a>
            </div>
        </div>

        <?php elseif ( $settings['design_style'] === 'style_3' ):

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'services__title-4' );
            $this->add_inline_editing_attributes( 'button', 'none' );
            $this->add_render_attribute( 'button', 'class', 'link-btn' );
         ?>

         
        <div class="support__item white-bg mb-30 transition-3 text-center">
            <div class="support__icon mb-15 d-flex align-items-end justify-content-center">
               <a href="#">
                    <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ):
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                        <figure>
                         <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        </figure>
                        <?php elseif ( !empty( $settings['icon'] ) || !empty( $settings['selected_icon']['value'] ) ): ?>
                        <figure>
                            <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' );?>
                        </figure>
                    <?php endif;?>
               </a>
            </div>
            <div class="support__content">
                <?php if ( $settings['title'] ): ?>
                    <h3 class="support__title"><a class="bdevs-el-title" href="<?php echo esc_url( $settings['title_link'] ); ?>">
                        <?php echo esc_html( $settings['title'] ); ?></a>
                    </h3>
                <?php endif;?>
            </div>
        </div>


        <?php elseif ( $settings['design_style'] === 'style_2' ):

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'services__title-4 bdevs-el-title' );
            $this->add_inline_editing_attributes( 'button', 'none' );
            $this->add_render_attribute( 'button', 'class', 'link-btn bdevs-el-btn' );

        ?>

        <div class="services__item-4 white-bg mb-30 d-none">
             <div class="services__thumb-4 text-center d-flex align-items-end justify-content-center">
                <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ):
                $this->get_render_attribute_string( 'image' );
                $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                ?>
                    <figure>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                    </figure>
                    <?php elseif ( !empty( $settings['icon'] ) || !empty( $settings['selected_icon']['value'] ) ): ?>
                    <figure>
                        <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' );?>
                    </figure>
                <?php endif;?>
             </div>
             <div class="services__content-4 bdevs-el-content">
                <?php if ( $settings['title'] ):
                    printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        bdevs_element_kses_basic( $settings['title'] ),
                        esc_url( $settings['title_link'] )
                    );
                endif;?>
                <?php if ( $settings['description'] ): ?>
                    <p><?php echo esc_html( $settings['description'] ); ?></p>
                <?php endif;?>

                    <?php if ( $settings['button_text'] && ( ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ) :
                        $this->add_render_attribute( 'button', 'class', 'bt-btn site-btn-border' );
                        printf( '<a %1$s>%2$s</a>',
                            $this->get_render_attribute_string( 'button' ),
                            esc_html( $settings['button_text'] )
                            );
                    elseif ( empty( $settings['button_text'] ) && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) : ?>
                        <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' ); ?></a>
                    <?php elseif ( $settings['button_text'] && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) :
                        if ( $settings['button_icon_position'] === 'before' ) :
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?> <?php echo $button_text; ?></a>
                            <?php
                        else :
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo $button_text; ?> <?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></a>
                        <?php
                        endif;
                    endif; ?>
             </div>
        </div>

        <?php else: 
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'featured__title bdevs-el-title' );

            if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }
        ?>

        <div class="featured__item grey-bg-17 mb-30 wow fadeInUp2 bdevs-el-content" data-wow-delay=".3s">
            <?php if ( $settings['title'] ):
            printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                tag_escape( $settings['title_tag'] ),
                $this->get_render_attribute_string( 'title' ),
                bdevs_element_kses_basic( $settings['title'] ),
                esc_url( $settings['title_link'] )
            );
            endif;?>

            <?php if ( $settings['description'] ): ?>
                <p><?php echo esc_html( $settings['description'] ); ?></p>
            <?php endif;?>

            <?php if (!empty($image)): ?>
            <div class="featured__thumb w-img">
               <a href="<?php echo esc_url( $settings['title_link'] ); ?>">
                  <img src="<?php print esc_url($image); ?>" alt="img">
               </a>
            </div>
            <?php endif; ?>

        </div>

        <?php endif;?>

        <?php
}

}
