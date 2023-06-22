<?php
include_once plugin_dir_path(__FILE__) . "trait/ImageListSettings.php";
class checkBoxToggle extends \Elementor\Widget_Base {
	use ImageListSettings;
	public function get_name() { 
		return 'checkBoxToggle';
	}
 
	public function get_title() {
		return __( 'Check Toggle', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-justify-space-evenly-v';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
			]
		);
		$this->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10, 
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section( 
			'toggle_style',
			[
				'label' => esc_html__( 'Toggle Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .toggle-head .title',
                'label'=>esc_html__( 'Title', 'textdomain' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .des',
                'label'=>esc_html__( 'Descriptino', 'textdomain' ),
			]
		);
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .toggle__wrap .toggle-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .toggle__wrap .toggle-head .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .toggle__wrap .des' => 'color: {{VALUE}}',
				],
			]
		); 
        $this->add_responsive_control(
			'toggle_padding',
			[
				'label' => esc_html__( 'Toggle Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .toggle__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'toggle_body_padding',
			[
				'label' => esc_html__( 'Toggle body Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .toggle__wrap .toggle-body .toggle-body-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		$this->add_responsive_control( 
			'toggle_size',
			[
				'label' => esc_html__( 'Toggle Button size', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units'=>[ 'px', '%', 'vw', 'vh', 'custom' ],
				'range'=>[
					'px'=>[
						'min'=>0,
						'max'=>500
					]
				],
				'label_block'=>true, 
				'selectors'=>[  
					"{{WRAPPER}} .toggle__btn"=>"font-size: {{SIZE}}{{UNIT}}",
				]
			]
		); 
		$this->add_responsive_control(  
			'toggle_space',
			[
				'label' => esc_html__( 'Toggle Button space', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units'=>[ 'px', '%', 'vw', 'vh', 'custom' ],
				'range'=>[
					'px'=>[
						'min'=>0,
						'max'=>500
					]
				],
				'label_block'=>true, 
				'selectors'=>[  
					"{{WRAPPER}} .toggle__btn"=>"margin-left: {{SIZE}}{{UNIT}}",
				]
			]
		);
		$this->end_controls_section();
        $this->imageListControl();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();	
	?>
        <div class="toggle__wrap">
			<div class="toggle-head d-flex align-items-center">
				<h2 class="title ff__base mb-0"><?php echo $settings['item_title']; ?></h2>
				<button class="toggle__btn"><span class="on">ON</span><span class="off">OFF</span></button>
			</div>
			<div class="des"><?php echo $settings['item_description']; ?></div>
			<div class="toggle-body">
				<div class="toggle-body-wrap"><?php $this->renderImageList(); ?></div>
			</div>
		</div>
    <?php }
} 