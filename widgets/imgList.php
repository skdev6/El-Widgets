<?php
include_once plugin_dir_path(__FILE__) . "trait/ImageListSettings.php";
class imgList extends \Elementor\Widget_Base {
	use ImageListSettings;
	public function get_name() {
		return 'imgList';
	}
 
	public function get_title() {
		return __( 'Image List', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-button';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
        $this->imageListControl();
	}

	protected function render() {
        $this->renderImageList();
    }
} 