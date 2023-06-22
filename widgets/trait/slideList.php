<?php 

trait slideListSettings{
    function imageSlideListControl(){ 
		$this->start_controls_section(
			'image_list_content_section',
			[
				'label' => __( 'Slide Image List', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$img_list_repeater = new \Elementor\Repeater();
		$img_list_repeater->add_control(
			'list_image',
			[  
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		); 
		$img_list_repeater->add_control(
			'show_hi',
			[
				'label' => esc_html__( 'Show Hover Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER, 
			]
		);
		$img_list_repeater->add_control(
			'list_hover_image',
			[  
				'label' => esc_html__( 'Choose hover Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'=>[
					'show_hi'=>'yes'
				]
			]
		);
		$img_list_repeater->add_control(
			'image_list_url',
			[  
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$img_list_repeater->add_responsive_control(
			'image_list_width',
			[  
				'label' => esc_html__( 'width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units'=>['px', '%', 'vw'],
				'range'=>[
					'px'=>[
						'min'=>0,
						'max'=>500
					] 
				],
				'label_block'=>true,
				'selectors' => [
					'{{WRAPPER}} .img__item{{CURRENT_ITEM}} img' => 'width:{{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'image_list_repeter',
			[
				'label' => esc_html__( 'Buttons', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $img_list_repeater->get_controls()
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 
			'image_list_content_style',
			[
				'label' => esc_html__( 'Image List Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'image_list_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .img__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_list_spacing',
			[
				'label' => esc_html__( 'space', 'plugin-name' ),
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
					"{{WRAPPER}} .img-list-wrap"=>"margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}",
					"{{WRAPPER}} .img-list-wrap .img__item"=>"margin: {{SIZE}}{{UNIT}};",
				]
			]
		);
		$this->add_control(
			'image_list_show_border',
			[
				'label' => esc_html__( 'Show Border', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'image_list_list_block',
			[
				'label' => esc_html__( 'List Block', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
		$this->end_controls_section();
    }

	protected function renderSlideImageList() {
		$settingsImageList = $this->get_settings_for_display(); if(count($settingsImageList['image_list_repeter'])): ?>   

        <div class="img-slide-wrapper <?php echo $settingsImageList['slide_autoplay'] === 'yes' ? 'has-autoplay' : ''; ?>" data-settings='{
            "desktopView":<?php echo $settingsImageList['desktopView']; ?>,
            "tabView":<?php echo $settingsImageList['tabView']; ?>,
            "mobileView":<?php echo $settingsImageList['mobileView']; ?>,
            "autoplay":<?php echo $settingsImageList['slide_autoplay'] === 'yes' ? 'true' : "false"; ?>,
            "speed":<?php echo $settingsImageList['speed']; ?>
        }'>  
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($settingsImageList['image_list_repeter'] as $list) {
                        $target = $list['image_list_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $list['image_list_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                        $tag = $list['image_list_url']['url'] ? "a" : "div";
                        $links = $list['image_list_url']['url'] ?   'href="'. $list['image_list_url']['url'] .'" ' . $target . $nofollow  : "";
                        ?>
                        <div class="swiper-slide">
                            <<?php echo $tag ?> <?php echo $links; ?> class="img__item d-flex align-items-center elementor-repeater-item-<?php echo $list['_id']; ?> <?php echo $settingsImageList['image_list_show_border'] ? "has-wrap-border" : ""; ?> <?php echo $list['show_hi'] === 'yes' ? "has-hover-img" : ""; ?> ">
                                <img src="<?php echo wp_get_attachment_image_url($list['list_image']['id'], 'full') ?>" class="img-1" alt="">
                                <?php if($list['show_hi'] === 'yes'): ?>
                                <img src="<?php echo wp_get_attachment_image_url($list['list_hover_image']['id'], 'full') ?>" class="img-2" alt="">
                                <?php endif; ?>
                            </<?php echo $tag ?>>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

	<?php endif; }
}