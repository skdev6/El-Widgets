<?php
include_once plugin_dir_path(__FILE__) . "trait/ButtonSettings.php";
class customContentSection extends \Elementor\Widget_Base {
    use ButtonSettings;
	public function get_name() {
		return 'customContentSection';
	}
 
	public function get_title() {
		return __( 'Custom Content Section', 'plugin-name' );
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
		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);        
        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'label_block'=>true
			]
		); 
        $img_repeater = new \Elementor\Repeater();
		$img_repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $img_repeater->add_responsive_control(
            'skdev_el_position_type',
            array(
                'label'       => __('Position Type', 'sk' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => array(
                    ''         => __('Default', 'sk' ),
                    'static'   => __('Static', 'sk' ),
                    'relative' => __('Relative', 'sk' ),
                    'absolute' => __('Absolute', 'sk' )
                ),
                'default'      => '', 
                'selectors'    => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'position:{{VALUE}};',
                )
            )
        );

        $img_repeater->add_responsive_control(
            'skdev_el_position_top',
            array(
                'label'      => __('Top', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'top:{{SIZE}}{{UNIT}};'
                )
            )
        );

        $img_repeater->add_responsive_control(
            'skdev_el_position_right',
            array(
                'label'      => __('Right', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'right:{{SIZE}}{{UNIT}};'
                ),
                'return_value' => ''
            )
        );

        $img_repeater->add_responsive_control(
            'skdev_el_position_bottom',
            array(
                'label'      => __('Bottom', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'bottom:{{SIZE}}{{UNIT}};'
                )
            )
        );

        $img_repeater->add_responsive_control(
            'skdev_el_position_left',
            array(
                'label'      => __('Left', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'left:{{SIZE}}{{UNIT}};'
                )
            )
        );

        $img_repeater->add_responsive_control(
            'skdev_el_position_from_center',
            array(
                'label'      => __('From Center', 'sk' ),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );'
                )
            )
        );
        $img_repeater->add_responsive_control(
            'skdev_el_position_zindex',
            array(
                'label'       => __('Z-Index', 'sk' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'default'      => '',
                'selectors'    => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'z-index:{{VALUE}};',
                )
            )
        );
        $img_repeater->add_responsive_control(
            'skdev_el_height',
            array(
                'label'      => __('Height', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap img' => 'height:{{SIZE}}{{UNIT}};'
                )
            )
        );
        $img_repeater->add_responsive_control( 
            'skdev_el_width',
            array(
                'label'      => __('Width', 'sk' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                'range'      => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1
                    ),
                    '%' => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1
                    )
                ),
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap img' => 'width:{{SIZE}}{{UNIT}};min-width:{{SIZE}}{{UNIT}};',
                )
            )
        );
        $img_repeater->add_responsive_control(
			'img__wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.img__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'img_lists',
			[
				'label' => esc_html__( 'Images', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $img_repeater->get_controls()
			]
		); 
		$this->end_controls_section();


		$this->start_controls_section( 
			'content_style',
			[
				'label' => esc_html__( 'Section Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control( 
                'section_height',
                array(
                    'label'      => __('Height', 'sk' ),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                    'range'      => array(
                        'px' => array(
                            'min'  => -1000,
                            'max'  => 1000,
                            'step' => 1
                        ),
                        '%' => array(
                            'min'  => -100,
                            'max'  => 100,
                            'step' => 1
                        ),
                        'em' => array(
                            'min'  => -150,
                            'max'  => 150,
                            'step' => 1
                        )
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} .custom_section' => 'height:{{SIZE}}{{UNIT}};'
                    )
                )
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'label' => esc_html__( 'Section background', 'textdomain' ),
                    'name' => 'sk_custom_sec_background',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .custom_section',
                ]
            );
            $this->add_responsive_control(
                'section_padding',
                [
                    'label' => esc_html__( 'Section Padding', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .custom_section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'text_area_padding',
                [
                    'label' => esc_html__( 'Text area padding', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control( 
                'textarea_max_width',
                array(
                    'label'      => __('Max Width', 'sk' ),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => array('px', 'em', '%', 'vw', 'vh', 'custom'),
                    'range'      => array(
                        'px' => array(
                            'min'  => -1000,
                            'max'  => 1000,
                            'step' => 1
                        ),
                        '%' => array(
                            'min'  => -100,
                            'max'  => 100,
                            'step' => 1
                        ),
                        'em' => array(
                            'min'  => -150,
                            'max'  => 150,
                            'step' => 1
                        )
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} .custom_section .text__area' => 'max-width:{{SIZE}}{{UNIT}};'
                    )
                )
            );
		$this->end_controls_section();
		$this->start_controls_section( 
			'headingcontent_style',
			[
				'label' => esc_html__( 'Heading Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'heading_margin',
                [
                    'label' => esc_html__( 'Heading Margin', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .title-xxl' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 
            $this->add_responsive_control(
                'headingtext__color',
                [
                    'label' => esc_html__( 'Heading Color', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .title-xxl' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'headingtext_stroke_color',
                [
                    'label' => esc_html__( 'Heading stroke Color', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .title-xxl' => '-webkit-text-stroke-color: {{VALUE}}; stroke:{{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'heading_stroke_width',
                [
                    'label' => esc_html__( 'Heading width', 'plugin-name' ),
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
                        "{{WRAPPER}} .text__area .title-xxl"=>"-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; stroke-width: {{SIZE}}{{UNIT}}",
                    ]
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'plugin-name' ),
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .text__area .title-xxl',
                ]
            );
		$this->end_controls_section(); 

		$this->start_controls_section( 
			'titlecontent_style',
			[
				'label' => esc_html__( 'Title Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title__color',
                [
                    'label' => esc_html__( 'Color', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'plugin-name' ),
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .text__area .title',
                ]
            );
		$this->end_controls_section();
		$this->start_controls_section( 
			'descontent_style',
			[
				'label' => esc_html__( 'Description Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'des_margin',
                [
                    'label' => esc_html__( 'Margin', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'des__color',
                [
                    'label' => esc_html__( 'Color', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .custom_section .text__area .des' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'plugin-name' ),
                    'name' => 'des_typography',
                    'selector' => '{{WRAPPER}} .text__area .des',
                ]
            );
		$this->end_controls_section(); 
        $this->buttonsControls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 
        ?>
        <section class="custom_section d-flex position-relative text-start">
            <div class="text__area d-flex flex-column"> 
                <?php if($settings['heading'] != ""): ?>
                    <h2 class="title-xxl ff__base"><?php echo $settings['heading']; ?></h2>
                <?php endif; ?>
                <?php if($settings['title'] != ""): ?>
                    <h2 class="title ff__base"><?php echo $settings['title']; ?></h2>
                <?php endif; ?>
                <?php if($settings['description'] != ""): ?>
                    <div class="des">
                        <?php echo $settings['description']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php foreach($settings['img_lists'] as $img): ?>
                <div class="img__wrap  elementor-repeater-item-<?php echo esc_attr( $img['_id'] ); ?>"><img src="<?php echo wp_get_attachment_image_url($img['image']['id'], 'full'); ?>" alt=""></div>
            <?php endforeach; ?>
        </section>
	<?php }
}