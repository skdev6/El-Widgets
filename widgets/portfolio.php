<?php
class SkPortfolio extends \Elementor\Widget_Base {
	public function get_name() {
		return 'SkPortfolio';
	}
 
	public function get_title() {
		return __( 'Portfolio Slide', 'plugin-name' );
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
		$portfolio_repeater = new \Elementor\Repeater();
		$portfolio_repeater->add_control(
			'list_title',
			[  
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$portfolio_repeater->add_control(
			'thumbnail',
			[  
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control( 
			'portfolio_list',
			[
				'label' => esc_html__( 'Portfolio List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $portfolio_repeater->get_controls()
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
				'selector' => '{{WRAPPER}} .portfolio__card .title',
                'label'=>esc_html__( 'Title', 'textdomain' ),
			]
		); 
		$this->add_responsive_control(
			'card_title_magrin',
			[
				'label' => esc_html__( 'Title Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .portfolio__card .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		$this->add_responsive_control( 
			'card_padding',
			[
				'label' => esc_html__( 'Card Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .portfolio__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); 
		$this->start_controls_section(  
			'slide_content_style',
			[
				'label' => esc_html__( 'Slide Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Speed', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 15000,
				'step' => 1,
				'default' => 1000,
				'label_block'=>true
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
            <div class="portfolio-slide" data-speen='<?php echo $settings['speed']; ?>'> 
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['portfolio_list'] as $portfolio) { ?> 
                        <div class="swiper-slide">
                            <div class="portfolio__card_wrap">
                                <div class="portfolio__card">
                                    <h2 class="title ff__base"><?php echo $portfolio['list_title']; ?></h2>
                                    <div class="thumb">
                                        <img src="<?php echo wp_get_attachment_image_url($portfolio['thumbnail']['id'], 'full'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
	<?php }
}