<?php 
trait ButtonSettings{
	// Buttons Function Start
	function buttonsControls(){
		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Buttons Control START
		$button_repeater = new \Elementor\Repeater();
		$button_repeater->add_control(
			'button_type',
			[  
				'label' => esc_html__( 'Button Type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '', 
				'options' => [
					''  => esc_html__( 'Default', 'plugin-name' ),
					'light' => esc_html__( 'Light', 'plugin-name' ),
					'outline-light' => esc_html__( 'Light Outline ', 'plugin-name' ),
					'dark' => esc_html__( 'Dark', 'plugin-name' ),
					'outline-dark' => esc_html__( 'Dark Outline', 'plugin-name' ),
					'round' => esc_html__( 'Round', 'plugin-name' ),
				],
			]
		);
		$button_repeater->add_responsive_control(
			'btn_size',
			[
				'label' => esc_html__( 'Button Size', 'plugin-name' ),
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
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main"=>"width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}",
				],
				'condition'=>[
					'button_type'=>'round'
				]
			] 
		);
		$button_repeater->add_control(
			'btn_name',
			[
				'label' => esc_html__( 'Button Name', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);
		$button_repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Button Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'label_block'=>true
			]
		);
		$button_repeater->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr'  => esc_html__( 'Before', 'plugin-name' ),
					'rtl' => esc_html__( 'After', 'plugin-name' )
				],
			]
		);
		$button_repeater->add_responsive_control(
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
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main svg"=>"width: {{SIZE}}{{UNIT}}",
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main i"=>"font-size: {{SIZE}}{{UNIT}}",
				]
			] 
		);
		$button_repeater->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Icon space', 'plugin-name' ),
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
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main.ltr svg,  {{WRAPPER}} {{CURRENT_ITEM}}.btn-text.ltr svg"=>"margin-right: {{SIZE}}{{UNIT}}",
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main.ltr i,  {{WRAPPER}} {{CURRENT_ITEM}}.btn-text.ltr i"=>"margin-right: {{SIZE}}{{UNIT}}",
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main.rtl svg,  {{WRAPPER}} {{CURRENT_ITEM}}.btn-text.rtl svg"=>"margin-left: {{SIZE}}{{UNIT}}",
					"{{WRAPPER}} {{CURRENT_ITEM}}.btn__main-wrap .btn__main.rtl i,  {{WRAPPER}} {{CURRENT_ITEM}}.btn-text.rtl i"=>"margin-left: {{SIZE}}{{UNIT}}",
				]
			]
		); 
		$button_repeater->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn__main svg path, {{WRAPPER}} {{CURRENT_ITEM}} .btn-text svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn__main i, {{WRAPPER}} {{CURRENT_ITEM}} .btn-text i' => 'color: {{VALUE}}',
				],
			]
		);
		$button_repeater->add_control( 
			'btn_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn__main:hover svg path, {{WRAPPER}} {{CURRENT_ITEM}} .btn-text:hover svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn__main:hover i, {{WRAPPER}} {{CURRENT_ITEM}} .btn-text:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$button_repeater->add_responsive_control( 
            'btn_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .btn__main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$button_repeater->add_control(
			'btn_url',
			[
				'label' => esc_html__( 'Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'plugin-name' ),
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$button_repeater->add_control(
			'extra_class',
			[
				'label' => esc_html__( 'Extra class name', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);
		$button_repeater->add_control( 
			'MagneticButtons',
			[
				'label' => esc_html__( 'Magnetic Effect', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'textdomain' ),
				'label_off' => esc_html__( 'Off', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'buttons_lists',
			[
				'label' => esc_html__( 'Buttons', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $button_repeater->get_controls()
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 
			'bg_style_section',
			[
				'label' => esc_html__( 'Buttons Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Buttons Typography', 'plugin-name' ),
				'name' => 'buttons_typography',
				'selector' => '{{WRAPPER}} .btn__main',
			]
		);
		$this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-fg.btn, {{WRAPPER}} .btn__main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'btn_margin',
            [
                'label' => esc_html__( 'Margin', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-fg.btn, {{WRAPPER}} .btn__main-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'text_color', 
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn__main, {{WRAPPER}} .btn__main' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'textdomain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .btn__main, {{WRAPPER}} .btn-text',
			]
		);
		$this->add_responsive_control(
			'button_spacing',
			[
				'label' => esc_html__( 'Buttons space', 'plugin-name' ),
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
					"{{WRAPPER}} .btn-group-wrap"=>"margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}",
					"{{WRAPPER}} .btn__main-wrap"=>"margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}",
				]
			]
		);
		$this->add_responsive_control(
			'btn__align',
			[
				'label' =>esc_html__( 'Alignment', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' =>esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' =>esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .btn-group-wrap' => 'justify-content: {{VALUE}};',
				],
			]
		); 
		$this->add_responsive_control(
			'button_width_width',
			[
				'label' => esc_html__( 'Buttons Width', 'textdomain' ),
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
					'{{WRAPPER}} .btn__main-wrap .btn__main,{{WRAPPER}} .btn__main-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	} // Buttons Function End 

	public function get__buttons(){

		$settings = $this->get_settings_for_display(); 

		foreach($settings['buttons_lists'] as $index=>$button): 
			$btn_target = $button['btn_url']['is_external'] ? ' target="_blank"' : '';
			$btn_nofollow = $button['btn_url']['nofollow'] ? ' rel="nofollow"' : '';
		?>
			<div class="btn__main-wrap d-inline-block elementor-repeater-item-<?php echo esc_attr( $button['_id'] ); ?> <?php echo $button['MagneticButtons'] ? "magnetic-btn" : ""; ?>"> 
				<a href="<?php echo $button['btn_url']['url']; ?>" <?php echo $btn_target . $btn_nofollow ?> class="btn__main btn-<?php echo $button['button_type']; ?> <?php echo $button['extra_class']; ?> <?php echo $button['icon_pos']; ?> ">
					<?php
						echo "<span class='btn__text__wrap d-inline-flex align-items-center'>";
						if($button['icon_pos'] === 'ltr'){
							\Elementor\Icons_Manager::render_icon( $button['icon'], [ 'aria-hidden' => 'true' ] ); 
							echo "<span class='btn___text'>".$button['btn_name']."</span>"; 
						}else{ 
							echo "<span class='btn-text'>".$button['btn_name']."</span>";
							\Elementor\Icons_Manager::render_icon( $button['icon'], [ 'aria-hidden' => 'true' ] );
						}
						echo "</span>";
						
					?>
				</a>
			</div>
		<?php endforeach; 
	}

    function renderButtons(){ 

		$settings = $this->get_settings_for_display();

		if(count($settings['buttons_lists']) <= 1){

			$this->get__buttons();

		}else{ ?>
			<div class="btn-group-wrap d-flex flex-wrap">
				<?php $this->get__buttons(); ?>
			</div>
		<?php }
    }

}