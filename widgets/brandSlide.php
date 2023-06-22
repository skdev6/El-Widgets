<?php
class brandSlide extends \Elementor\Widget_Base {
	public function get_name() {
		return 'brandSlide';
	}
 
	public function get_title() { 
		return __( 'Brand Slide', 'plugin-name' );
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
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$brand_repeater = new \Elementor\Repeater();
		$brand_repeater->add_control(
			'thumbnail',
			[  
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$brand_repeater->add_control(
			'list_link',
			[  
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT, 
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$this->add_control( 
			'brand_list',
			[
				'label' => esc_html__( 'Brand List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $brand_repeater->get_controls()
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            <div class="brand-slide"> 
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['brand_list'] as $brand) { ?>  
                        <div class="swiper-slide"> 
                            <a href="<?php echo $brand['list_link']; ?>" class="brand__wrap d-block text-center px-1"><img src="<?php echo wp_get_attachment_image_url($brand['thumbnail']['id'], 'full'); ?>" alt=""></a> 
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
	<?php }
}