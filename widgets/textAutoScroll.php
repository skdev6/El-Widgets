<?php
class textAutoScroll extends \Elementor\Widget_Base {
	public function get_name() {
		return 'textAutoScroll';
	}
 
	public function get_title() {
		return __( 'Text Auto Scroll', 'plugin-name' );
	}
	public function get_icon() {
		return 'eicon-text-field';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Card Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'TEXT', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block'=>true
			]
		);
		$this->add_control(
			'duration',
			[
				'label' => esc_html__( 'Duration', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 80,
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
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
                'label'=>esc_html__( 'Title', 'textdomain' ),
			]
		); 
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            <div class="text-slide-wrapper" data-duration="<?php echo $settings['duration']; ?>">
                <h2 class="title d-flex align-items-center">
                    <span class="text-item d-block"><?php echo $settings['text']; ?></span>
                    <span class="text-item d-block"><?php echo $settings['text']; ?></span> 
                </h2>
            </div>
	<?php }
}