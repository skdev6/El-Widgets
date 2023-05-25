<?php


	add_action( 'elementor/element/after_section_end', "skdev_custom_poition", 10, 2 );

	function skdev_custom_poition( $widget, $section_id ) {
		if ( 'section_advanced' === $section_id || '_section_style' === $section_id ) {
			// Adds Positioning Options
			$widget->start_controls_section(
				'skdev_el_section_advanced_position',
				array(
					'label'     => __('Custom Positioning <small style="color:#2878e1;">MayDay</small>', 'mayday' ),
					'tab'       => \Elementor\Controls_Manager::TAB_ADVANCED
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_type',
				array(
					'label'       => __('Position Type', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'static'   => __('Static', 'mayday' ),
						'relative' => __('Relative', 'mayday' ),
						'absolute' => __('Absolute', 'mayday' )
					),
					'default'      => '',
					'selectors'    => array(
						'{{WRAPPER}}' => 'position:{{VALUE}};',
					)
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_top',
				array(
					'label'      => __('Top', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'top:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_right',
				array(
					'label'      => __('Right', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'right:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					),
					'return_value' => ''
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_bottom',
				array(
					'label'      => __('Bottom', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'bottom:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_left',
				array(
					'label'      => __('Left', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);

			$widget->add_responsive_control(
				'skdev_el_position_from_center',
				array(
					'label'      => __('From Center', 'mayday' ),
					'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);
			$widget->add_responsive_control(
				'skdev_el_position_zindex',
				array(
					'label'       => __('Z-Index', 'mayday' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'      => '',
					'selectors'    => array(
						'{{WRAPPER}}' => 'z-index:{{VALUE}};',
					)
				)
			);
			$widget->add_responsive_control(
				'skdev_el_height',
				array(
					'label'      => __('Height', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'height:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);
			$widget->add_responsive_control(
				'skdev_el_width',
				array(
					'label'      => __('Width', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}}' => 'width:{{SIZE}}{{UNIT}};'
					),
					'condition' => array(
						'skdev_el_position_type' => array('relative', 'absolute')
					)
				)
			);
			$widget->end_controls_section();
			$widget->start_controls_section(
				'skdev_el_section_advanced_transform',
				array(
					'label'     => __('Custom transform <small style="color:#2878e1;">MayDay</small>', 'mayday' ),
					'tab'       => \Elementor\Controls_Manager::TAB_ADVANCED
				)
			);

			$widget->add_control(
				'skdev_transform__offset',
				[
					'label' => esc_html__( ' Offset', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
					'label_off' => esc_html__( 'Default', 'textdomain' ),
					'label_on' => esc_html__( 'Custom', 'textdomain' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$widget->start_popover();
			$widget->add_responsive_control(
				'skdev__offset_x',
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
						'{{WRAPPER}}' => 'transform: translateX({{SIZE}}{{UNIT}});',
					],
				]
			);
			$widget->add_responsive_control(
				'skdev__offset_y',
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
						'{{WRAPPER}}' => 'transform: translateY({{SIZE}}{{UNIT}});',
					],
				]
			);
			$widget->end_popover();

			$widget->end_controls_section();

			$widget->start_controls_section(
				'skdev_el_section_advanced_extra_settings',
				array(
					'label'     => __('Extra Settings <small style="color:#2878e1;">MayDay</small>', 'mayday' ),
					'tab'       => \Elementor\Controls_Manager::TAB_ADVANCED
				)
			);

			$widget->add_responsive_control(
				'skdev_el_row_reverse',
				array(
					'label'       => __('Flex Row', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'row-reverse'   => __('Row Reverse', 'mayday' ),
						'row' => __('Row', 'mayday' )
					),
					'default'      => '',
					'separator' => 'after',
					'selectors'    => array(
						'{{WRAPPER}} > .elementor-container' => 'flex-direction:{{VALUE}};',
					)
				)
			);
			$widget->add_control(
				'add_prallax_to_bg',
				[
					'label'        => __( 'Custom Prallax', 'elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'custom-bg-prallax',
					'prefix_class' => 'skdev-',
				]
			);
			$widget->add_group_control( 
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'skdev_peallax____background',
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}}',
				]
			);
			$widget->add_control(
				'background_overlay',
				[
					'label'        => __( 'Background Overlay', 'elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'background_overlay',
					'prefix_class' => 'custom-'
				]
			);
			$widget->add_responsive_control(
				'background_overlay_clr',
				[
					'label' => esc_html__( 'Overlay Color', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => '--overlay-clr: {{VALUE}}',
					],
					'separator' => 'after'
				]
			);
			$widget->add_control(
				'with_container_padding',
				array(
					'label'       => __('Container space', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'pl-box-container'   => __('Left', 'mayday' ),
						'pr-box-container' => __('Right', 'mayday' )
					),
					'default'      => '',
					'prefix_class' => '',
					'separator' => 'before',
				)
			); 
			$widget->add_control(
				'with_container_gap_fill',
				array(
					'label'       => __('Container space gap fill', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'container__space_gap_left'   => __('Left', 'mayday' ),
						'container__space_gap_right' => __('Right', 'mayday' )
					),
					'default'      => '',
					'prefix_class' => '',
				)
			); 
			$widget->add_control(
				'with_container_gap_fill_color',
				[
					'label' => esc_html__( 'Background Fill Color', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => '--gap-fill-color: {{VALUE}}',
					],
					'condition' => array(
						'with_container_gap_fill' => array('container__space_gap_left', 'container__space_gap_right')
					),
					'separator' => 'after',
				]
			);
			$widget->add_control( 
				'icon_list_style_extra',
				array(
					'label'       => __('Extra Icon list style', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						'' => __('No', 'mayday' ),
						'custom__icon__list'   => __('Yes', 'mayday' ),
					),
					'default'      => '',
					'prefix_class' => '',
					'separator' => 'before',
				)
			); 
			$widget->add_control(
				'custom__icon__list_padding',
				[
					'label' => esc_html__( 'Padding', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}}.custom__icon__list .elementor-icon-list-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => array( 
						'icon_list_style_extra' => array('custom__icon__list')
					),
				]
			);
			$widget->add_control(
				'custom__icon__list_border',
				[
					'label'        => __( 'Border', 'elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'icon__list_border',
					'prefix_class' => 'custom__',
					'condition' => array( 
						'icon_list_style_extra' => array('custom__icon__list')
					),
				]
			);
			$widget->add_control(
				'icon__text_decaration_underline',
				array(
					'label'       => __('Icon Text Decaration', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'underline'   => __('underline', 'mayday' ),
						'line-through' => __('line-through', 'mayday' )
					),
					'selectors'    => array(
						'{{WRAPPER}}.custom__icon__list .elementor-icon-list-item .elementor-icon-list-text' => 'text-decoration:{{VALUE}};',
					),
					'condition' => array( 
						'icon_list_style_extra' => array('custom__icon__list')
					),
					'separator' => 'after',
				)
			); 
			// Custom Background shape start
			// Custom Background shape start
			// Custom Background shape start
			$widget->add_responsive_control(
				'custom_background_shape',
				array(
					'label'       => __('Custom background shape', 'mayday' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT,
					'options'     => array(
						''         => __('Default', 'mayday' ),
						'has_custom_bg__shape'   => __('Yes', 'mayday' ),
						'' => __('No', 'mayday' ),
					),
					'default'      => '',
					'prefix_class' => '',
					'separator' => 'before',
				)
			);
			$widget->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'label' => esc_html__( 'Choose shape', 'textdomain' ),
					'name' => 'custom_shape_image',
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}}  .main--custom-shape-wrap',
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				]
			);
			$widget->add_responsive_control(
				'custom_shape_el_position_top',
				array(
					'label'      => __('Top', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'top:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);

			$widget->add_responsive_control(
				'custom_shape_el_position_right',
				array(
					'label'      => __('Right', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'right:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
					'return_value' => ''
				)
			);

			$widget->add_responsive_control(
				'custom_shape_el_position_bottom',
				array(
					'label'      => __('Bottom', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'bottom:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);

			$widget->add_responsive_control(
				'custom_shape_el_position_left',
				array(
					'label'      => __('Left', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'left:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);

			$widget->add_responsive_control(
				'custom_shape_el_position_from_center',
				array(
					'label'      => __('From Center', 'mayday' ),
					'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);
			$widget->add_responsive_control(
				'custom_shape_el_position_zindex',
				array(
					'label'       => __('Z-Index', 'mayday' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'default'      => '',
					'selectors'    => array(
						'{{WRAPPER}} .main--custom-shape-wrap' => 'z-index:{{VALUE}};',
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);
			$widget->add_responsive_control(
				'custom_shape_el_height',
				array(
					'label'      => __('Height', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'height:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);
			$widget->add_responsive_control(
				'custom_shape_el_width',
				array(
					'label'      => __('Width', 'mayday' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array('px', 'em', '%', 'vw', 'vh'),
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
						'{{WRAPPER}} .main--custom-shape-wrap' => 'width:{{SIZE}}{{UNIT}};'
					),
					'condition' => array( 
						'custom_background_shape' => array('has_custom_bg__shape')
					),
				)
			);
			// Custom Background shape end
			// Custom Background shape end
			// Custom Background shape end
			$widget->add_control(
				'col_h_fit',
				[
					'label'        => __( 'Col Height Fit', 'elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'h_fit',
					'prefix_class' => 'col_',
					'separator' => 'after',
				]
			);
			$widget->end_controls_section();
		}
	}