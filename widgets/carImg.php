<?php
class carImg extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'carImg';
	}
 
	public function get_title() {
		return __( 'May Day - Car', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-share-arrow';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Header Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 
			'content_style',
			[
				'label' => esc_html__( 'Header Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
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
					'{{WRAPPER}} .car__img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
    
        <div class="car__img d-inline-block"><img src="<?php echo wp_get_attachment_image_url($settings['image']['id'], "full"); ?>" alt=""></div>

    <?php }
} 