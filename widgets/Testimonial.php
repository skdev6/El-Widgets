<?php
class SKTestimonial extends \Elementor\Widget_Base {
	public function get_name() {
		return 'SKTestimonial';
	}
 
	public function get_title() {
		return __( 'Testimonial Slide', 'plugin-name' );
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
				'label' => __( 'Card Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$testimonial_repeater = new \Elementor\Repeater(); 
		$testimonial_repeater->add_control(
			'thumbnail',
			[  
				'label' => esc_html__( 'Choose Thumbnail', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$testimonial_repeater->add_control(
			'list_title',
			[  
				'label' => esc_html__( 'Name', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$testimonial_repeater->add_control(
			'list_info',
			[  
				'label' => esc_html__( 'Info', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$testimonial_repeater->add_control(
			'logo',
			[  
				'label' => esc_html__( 'Choose Logo', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$testimonial_repeater->add_control(
			'video_link',
			[   
				'label' => esc_html__( 'Video Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '' , 'textdomain' ), 
				'label_block' => true,
			]
		);
		$testimonial_repeater->add_responsive_control( 
			'logo__size',
			[
				'label' => esc_html__( 'Logo Size', 'plugin-name' ),
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
					"{{WRAPPER}} {{CURRENT_ITEM}} .t_logo img"=>"width:{{SIZE}}{{UNIT}};",
				]
			]
		);
		$this->add_control(  
			'testimonial_list',
			[
				'label' => esc_html__( 'Testimonial List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $testimonial_repeater->get_controls()
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
				'selector' => '{{WRAPPER}} .testimonial__card .title',
                'label'=>esc_html__( 'Title', 'textdomain' ),
			]
		);  
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'selector' => '{{WRAPPER}} .testimonial__card .info',
                'label'=>esc_html__( 'Info', 'textdomain' ),
			]
		); 
		$this->add_control( 
			'card_thumb_magrin',
			[
				'label' => esc_html__( 'Thumbnail', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial__card .thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);  
		$this->add_control(
			'card_title_magrin',
			[
				'label' => esc_html__( 'Title Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial__card .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		$this->add_control(
			'card_info_magrin',
			[
				'label' => esc_html__( 'Info Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial__card .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		$this->add_control( 
			'card_padding',
			[
				'label' => esc_html__( 'Card Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'vw', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		<section class="testimonial-section position-relative">
            <div class="testimonial-slide"> 
                <div class="container-fluid">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($settings['testimonial_list'] as $portfolio) { ?> 
							<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $portfolio['_id'] ); ?>">
								<div class="testimonial__card_wrap">
									<div class="video-wrapper"></div>
									<div class="testimonial__card" data-video="<?php echo $portfolio['video_link']; ?>"> 
										<div class="thumb">
											<img src="<?php echo wp_get_attachment_image_url($portfolio['thumbnail']['id'], 'full'); ?>" alt="">
										</div>
										<h2 class="title ff__base"><?php echo $portfolio['list_title']; ?></h2>
										<p class="info"><?php echo $portfolio['list_info']; ?></p> 
										<div class="card-footer d-flex flex-wrap align-items-center"> 
											<div class="t_logo me-auto"><img src="<?php echo wp_get_attachment_image_url($portfolio['logo']['id'], 'full'); ?>" alt=""></div>
											<button class="arrow__btn"> 
												<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M16.8759 1.6875V11.8125C16.8759 12.2601 16.6982 12.6893 16.3817 13.0057C16.0652 13.3222 15.636 13.5 15.1884 13.5C14.7409 13.5 14.3117 13.3222 13.9952 13.0057C13.6787 12.6893 13.5009 12.2601 13.5009 11.8125V5.7607L2.88235 16.3814C2.72556 16.5382 2.53943 16.6626 2.33458 16.7474C2.12973 16.8323 1.91017 16.8759 1.68844 16.8759C1.46671 16.8759 1.24715 16.8323 1.0423 16.7474C0.83745 16.6626 0.651318 16.5382 0.494532 16.3814C0.337746 16.2246 0.213376 16.0385 0.128524 15.8336C0.0436718 15.6288 0 15.4092 0 15.1875C0 14.9658 0.0436718 14.7462 0.128524 14.5414C0.213376 14.3365 0.337746 14.1504 0.494532 13.9936L11.1152 3.375H5.06344C4.61589 3.375 4.18666 3.19721 3.8702 2.88074C3.55373 2.56427 3.37594 2.13505 3.37594 1.6875C3.37594 1.23995 3.55373 0.810726 3.8702 0.494258C4.18666 0.17779 4.61589 0 5.06344 0H15.1884C15.636 0 16.0652 0.17779 16.3817 0.494258C16.6982 0.810726 16.8759 1.23995 16.8759 1.6875Z" fill="#D5D5D5"/>
												</svg>
											</button>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
            </div>
			<div class="video__popup_wrapper"> 
				<div class="container-fluid">
					<div class="video__popup">
						<button class="close__btn"> 
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21.0753 4.32508L14.179 11.2188L21.0753 18.1124C21.2698 18.307 21.4241 18.5379 21.5294 18.7921C21.6347 19.0462 21.6889 19.3186 21.6889 19.5938C21.6889 19.8689 21.6347 20.1413 21.5294 20.3954C21.4241 20.6496 21.2698 20.8806 21.0753 21.0751C20.8807 21.2696 20.6498 21.4239 20.3956 21.5292C20.1415 21.6345 19.869 21.6887 19.5939 21.6887C19.3188 21.6887 19.0464 21.6345 18.7922 21.5292C18.5381 21.4239 18.3071 21.2696 18.1126 21.0751L11.2189 14.1788L4.32527 21.0751C4.13074 21.2696 3.89979 21.4239 3.64563 21.5292C3.39146 21.6345 3.11904 21.6887 2.84394 21.6887C2.56883 21.6887 2.29641 21.6345 2.04225 21.5292C1.78808 21.4239 1.55714 21.2696 1.36261 21.0751C1.16808 20.8806 1.01377 20.6496 0.908487 20.3954C0.803208 20.1413 0.749023 19.8689 0.749023 19.5938C0.749023 19.3186 0.803208 19.0462 0.908487 18.7921C1.01377 18.5379 1.16808 18.307 1.36261 18.1124L8.2589 11.2188L1.36261 4.32508C0.969735 3.93221 0.749023 3.39936 0.749023 2.84375C0.749023 2.28815 0.969735 1.7553 1.36261 1.36242C1.75548 0.969552 2.28833 0.74884 2.84394 0.74884C3.39954 0.74884 3.93239 0.969552 4.32527 1.36242L11.2189 8.25871L18.1126 1.36242C18.3071 1.16789 18.5381 1.01358 18.7922 0.908304C19.0464 0.803025 19.3188 0.74884 19.5939 0.74884C19.869 0.74884 20.1415 0.803025 20.3956 0.908304C20.6498 1.01358 20.8807 1.16789 21.0753 1.36242C21.2698 1.55696 21.4241 1.7879 21.5294 2.04206C21.6347 2.29623 21.6889 2.56865 21.6889 2.84375C21.6889 3.11886 21.6347 3.39128 21.5294 3.64544C21.4241 3.89961 21.2698 4.13055 21.0753 4.32508Z" fill="#D5D5D5"/>
							</svg>
						</button>
						<div class="vdo-player"></div>
					</div>
				</div>
			</div>
			</section>
	<?php }
}