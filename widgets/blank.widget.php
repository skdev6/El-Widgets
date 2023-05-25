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
			'header_content_section',
			[
				'label' => __( 'Header Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->end_controls_section();


		$this->start_controls_section( 
			'header_content_style',
			[
				'label' => esc_html__( 'Header Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	}
}