<?php
class skdevHero extends \Elementor\Widget_Base {
	public function get_name() {
		return 'skdevHero';
	}
 
	public function get_title() {
		return __( 'May Day - Hero', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-button';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'hero_bg_content_section',
			[
				'label' => __( 'Hero Background', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__( 'Choose Hero Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'content_template_shortcode',
			[
				'label' => esc_html__( 'Template Shortcode', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 
			'hero_content_style',
			[
				'label' => esc_html__( 'Hero Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hero_bg_width',
			[
				'label' => esc_html__( 'Background Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' =>0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'vh' => [
						'min' => 0,
						'max' => 1000,
					],
                    'vw' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .hero__area .hero__bg,{{WRAPPER}} .hero__area .z-top-overlay' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hero_bg_height',
			[
				'label' => esc_html__( 'Background Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'vh' => [
						'min' => 0,
						'max' => 1000,
					],
                    'vw' => [
						'min' => 0,
						'max' => 1000,
					] 
				],
				'selectors' => [
					'{{WRAPPER}} .hero__area .hero__bg,{{WRAPPER}} .hero__area .z-top-overlay' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'hero_bg_translateX',
			[
				'label' => esc_html__( 'Background transformX', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'vh' => [
						'min' => 0,
						'max' => 1000,
					],
                    'vw' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .hero__area .hero__bg,{{WRAPPER}} .hero__area .z-top-overlay' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		); 
		$this->end_controls_section(); 

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		?>

        <section class="hero__area">
			<span class="opc-0 d-block">Hello Hero</span>
            <div class="w-100 overflow-hidden hero-bg-wrapper opc-0 pb-1"><span class="z-top-overlay d-block position-absolute"></span><div class="hero__bg ms-auto"><span class="sp sl"></span><span class="sp sr"></span><div class="bg__main" style="background-image:url('<?php echo wp_get_attachment_image_url($settings['hero_image']['id'], 'full'); ?>')"></div></div></div>
		</section> 

	<?php }
}