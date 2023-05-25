<?php
include_once plugin_dir_path(__FILE__) . "trait/NavLinks.php";

class mayDayLinks extends \Elementor\Widget_Base {

	use NavLinks;

	public function get_name() {
		return 'May day links';
	}
 
	public function get_title() {
		return __( 'May day Links', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-editor-link';
	}
	 
	public function get_categories() {
		return [ 'mayday' ];
	}
	protected function _register_controls() {
		$this->navLinksControls();
	}
	protected function render() { 
		$this->renderNavLinks();
    }

}