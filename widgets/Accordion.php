<?php
class Accordion extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'Accordion';
	}
 
	public function get_title() {
		return __( 'May Day - Accordion', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-button';
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
        $accourdion_repeater = new \Elementor\Repeater();
		$accourdion_repeater->add_control(
			'title',
			[  
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'=>true
			]
		);
		$accourdion_repeater->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);
        $this->add_control(
			'accourdion_lists',
			[
				'label' => esc_html__( 'Accourdion', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $accourdion_repeater->get_controls()
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
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .accordion-wrapper .accordion-item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'des_padding',
			[
				'label' => esc_html__( 'Description Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .accordion-wrapper .accordion-item .accordion-body .body-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => esc_html__( 'Title', 'textdomain' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .accordion-wrapper .accordion-item .title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => esc_html__( 'Description', 'textdomain' ),
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .accordion-wrapper .accordion-item .accordion-body',
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .accordion-wrapper .accordion-item .title .icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .accordion-wrapper .accordion-item .title .icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'use_as_toggle',
			[
				'label' => esc_html__( 'Use as toggle', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
	
        <div class="accordion-wrapper <?php echo $settings['use_as_toggle'] ? "use-as-toggle" : ""; ?>">
			<?php foreach($settings['accourdion_lists'] as $accordion): ?>
			<div class="accordion-item">
				<h2 class="title"><?php echo $accordion['title']; ?><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg></span></h2>
				<div class="accordion-body">
					<div class="body-content"><?php echo $accordion['item_description']; ?></div>
				</div>
			</div>
			<?php endforeach; ?>
        </div>
    
    <?php }
}