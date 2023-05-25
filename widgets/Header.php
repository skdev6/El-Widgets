<?php
include_once plugin_dir_path(__FILE__) . "trait/ButtonSettings.php";
include_once plugin_dir_path(__FILE__) . "trait/NavLinks.php";

class SkdevHeader extends \Elementor\Widget_Base {

	use ButtonSettings; 
	use NavLinks;

	public function get_name() {
		return 'SkdevHeader';
	}
 
	public function get_title() {
		return __( 'Header', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-header';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}

    public function get_abailable__menus(){
        $menus = wp_get_nav_menus();
        $options = [];
        foreach($menus as $menu){
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'header_content_section',
			[
				'label' => __( 'Header Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'logo_lg',
			[
				'label' => esc_html__( 'Logo', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block'=>true
			]
		);
		// $this->add_control(
		// 	'logo_sm',
		// 	[
		// 		'label' => esc_html__( 'Logo small', 'plugin-name' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'label_block'=>true
		// 	]
		// );
		$this->end_controls_section();

		$this->start_controls_section( 
			'header_content_style',
			[
				'label' => esc_html__( 'Header Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'header_logo_width',
			[
				'label' => esc_html__( 'Logo Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-area .navbar-lg .logo' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'logo_margin',
            [
                'label' => esc_html__( 'Logo Margin', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .header-area .navbar-lg .logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
		$this->add_responsive_control(
            'header__padding',
            [
                'label' => esc_html__( 'Header Padding', 'elementskit-lite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .header-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
		$this->add_control(
			'header_sticky',
			[
				'label' => esc_html__( 'Sticky Header', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		$this->buttonsControls();
		$this->navLinksControls();

		$this->start_controls_section(
			'mobile_nav_section',
			[
				'label' => __( 'Mobile Nav Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$mobile_nav_links_repeter = $this->get_abailable__menus();
		$mobile_nav_repeater = new \Elementor\Repeater();
		$mobile_nav_repeater->add_control(
			'mobile_menu_title',
			[
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block'=>true
			]
		);
		$mobile_nav_repeater->add_control(
			'mn_links', 
			[
				'label' => __( 'Select Menu', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT, 
                'options'=> $mobile_nav_links_repeter,
                'default' => array_keys($mobile_nav_links_repeter)[0],
				'label_block'=>true
			]
		);
		$this->add_control(
			'mobile_nav_repeter',
			[
				'label' => esc_html__( 'Buttons', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $mobile_nav_repeater->get_controls()
			]
		); 
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Nav Typography', 'textdomain' ),
				'name' => 'mobileNavcontent_typography',
				'selector' => '{{WRAPPER}} .header-area .mobile-menu-wrapper .navbar__nav_sm li a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Nav Title Typography', 'textdomain' ),
				'name' => 'mobileNavTitlecontent_typography',
				'selector' => '{{WRAPPER}} .header-area .mobile-menu-wrapper .title',
			]
		);
		$this->end_controls_section();
	}
	protected function render() { 
		$settings = $this->get_settings_for_display();
        ?>
        <header class="header-area <?php echo $settings['header_sticky'] ? "sticky--header" : ""; ?>">
			<div class="container">
				<div class="navbar-lg d-flex align-items-center flex-wrap">
					<button class="btn-transparent burger-btn open-side-menu d-lg-none">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
					</button>
					<a href="<?php echo home_url('/'); ?>" class="logo d-inline-block me-auto">
						<img src="<?php echo esc_url(wp_get_attachment_image_url($settings['logo_lg']['id'], 'full'))?>" alt="Logo">
					</a>
					<?php  
					echo '<div class="d-none d-lg-flex">' ;
						$this->renderNavLinks(); 
					echo '</div>';
					$this->renderButtons();
					?>
				</div>
			</div>
			<div class="mobile-menu-wrapper d-lg-none">
				<div class="mobile-menu-content-wrap">
					<div class="menu-content-wrap">
						<div class="mmenu-header d-flex align-items-center">
							<button class="close-btn close-side-menu d-lg-none">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
							</button>
						</div>
						<?php 
							foreach ($settings['mobile_nav_repeter'] as $key => $mmenu) {
								echo '<h5 class="title">'. $mmenu['mobile_menu_title'] .'</h5>';
								wp_nav_menu([
									'menu'=>$mmenu['mn_links'],
									'menu_class'=>'navbar__nav_sm',
									'container'=>'ul'
								]);
							}
						?>
					</div>
				</div>
			</div>
		</header>
	<?php }

}