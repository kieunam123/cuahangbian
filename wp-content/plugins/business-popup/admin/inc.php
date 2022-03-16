<?php if ( ! defined( 'ABSPATH' ) ) exit; 
ob_start();

// popup directory
class business_popup {
	private static $instance;

	private function __construct(){
        add_action( 'admin_init', array( $this, 'create_roles' ) );
		add_action('admin_menu', array($this, 'admin_menu'));
  		add_action('admin_enqueue_scripts', array($this,'enqueue_admin_script') );
		add_action('wp_enqueue_scripts', array($this,'enqueue_front_script') );
	}
	public static function get() {
		return self::$instance ? self::$instance : self::$instance = new self();
	}

	public function create_roles() {
	    global $wp_roles;

	    if ( ! class_exists( 'WP_Roles' ) ) {
	        return;
	    }
	    if ( ! isset( $wp_roles ) ) {
	        $wp_roles = new WP_Roles();
	    }
	    // Shop manager role
	    add_role( 'business_popup_role', __( 'Business Popup Role', 'business-popup' ), array(
	        'level_9'        => true,
	        'read'          => true,
	    ) );
	    $wp_roles->add_cap( 'business_popup_role', 'business_popup_manager' );
	    $wp_roles->add_cap( 'administrator', 'business_popup_manager' );
	}
	public function admin_menu() {
	    add_menu_page( __('Business Popup', 'business-popup'), __('Business Popup', 'business-popup'),'business_popup_manager', 'business-popup',array($this ,'display_addons'));
	}
	public function display_addons(){
            include_once BUSINESS_POPUP_PATH."inc/popup-editor.php"; 
            include_once BUSINESS_POPUP_PATH."inc/popup-default.php"; 
        if (isset($_GET['popup']) && $_GET['popup'] != '') {
            include_once BUSINESS_POPUP_PATH."inc/popup.php"; 
        }else{
            include_once BUSINESS_POPUP_PATH."inc/popups-page.php"; 
        }
	}

	public function enqueue_admin_script($hook){
			if('toplevel_page_business-popup'!=$hook) return;

		  wp_enqueue_style( 'pickr', BUSINESS_POPUP_URL . 'js/nano.min.css',false);
		  wp_enqueue_script( 'pickr', BUSINESS_POPUP_URL . 'js/pickr.es5.min.js', array ( 'jquery' ), 1, true);
		  wp_enqueue_style( 'business-popup', BUSINESS_POPUP_URL . 'css/style.css',false);
		  wp_enqueue_style( 'business-popup-style', BUSINESS_POPUP_URL . 'css/popup_style.css',false);
		  wp_enqueue_media();
		  wp_enqueue_script( 'business-popup-js', BUSINESS_POPUP_URL . 'js/script.js', array ( 'jquery' ), 1, true);
		  wp_localize_script('business-popup-js', 'business_popup_ajax_backend', array('business_popup_ajax_url' => admin_url('admin-ajax.php')));
	}

	public function enqueue_front_script(){
		  wp_enqueue_style('business-popup-front', BUSINESS_POPUP_URL . 'css/fstyle.css',false);
		  wp_enqueue_script('business-popup-front-js', BUSINESS_POPUP_URL . 'js/fscript.js', array ( 'jquery' ), 1, true);
		}

	public static function load_file(){
		 	return  array('db','ajax');
		}

}

function business_popup_install() {
      global $wpdb;
      $table = $wpdb->prefix .'business_popup';
      $charset_collate = $wpdb->get_charset_collate();
      $create_table_query = "CREATE TABLE IF NOT EXISTS $table (
          BID INT(11) PRIMARY KEY AUTO_INCREMENT ,
          addon_name VARCHAR(100) NOT NULL,
		      setting LONGTEXT NOT NULL,
		      boption TEXT NOT NULL,
          is_active BOOLEAN DEFAULT '1'
        ) $charset_collate;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $create_table_query );
  }
ob_end_clean();








