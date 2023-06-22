<?php
include_once plugin_dir_path(__FILE__) . "trait/slideList.php";
class slideImgList extends \Elementor\Widget_Base {
	use slideListSettings; 
	public function get_name() {
		return 'slideImgList';
	}
 
	public function get_title() {
		return __( 'slide Images List', 'plugin-name' );
	} 
	public function get_icon() {
		return 'eicon-button';
	}
	 
	public function get_categories() {
		return [ 'sk_el_cat' ];
	}
	protected function _register_controls() {
        $this->imageSlideListControl();
	}

	protected function render() {
        $this->renderSlideImageList();
    }
}  