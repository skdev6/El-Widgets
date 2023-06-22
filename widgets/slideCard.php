<?php
include_once plugin_dir_path(__FILE__) . "trait/ButtonSettings.php";
class slideCard extends \Elementor\Widget_Base {
    use ButtonSettings;
	public function get_name() {
		return 'slideCard';
	}
 
	public function get_title() {
		return __( 'Card Slide', 'plugin-name' );
	}
	public function get_icon() {
		return 'eicon-text-field';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'card_content_section',
			[
				'label' => __( 'Card Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$slide_repeater = new \Elementor\Repeater();
		$slide_repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'label_block'=>true
			]
		);
		$slide_repeater->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
				'label_block'=>true
			]
		);
		$slide_repeater->add_control(
			'card_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
				'label_block'=>true
			]
		);
		$slide_repeater->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);
		$slide_repeater->add_responsive_control( 
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units'=>['px'],
				'range'=>[
					'px'=>[
						'min'=>0,
						'max'=>500
					]
				], 
				'label_block'=>true, 
				'selectors'=>[
					"{{WRAPPER}} {{CURRENT_ITEM}} .icon__wrap svg"=>"width: {{SIZE}}{{UNIT}}",
					"{{WRAPPER}} {{CURRENT_ITEM}} .icon__wrap"=>"font-size: {{SIZE}}{{UNIT}}",
				]
			]  
		); 
		$this->add_control(
			'slide_repeater',
			[
				'label' => esc_html__( 'Buttons', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $slide_repeater->get_controls()
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
				'name' => 'card_sub_title_typography',
				'selector' => '{{WRAPPER}} .card-wrapper .sub-title',
                'label'=>esc_html__( 'Sub Title', 'textdomain' ),
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
        $this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Card Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
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
        $this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__( 'Section Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-slide-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'desktopView',
			[
				'label' => esc_html__( 'Desktop view', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->add_control(
			'tabView',
			[
				'label' => esc_html__( 'Tab view', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->add_control(
			'mobileView',
			[
				'label' => esc_html__( 'Mobile view', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
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
		$this->add_control(
			'slide_autoplay',
			[
				'label' => esc_html__( 'AutoPlay', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER, 
			]
		);
		$this->add_control(
			'desktopViewSpace',
			[
				'label' => esc_html__( 'Desktop Space', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->add_control(
			'tabViewSpace',
			[
				'label' => esc_html__( 'Tab Space', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->add_control(
			'mobileViewSpace',
			[
				'label' => esc_html__( 'Mobile Space', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->end_controls_section();
        $this->buttonsControls();
	}

	protected function render() { 
		$settings = $this->get_settings_for_display(); 
        ?>
		<div class="card-slide-wrapper <?php echo $settings['slide_autoplay'] === 'yes' ? 'has-autoplay' : ''; ?>" data-settings='{ 
            "desktopView":<?php echo $settings['desktopView']; ?>,
            "tabView":<?php echo $settings['tabView']; ?>,
            "mobileView":<?php echo $settings['mobileView']; ?>,
            "autoplay":<?php echo $settings['slide_autoplay'] === 'yes' ? 'true' : "false"; ?>,
            "speed":<?php echo $settings['speed']; ?>,
            "desktopViewSpace":<?php echo $settings['desktopViewSpace']; ?>,
            "tabViewSpace":<?php echo $settings['tabViewSpace']; ?>,
            "mobileViewSpace":<?php echo $settings['mobileViewSpace']; ?>
        }'>
			<div class="swiper">
				<div class="swiper-wrapper">  
					<?php foreach($settings['slide_repeater'] as $slide): ?>
					<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>">
						<div class="card__wrap">
							<div class="card-wrapper">
								<div class="icon__wrap">
									<?php \Elementor\Icons_Manager::render_icon( $slide['icon'], [ 'aria-hidden' => 'true' ] ); ?> 
								</div>
								<h2 class="title ff__base"><?php echo $slide['card_title']; ?></h2>
								<h3 class="sub-title"><?php echo $slide['card_sub_title']; ?></h3>
								<div class="des"><?php echo $slide['card_description']; ?></div>
								<?php $this->renderButtons(); ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php }
}