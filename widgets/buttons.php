<?php 
include_once plugin_dir_path(__FILE__) . "trait/ButtonSettings.php";
 
class skdevButton extends \Elementor\Widget_Base {
	
	use ButtonSettings;

	public function get_name() {
		return 'skdevButton';
	}
 
	public function get_title() {
		return __( 'Button', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-button';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
		$this->buttonsControls(); 
	}

	protected function render() {
		$this->renderButtons();
	}
}