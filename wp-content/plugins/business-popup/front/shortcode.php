<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 

class business_popup_shortcode{
	private function __construct(){
		add_shortcode( 'business-popup', array($this,'popup') );	
	}
	public static function get(){
		return new self();
	}
 	public function popup( $atts ,$content) {
			    $a = shortcode_atts( array('popup' => '','inline' => '','widget' => ''), $atts );
				$popup_id = false;
				if ($a['inline']) {
					$popup_id = $a['inline'];
					$open_popup_div = '<div class="business-popup-open inline_ inline-popup active">'; 
				}elseif ($a['popup']) {
					$popup_id = $a['popup'];	
					$open_popup_div = '<div class="business-popup-open popup active">'; 
				}elseif ($a['widget']) {
					$popup_id = $a['widget'];	
					$open_popup_div = '<div class="business-popup-open inline_ widget-popup active">'; 
				}
				if ($popup_id) {
					$return_Html = Business_Popup_Db::Popup_show($popup_id);
					return $return_Html?$open_popup_div.$return_Html->setting.'</div>':'';
				}
	}
// class end
}
