<?php
trait NavLinks{

    public function get_abailable_menus(){
        $menus = wp_get_nav_menus();
        $options = [];
        foreach($menus as $menu){
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }

	public function navLinksControls() {

		$this->start_controls_section(
			'navlinks_content_section',
			[
				'label' => __( 'NavLinks Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $menus_links = $this->get_abailable_menus();
		$this->add_control(
			'menus_links', 
			[
				'label' => __( 'Select Menu', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT, 
                'options'=> $menus_links,
                'default' => array_keys($menus_links)[0],
				'label_block'=>true
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 
			'navlinks_style',
			[
				'label' => esc_html__( 'Nav links Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'navlinks_padding',
            [
                'label' => esc_html__( 'Links Padding', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .navbar__nav li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'sublinks_padding',
            [
                'label' => esc_html__( 'Sub Links Padding', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .navbar__nav li > ul > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'links_color',
			[
				'label' => esc_html__( 'Links Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navbar__nav li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Links Typography', 'textdomain' ),
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .navbar__nav li a',
			]
		);
		$this->end_controls_section();
	}
	protected function renderNavLinks() {
		$settings = $this->get_settings_for_display();
        
		wp_nav_menu([
			'menu'=>$settings['menus_links'],
			'menu_class'=>'navbar__nav',
			'container'=>'ul'
		]);
	
	}

}