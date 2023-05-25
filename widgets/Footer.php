<?php
include_once plugin_dir_path(__FILE__) . "trait/ImageListSettings.php";
class SkdevFooter extends \Elementor\Widget_Base {
	use ImageListSettings;
	public function get_name() {
		return 'SkdevFooter';
	}
 
	public function get_title() {
		return __( 'May Day - Footer', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-footer';
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
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'left_box_title',
			[
				'label' => esc_html__( 'Left box Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
			]
		);
		$this->add_control(
			'left_box_des',
			[
				'label' => esc_html__( 'Left Box description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
			]
		);
		$this->add_control(
			'copyright__text',
			[
				'label' => esc_html__( 'Copyright Text', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default title', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
			]
		);
		$footer_social_list = new \Elementor\Repeater();
		$footer_social_list->add_control(
			'footer_social_icon',
			[  
				'name'=>"footer_icon",
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS
			]
		);
		$footer_social_list->add_control(
			'footer_social_url',
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
		$this->add_control(
			'footer_social',
			[
				'label' => esc_html__( 'Footer Social Media', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $footer_social_list->get_controls()
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'footer_right_content_section',
			[
				'label' => __( 'Footer Links', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$links_repeter = $this->get_abailable__menus();
		$footer_menu_links = new \Elementor\Repeater();
		$footer_menu_links->add_control(
			'link_list_title',
			[  
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$footer_menu_links->add_control(
			'footer_select_menu',
			[  
				'label' => __( 'Select Menu', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT, 
				'options'=> $links_repeter,
				'default' => array_keys($links_repeter)[0],
				'label_block'=>true
			]
		);
		$this->add_control(
			'footer_menu_links',
			[
				'label' => esc_html__( 'Footer Social Media', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $footer_menu_links->get_controls()
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
		$this->add_responsive_control(
			'footer_col_space',
			[
				'label' => esc_html__( 'Col Space', 'textdomain' ),
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
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .footer-wrapper' => '--footer-right-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Title Typography', 'textdomain' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Content Typography', 'textdomain' ),
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .content-area',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Copyright Text Typography', 'textdomain' ),
				'name' => 'copyright_typography',
				'selector' => '{{WRAPPER}} .copyright-text',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .footer-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'label'=>'Footer Background',
				'name' => 'footer_bg',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .footer-wrapper .left-bg',
			]
		);
		$this->add_responsive_control(
			'footer_angle_width',
			[
				'label' => esc_html__( 'Angle Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw', 'vh', 'custom' ],
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
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .footer-wrapper' => '--footer-angle-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();	
		$this->imageListControl();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<footer class="footer-wrapper d-lg-flex overflow-hidden content-area">
			<div class="left-area d-flex align-items-center">
				<div class="left-bg"></div>
				<div class="footer__box">
					<div class="footer__box_content">
						<h2 class="title"><?php echo $settings['left_box_title']; ?></h2>
						<div class="des"><p><?php echo $settings['left_box_des']; ?></p></div>
						<div class="d-none d-lg-block"><?php $this->renderImageList(); ?></div>
						<?php $this->getSocialMediaIcons(); ?>
						<div class="copyright-text d-none d-lg-block"><?php echo $settings['copyright__text']; ?></div>
					</div>
				</div>
			</div>
			<div class="right-area"> 
				<span class="cliping-wrapper"><span class="cliping"></span></span>
				<div class="footer-link-box">
				<div class="d-flex flex-wrap">
					<?php foreach ($settings['footer_menu_links'] as $key => $value) { ?>
							<div class="footer-item">
								<h2 class="title"><?php echo $value['link_list_title'] ?></h2>
								<?php 
									wp_nav_menu([
										'menu'=>$value['footer_select_menu'],
										'menu_class'=>'footer-menu-links',
										'container'=>'ul'
									]);
								?>
							</div>

					<?php } ?> 
						</div>
				</div>
				<div class="d-lg-none"><?php $this->renderImageList(); ?></div>
				<div class="copyright-text d-lg-none"><?php echo $settings['copyright__text']; ?></div>
			</div>
		</footer>

	<?php }

	public function getSocialMediaIcons(){ 
		$settings = $this->get_settings_for_display();
	?>
	<ul class="social-media-icons">
		<?php foreach ($settings['footer_social'] as $Footer_social) {
			$target = $Footer_social['footer_social_url']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $Footer_social['footer_social_url']['nofollow'] ? ' rel="nofollow"' : ''; 
		?>
			<li>
				<a href="<?php echo $Footer_social['footer_social_url']['url']; ?>" <?php $target . $nofollow ?>>
					<?php \Elementor\Icons_Manager::render_icon( $Footer_social['footer_social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php }


}