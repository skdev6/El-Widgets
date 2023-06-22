<?php

class pageSettings{

    function __construct($element){
        $this->registerControls($element);
    }

    function registerControls($element){
        $element->start_controls_section(
			'sk_dev_page_shape_style',
			[
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' 		=> esc_html__(' May day shape style', 'master-addons' )
			]
		);
		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shape_bg_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .body-shape-wrapper .body_shape__main',
                'label' => esc_html__( 'Shape background', 'textdomain' ),
			]
		);
		$element->add_responsive_control(
			'bg_shape_width',
			[
				'label' => esc_html__( 'Background shape Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'vw' => [
						'min' => 0,
						'max' => 1000,
					],
                    'vh' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .body-shape-wrapper .body_shape__main' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$element->add_responsive_control(
			'bg_shape_height',
			[
				'label' => esc_html__( 'Background shape height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'vw' => [
						'min' => 0,
						'max' => 1000,
					],
                    'vh' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .body-shape-wrapper .body_shape__main' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $element->add_responsive_control(
			'bg_shape_rotate',
			[
				'label' => esc_html__( 'Background shape rotate', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' =>360,
						'step' => 0.1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .body-shape-wrapper .body_shape__main' => '--shape-rotate: {{SIZE}}deg;', 
				],
			]
		);
        $element->add_responsive_control(
			'bg_trnsf_xx',
			[
				'label' => esc_html__( 'Background shape transform X', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => -5000,
						'max' => 5000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
                    'vw' => [
						'min' => -1000,
						'max' => 1000,
					],
                    'vh' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .body-shape-wrapper .body_shape__main' => '--transform-x: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $element->add_responsive_control(
			'bg_trnsf_yy',
			[
				'label' => esc_html__( 'Background shape transform Y', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => -5000,
						'max' => 5000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
                    'vw' => [
						'min' => -1000,
						'max' => 1000,
					],
                    'vh' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .body-shape-wrapper .body_shape__main' => '--transform-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$element->end_controls_section();

        $element->start_controls_section(
			'page_modals__content',
			[
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
				'label' 		=> __('Modal <small style="color:#2878e1;"><a href="https://sumonkhan.pro/">sk</a></small>', 'sk_dev' ),
			]
		);
		$page__modal_repeter = new \Elementor\Repeater();

		$page__modal_repeter->add_control(
			'page__modal_id',
			[
				'label' => esc_html__( 'Id', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Modal-Id', 'textdomain' ),
				'label_block'=>true
			]
		);
		$page__modal_repeter->add_control(
			'page__modal_shortcode',
			[
				'label' => esc_html__( 'Template Shortcode', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Template Shortcode', 'textdomain' ),
				'label_block'=>true
			]
		);
		$element->add_control(
			'page__modal_repeter',
			[
				'label' => esc_html__( 'Modal', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $page__modal_repeter->get_controls()
			]
		);
		$element->end_controls_section();

    }
}  

add_action('wp_footer', 'renderPageSettings');

function renderPageSettings(){
	$page_id  = get_the_ID();
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );
	$page_settings_model = $page_settings_manager->get_model( $page_id );
?>
<div class="body-shape-wrapper w-100 overflow-hidden position-absolute left-0 top-0">
    <div class="body_shape__main"></div>
</div>
<div class="backdrop popup__backdrop"></div>
		<?php
			$get_page__modal_repeter = $page_settings_model->get_settings( 'page__modal_repeter' );
			if($get_page__modal_repeter):
			foreach ($get_page__modal_repeter as $modal) { if($modal['page__modal_id'] != ""){ ?>

				<div class="popup-wrapper d-flex align-items-center justify-content-center" id="<?php echo $modal['page__modal_id']; ?>">
					<div class="content__wrap_main has-sq-shape w-100">
						<div class="content-wrap">
							<button class="close-btn">
								<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="13.8763" cy="13.8763" r="13.8763" fill="black"/>
									<rect x="17.8828" y="8.42383" width="2.4779" height="13.3807" transform="rotate(45 17.8828 8.42383)" fill="white"/>
									<rect x="19.6367" y="17.8867" width="2.4779" height="13.3807" transform="rotate(135 19.6367 17.8867)" fill="white"/>
								</svg>
							</button>
							<div class="content__area"> 
								<?php echo do_shortcode($modal['page__modal_shortcode']); ?>
							</div>
						</div>
					</div>
				</div>

		<?php } }  endif; 

}