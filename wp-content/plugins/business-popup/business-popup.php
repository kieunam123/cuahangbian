<?php
/*
  Plugin Name: Business Popup
  Plugin URI: https://themehunk.com/product/business-popup/
  Description: ThemeHunk Business Popup Free WordPress Plugin is specially built to show Lightbox Popup on your Page, Posts and Custom Posts. It contains ready to use popups with editing options and powerful animation effects. It will display all changes in real time. Just customize the desired popup and use it.
  Version: 1.0.2
  Author: ThemeHunk
  Author URI: http://www.themehunk.com/
  Text Domain: business-popup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

define('BUSINESS_POPUP_URL', plugin_dir_url(__FILE__));
define('BUSINESS_POPUP_PATH', plugin_dir_path(__FILE__));

define('BUSINESS_POPUP_DIR', BUSINESS_POPUP_URL.'addons/');
define("BUSINESS_POPUP_PAGE_URL", admin_url('admin.php?page=business-popup'));
define('BUSINESS_POPUP_PAGE_PATH', BUSINESS_POPUP_PATH.'addons/');

include_once( BUSINESS_POPUP_PATH . 'admin/inc.php');
include_once( BUSINESS_POPUP_PATH . 'front/shortcode.php');
include_once( BUSINESS_POPUP_PATH . 'front/load.php');

register_activation_hook( __FILE__, 'business_popup_install' );
add_action( 'plugins_loaded', 'business_popup_loaded' );

 function business_popup_loaded(){
  $instance  = business_popup::get();
  $load_Files =  business_popup::load_file();
	  foreach ($load_Files as $value) {
		include_once( BUSINESS_POPUP_PATH . 'admin/'.$value.'.php');
	  }
  	business_popup_shortcode::get();
  	business_popup_load::get();
 }







