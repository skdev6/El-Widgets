<?php
include_once plugin_dir_path(__FILE__) . "trait/ButtonSettings.php";
class skdevCard extends \Elementor\Widget_Base {
    use ButtonSettings;
	public function get_name() {
		return 'skdevCard';
	}
 
	public function get_title() {
		return __( 'May Day - Card', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-text-field';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'card_content_section',
			[
				'label' => __( 'Card Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
			]
		);
		$this->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);
		$this->add_control(
			'card_image',
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
			'card_content_style',
			[
				'label' => esc_html__( 'Card Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'card_title_typography',
				'selector' => '{{WRAPPER}} .card-wrapper .title',
                'label'=>esc_html__( 'Title', 'textdomain' ),
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'card_des_typography',
				'selector' => '{{WRAPPER}} .card-wrapper .des',
                'label'=>esc_html__( 'Descriptino', 'textdomain' ),
			]
		);
        $this->add_control(
			'card_padding',
			[
				'label' => esc_html__( 'Card Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'card_title_magrin',
			[
				'label' => esc_html__( 'Title Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'card_transform_image_offset',
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
		$this->add_control(
			'card_image_offset_x',
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
					'{{WRAPPER}} .card-wrapper .img__wrap' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'card_image_offset_y',
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
					'{{WRAPPER}} .card-wrapper .img__wrap' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
			]
		);
        $this->end_popover();
		$this->add_control(
			'card_image_width',
			[
				'label' => esc_html__( 'Image Width', 'textdomain' ),
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
					'{{WRAPPER}} .card-wrapper .img__wrap img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); 
        $this->buttonsControls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
        <div class="card__wrap opc-0">
            <div class="card-wrapper">
                <div class="img__wrap"><div class="img--inner"><img src="<?php echo wp_get_attachment_image_url($settings['card_image']['id'], 'full') ?>" alt=""></div></div>
                <h2 class="title"><?php echo $settings['card_title']; ?></h2>
                <p class="des"><?php echo $settings['card_description']; ?></p>
                <?php $this->renderButtons(); ?>
            </div>
        </div>
	<?php }
}