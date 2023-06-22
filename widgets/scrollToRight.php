<?php
class skScrollToRight extends \Elementor\Widget_Base {
	public function get_name() {
		return 'skScrollToRight'; 
	}
	public function get_title() {
		return __( 'Scroll To Right', 'plugin-name' );
	}
	public function get_icon() {
		return ' eicon-inner-section';
	} 
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'card_content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'tmp_shortcode',
			[
				'label' => esc_html__( 'Template Shortcode', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Shortcode', 'textdomain' ),
				'label_block'=>true
			]
		);
		$this->add_control(
			'scrollEffect',
			[
				'label' => esc_html__( 'Scroll Mobile', 'textdomain' ),
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
		$settings = $this->get_settings_for_display();
        ?>
        <div class="str__wrapper <?php echo $settings['scrollEffect'] === 'yes' ? "has-in-mobile" : "" ?>">
            <div class="str__inner">
                <?php echo do_shortcode($settings['tmp_shortcode']); ?>  
            </div>
        </div> 
	<?php }
}