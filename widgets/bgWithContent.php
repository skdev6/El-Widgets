<?php
class bgWithContent extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'bgWithContent';
	}
 
	public function get_title() {
		return __( 'May Day - Bg with Content', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-info-box';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// $this->add_control(
		// 	'bg_image',
		// 	[
		// 		'label' => esc_html__( 'Choose Image', 'textdomain' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
		// 		],
		// 	]
		// );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
                'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'name' => 'bg_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bg__content-section .bg-wrapper .bg-area',
			]
		);
		$this->add_control(
			'bg_prallax',
			[
				'label' => esc_html__( 'Background Prallax', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'template_shortcode',
			[
				'label' => esc_html__( 'Template Shortcode', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'textdomain' ),
				'placeholder' => esc_html__( 'Template Shortcode here', 'textdomain' ),
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 
			'content_style',
			[
				'label' => esc_html__( 'Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'bg__height',
            [
                'label' => esc_html__( 'Background Height', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bg__content-section .bg-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_cadd_responsive_controlontrol(
			'text_box_padding',
			[
				'label' => esc_html__( 'Text Box Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bg__content-section .text-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'transform_offset',
            [
                'label' => esc_html__( 'Image Offset', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'textdomain' ),
                'label_on' => esc_html__( 'Custom', 'textdomain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'offset_x',
            [
                'label' => esc_html__( 'Offset X', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bg__content-section .text-box-content-wrapper' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_responsive_control(
            'offset_y',
            [
                'label' => esc_html__( 'Offset Y', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bg__content-section .text-box-content-wrapper' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();
		$this->add_responsive_control(
			'box_shape_size',
			[
				'label' => esc_html__( 'shape_size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .has-sq-shape' => '--shape-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
        <section class="bg__content-section position-relative">
            <div class="bg-wrapper has-sq-shape <?php echo $settings['bg_prallax'] ? "has-bg-prallax" : ""; ?>">
                <div class="bg-area"></div>
                <span class="box--shape right-0 left-auto"><span class="inner-shape d-block"></span></span>
            </div>
            <div class="text-box-content-wrapper position-absolute">
                <div class="text-box-inner-content bg-white">
                    <div class="text-box-content bg-white">
                        <?php echo $settings['template_shortcode']; ?>
                    </div>
                </div> 
            </div> 
        </section>    

    <?php }
}