<?php if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'Business_Popup_Db' ) ) return;
class Business_Popup_Db{
  private static $db;
  private static $table;
  function __construct(){
    global $wpdb;
    self::$db = $wpdb;
    self::$table = self::$db->prefix.'business_popup';
  }

//get for addon for update 
  public static function Popup_show($bid){
    if ($bid && is_numeric($bid)) {
      return  self::$db->get_row("SELECT setting FROM ".self::$table." WHERE BID='".$bid."' AND is_active='1'");
    } 
  }
//get for addon for update 
  public static function Popup_show_all(){
    $querystr = "SELECT * FROM ".self::$table;
    $pageposts = self::$db->get_results($querystr);
    return !empty($pageposts)?$pageposts:false; 
  }
//get popup by id get bid and setting
  public function get_popup($bid){
    return is_numeric($bid)?self::$db->get_row("SELECT BID,setting FROM ".self::$table." WHERE BID='".$bid."'"):false;
  }

//business popup insert update
  public function Popups_insert(){
    if (isset($_POST['popup_id']) && is_numeric($_POST['popup_id']) && isset($_POST['htmldata'])) {
          $popup_id = intval($_POST['popup_id']);
          $exist_Addon = $this->get_popup($popup_id);
          if (!$exist_Addon) {
            $data['BID']    = $popup_id;
            $data['setting']  = wp_kses_post(trim(stripslashes($_POST['htmldata'])));
            $data['addon_name'] = 'business_popup';
            $data_formate = ['%d','%s','%s'];
            self::$db->insert(self::$table,$data, $data_formate);
            $result = self::$db->insert_id;
          }else{
              $data['is_active']  = isset($_POST['is_active'])?intval($_POST['is_active']):'';
              $formate_data     = ['%d'];
              // if setting is blank then update also setting save by active and deactive
              if (!$exist_Addon->setting) {
                $data['setting']  = wp_kses_post(trim(stripslashes($_POST['htmldata'])));
                $formate_data     = ['%d','%s'];
              }
              $where = ['BID'=>$exist_Addon->BID];
              $formate_data_where =  ['%d'];
              $result = self::$db->update( self::$table,$data , $where, $formate_data, $formate_data_where);
          }
          return $result;
    }
  }

  public function Popups_reset(){
    include_once BUSINESS_POPUP_PATH."inc/popup-default.php"; 
    if (isset($_POST['popup_id']) && is_numeric($_POST['popup_id'])) {
        $bid_ = intval($_POST['popup_id']);
        $htmlData = business_popup_default_html("popup".$bid_);
        if ($htmlData) {
            $data = array('setting' => wp_kses_post(trim( $htmlData )));
            $where = array('BID' => $bid_);
            $formate_data = ['%s'];
            $formate_where = ['%d'];
           return self::$db->update( self::$table,$data , $where, $formate_data, $formate_where);
        }
    }
  }

  //business popup insert update
  public function Popups_update(){
    if (isset($_POST['popup_id']) && isset($_POST['htmldata']) && is_numeric($_POST['popup_id']) && $_POST['htmldata'] != '') {
        $data = array('setting' => wp_kses_post(trim( stripslashes($_POST['htmldata']) )) );
        $where = array('BID' => intval($_POST['popup_id']));
        $formate_data = ['%s'];
        $formate_where = ['%d'];
       return self::$db->update( self::$table,$data , $where, $formate_data, $formate_where);
    }
  }
  //business popup update
  public function Option_Update(){
    if (isset($_POST['popup_id']) && isset($_POST['option_key']) && isset($_POST['option_value']) && is_numeric($_POST['popup_id'])) {
          
          $bid     = intval($_POST['popup_id']);
          $option_name = sanitize_text_field($_POST['option_key']);
          $option_value= sanitize_text_field($_POST['option_value']);
          $exist_Addon = self::$db->get_row("SELECT boption FROM ".self::$table." WHERE BID='".$bid."'");

          if(isset($exist_Addon->boption)){
            if ($exist_Addon->boption == '') {
              $option = [$option_name => $option_value];
            }elseif ($exist_Addon->boption != '') {
              $option = unserialize($exist_Addon->boption);
              $option[$option_name] = $option_value;
            }
              $data['boption'] = serialize($option);
              $result = self::$db->update( self::$table,$data , ['BID'=>$bid], ['%s'], ['%d']);
                if ($option_value) {
                    $already_on = $this->chekPopupStatus($option_name);
                    $result = $already_on?22:$result;
                }
              return $result;
          }
      }
  }
  // check that popup on or off on pages,post, and home page
  private function chekPopupStatus($option_name){
          $return_Html = self::popup_pages();
          $findAlready = 0;
          if (!empty($return_Html)) {
            foreach ($return_Html as $value) {
                  $option = unserialize($value->boption); 
                  if (isset($option[$option_name]) && $option[$option_name]) {
                      if($findAlready >= 2)break;
                      $findAlready++;     
                  }    
            }
          }
          return $findAlready >= 2?true:false;
  }
  //get popup for all pages,pages,post
  public static function popup_pages(){
    $querystr = "SELECT setting,boption FROM ".self::$table." WHERE setting !='' AND boption!='' AND is_active = 1";
    $pageposts = self::$db->get_results($querystr);
    return !empty($pageposts)?$pageposts:false; 
  }

// class end
}

