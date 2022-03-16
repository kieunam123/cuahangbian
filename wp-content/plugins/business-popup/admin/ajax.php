<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
class business_popup_ajax extends Business_Popup_Db{
	public static $instance;
	 function __construct(){
			parent::__construct();
			add_action('wp_ajax_popup_update', array($this,'_update'));
			add_action('wp_ajax_popup_insert', array($this,'_insert'));
			add_action('wp_ajax_popup_update_html', array($this,'update_html'));
	}
	public static function get(){
		return self::$instance ? self::$instance : self::$instance = new self();
	}

	public function _insert(){
			$result = $this->Popups_insert();
			echo $result?$result:false;
		die();
	}
	public function update_html(){
			$result = isset($_POST['reset'])?$this->Popups_reset():$this->Popups_update();
			echo $result?$result:false;
		die();
	}
	public function _update(){
			$result = $this->Option_Update();
			echo $result?$result:false;
		die();
	}

}
business_popup_ajax::get();
