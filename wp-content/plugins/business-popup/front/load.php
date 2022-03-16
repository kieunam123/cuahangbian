<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 

class business_popup_load{
	private function __construct(){
		add_action( 'wp_footer', array($this,'footer_load') );
	}
	public static function get(){
		return new self();
	}
	public  function footer_load(){
 		$return_Html = Business_Popup_Db::popup_pages();
 		if (!empty($return_Html)) {
 			foreach ($return_Html as $key => $value) {
 					$option = unserialize($value->boption); 					
 						// for all page setting
	 					if (isset($option['pages']) && $option['pages'] && get_post_type() === 'page') {
	 						echo '<div data-option="1" class="business-popup-open popup active">'.$value->setting.'</div>';
	 					}else if (isset($option['post']) && $option['post'] && get_post_type() === 'post') {
	 						echo '<div data-option="1" class="business-popup-open popup active">'.$value->setting.'</div>';
	 					}else if (isset($option['home_page']) && $option['home_page']  && is_front_page()) {
	 					echo '<div data-option="1" class="business-popup-open popup active">'.$value->setting.'</div>';
	 					} 					
 			}
 		}
 	}
// class end
}
