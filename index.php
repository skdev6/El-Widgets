<?php
/**
 * Plugin Name:       ClickTab Elementor Addons
 * Description:       There are all elementor addons for ClickTab
 * Version:           1.0.0
 * Author:            sumonkhan.pro 
 * Author URI:        https://sumonkhan.pro/
 * Text Domain:       sk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly. ""0.0.07"")
}

define("MAYDAY_VERSION", uniqid());     


final class Elementor_sk_dev_Extenstion {

	const VERSION = '1.0.0';  
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0'; 
	const MINIMUM_PHP_VERSION = '5.6'; 
	private static $_instance = null; 
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	 
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	 
	public function i18n() {

		load_plugin_textdomain( 'TC' );

	}

	 
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action('elementor/documents/register_controls', [$this, 'init_document_controls'], 10);
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ], 100 );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ], 100 );
		add_action( 'elementor/elements/categories_registered', [$this, 'register_new_catagory'], 0 );
		require_once( __DIR__ . '/widgets/sectionSettings.php' );
		
		add_action('save_post_elementor-hf', [$this, 'clear_elementor_cache']);
		add_action('save_post_ae_global_templates', [$this, 'clear_elementor_cache']);
	}

	function clear_elementor_cache() {
		// Make sure that Elementor loaded and the hook fired
		if ( did_action( 'elementor/loaded' ) ) {
		// Automatically purge and regenerate the Elementor CSS cache
		  \Elementor\Plugin::instance()->files_manager->clear_cache();
		}
	}

	public function register_new_catagory($maneger){
		$maneger->add_category(
			'sk_el_cat',
			[
				'title' => __( 'ClickTab', 'mayday' ),
				'icon' => 'eicon-date',
			]
		);
	}
	
	public function widget_styles() {
		wp_enqueue_style( 'swiper', plugins_url( 'widgets/assets/css/swiper.css', __FILE__ ), null, '0.0.0.1', null); 
		wp_enqueue_style( 'bootstrap', plugins_url( 'widgets/assets/css/bootstrap.min.css', __FILE__ ), null, '0.0.0.1', null); 
		wp_enqueue_style( 'mayday-main', plugins_url( 'widgets/assets/css/style.css', __FILE__ ), null, MAYDAY_VERSION, null); 
	}
 
	public function widget_scripts() {   
		wp_enqueue_script( 'gsap', plugins_url( 'widgets/assets/js/gsap.min.js', __FILE__ ), [ 'jquery' ], '0.0.0.1', true); 
		wp_enqueue_script( 'ScrollTrigger', plugins_url( 'widgets/assets/js/ScrollTrigger.min.js', __FILE__ ), [ 'jquery' ], '0.0.0.1', true);
		wp_enqueue_script( 'locomotive-scroll', plugins_url( 'widgets/assets/js/locomotive-scroll.min.js', __FILE__ ), [ 'jquery' ], '0.0.0.1', true);
		// wp_enqueue_script( 'jquery-sticky', plugins_url( 'widgets/assets/js/jquery-sticky.js', __FILE__ ), [ 'jquery' ], '0.0.0.1', true);
		wp_enqueue_script( 'swiper', plugins_url( 'widgets/assets/js/swiper.js', __FILE__ ), [ 'jquery' ], MAYDAY_VERSION, true);
		wp_enqueue_script( 'skdev-main', plugins_url( 'widgets/assets/js/main.js', __FILE__ ), [ 'jquery' ], MAYDAY_VERSION, true);
		// wp_enqueue_script( 'mayday-head-main', plugins_url( 'widgets/assets/js/head.main.js', __FILE__ ), null, MAYDAY_VERSION, false);  
	}  


	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	 
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
 
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
	 
	public function init_widgets() {
		// Include Widget files 
		require_once( __DIR__ . '/widgets/buttons.php' ); 
		require_once( __DIR__ . '/widgets/Card.php' ); ; 
		require_once( __DIR__ . '/widgets/scrollToRight.php' );
		require_once( __DIR__ . '/widgets/textAutoScroll.php' );
		require_once( __DIR__ . '/widgets/portfolio.php' );
		require_once( __DIR__ . '/widgets/Testimonial.php' );
		require_once( __DIR__ . '/widgets/brandSlide.php' );
		require_once( __DIR__ . '/widgets/imgList.php' );
		require_once( __DIR__ . '/widgets/slideImgList.php' );
		require_once( __DIR__ . '/widgets/checkBoxToggle.php' );
		require_once( __DIR__ . '/widgets/slideCard.php' );
		require_once( __DIR__ . '/widgets/customContentSection.php' );
		
        // Register widget     
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \skdevButton() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \skdevCard() );   
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \skScrollToRight() );   
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \textAutoScroll() );   
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SkPortfolio() );    
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \SKTestimonial() ); 
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \brandSlide() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \imgList() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \slideImgList() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \checkBoxToggle() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \slideCard() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \customContentSection() );
	}  

	public function init_document_controls($element){
		require_once( __DIR__ . '/widgets/pageSettings.php' ); 
		new \pageSettings($element);
		 
	}
}

Elementor_sk_dev_Extenstion::instance();

add_action( 'wp_body_open', function(){ 

?> 
<div class="video__popup_wrapper"></div>
<?php });