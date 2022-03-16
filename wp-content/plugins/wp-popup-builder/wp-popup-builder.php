<?php
/*
  Plugin Name: WP Popup Builder
  Description: WP popup builder is a great plugin for your business websites. Easiest to use with beautiful Pre-built Popup templates & a powerful drag and drop editor. It allows you to create and design lightbox popups to show them in your site Pages, Post and Widget areas ( Using Shortcodes or Without Shortcodes ). 
  Version: 1.1.4
  Author: ThemeHunk
  Author URI: https://www.themehunk.com/
  Text Domain: wppb
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define('WPPB_URL', plugin_dir_url(__FILE__));
define('WPPB_PATH', plugin_dir_path(__FILE__));


define("WPPB_PAGE_URL", admin_url('admin.php?page=wppb'));

include_once( WPPB_PATH . 'admin/inc.php');
include_once( WPPB_PATH . 'front/shortcode.php');
include_once( WPPB_PATH . 'front/load.php');

register_activation_hook( __FILE__ , 'wppb_install' );
add_action( 'plugins_loaded', 'wppb_loaded' );

function wppb_loaded(){
  $instance  = wppb::get();
  $load_Files =  wppb::load_file();
	  foreach ($load_Files as $value) {
		include_once( WPPB_PATH . 'admin/'.$value.'.php');
	  }
  	wppb_shortcode::get();
  	wppb_load::get();
 }















