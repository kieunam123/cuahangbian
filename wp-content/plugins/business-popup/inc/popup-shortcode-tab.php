<?php if ( ! defined( 'ABSPATH' )) exit;

if (isset($_GET['popup'])) {
	$getPopup = sanitize_text_field($_GET['popup']);
	$current_popup_id 	   = str_replace('-', '', $getPopup);
	$current_popup_only_id = str_replace('popup','',$current_popup_id);

	if (isset($addonName[$current_popup_id]['option']) && $addonName[$current_popup_id]['option'] != '') {
		$addon_option = unserialize($addonName[$current_popup_id]['option']);
	}
	$options = ['pages','post','home_page'];
	$check_option = array();
	foreach ($options as $options_value) {
		$check_option[$options_value] = isset($addon_option[$options_value]) && $addon_option[$options_value]?'checked="checked"':'';
	}
}else{
	exit;
}

?>
 <div class="business-opt-wrapper">
   	 <section class="business-popup-position">
   		<div class="business-header-top-header">
  			<span class="business-popup-heading-title business-popup-title"><?php _e('Popup Position','business-popup'); ?></span>
  			<p class="business-popup-heading-description"><?php _e('Set Desired Location of Business Popup on your site.','business-popup'); ?></p>
   		</div>
  		<div class="business-popup-both">
			<!-- perticular page -->
			<div class="business-perticular-page">
	  		  <div class="business-popup-page-demo">
	  		  	<div></div><div></div><div></div><div></div>
	  		  	<div></div><div></div><div></div>
	  		  	<div class="business-popup-screen"></div>
	  		  </div>
				  <div class="business-perticular-page-shortcode">
		          <span class="business-popup-title"><?php _e('Particular Page','business-popup'); ?></span>
		          <input type="text" value='<?php _e('[business-popup popup="'.$current_popup_only_id.'"]','business-popup'); ?>'>
	          </div>
	        </div>
	        <p><?php _e('Or','business-popup') ?></p>
		    <!-- page by -->
	        <div class="business-opt-all-pages">
		        <div class="business-popup-optPopup-msg">
		        	<span class="dashicons dashicons-no optClose"></span><span class="opt_name"></span>
		        </div>
		        <div class="business-popup-optSaved-msg">
		        	<p><span class="checked-icon dashicons dashicons-yes"></span>Option Saved</p>
		        </div>
		  		  <div class="business-popup-page-demo">
		  		  	<div></div><div></div><div></div><div></div>
		  		  	<div></div><div></div><div></div>
		  		  	<div class="business-popup-screen"></div>
		  		  </div>
	        		<div class="business-opt-all-pages-div">
			            <span  class="business-popup-heading-title business-popup-title"><?php _e('Without Shortcode','business-popup'); ?></span>
			            <div class="business-opt-page-opt">
			                <div class="business-popup-checkbox-container">
			                  <span class="business-popup-checkbox-title"><?php _e('Home Page','business-popup'); ?></span>
			                  <div class="business-popup-checkbox">
			                    <input id="business-opt-home_page" type="checkbox" data-name="home_page" <?php _e($check_option['home_page'],'business-popup'); ?>>
			                    <label for="business-opt-home_page"></label>
			                  </div>
			                </div>
			                <div class="business-popup-checkbox-container">
			                  <span class="business-popup-checkbox-title"><?php _e('Pages','business-popup') ?></span>
			                  <div class="business-popup-checkbox">
			                    <input id="business-opt-pages" type="checkbox" data-name="pages" <?php _e($check_option['pages'],'business-popup') ?>>
			                    <label for="business-opt-pages"></label>
			                  </div>
			                </div>
			                <div class="business-popup-checkbox-container">
			                  <span class="business-popup-checkbox-title"><?php _e('Post','business-popup') ?></span>
			                  <div class="business-popup-checkbox">
			                    <input id="business-opt-post" type="checkbox" data-name="post" <?php _e($check_option['post'],'business-popup') ?>>
			                    <label for="business-opt-post"></label>
			                  </div>
			                </div>
			            </div>
			        </div>
		       </div>
		      <!-- page by -->
			  </div>
		</section>
 </div>
<div class="business-popup-editor-divider"></div>
<div class="business-header-top-header">
	<span class="business-popup-heading-title business-popup-title"><?php _e('Inline Popup','business-popup') ?></span>
	<p class="business-popup-heading-description"><?php _e('Display your Business Popup on Post and Widget Box areas.','business-popup') ?></p>
</div>	
<div class="business-popup-both">
	<!-- perticular page -->
	<div class="business-perticular-page">
		  <div class="business-popup-page-demo">
		  	<div></div><div></div>
		  	<div class="business-popup-inline-post"></div>
		  	<div></div><div></div>
		  </div>
		  <div class="business-perticular-page-shortcode">
          <span class="business-popup-title"><?php _e('Inline In Post','business-popup') ?> </span>
          <input type="text" value='<?php _e('[business-popup inline="'.$current_popup_only_id.'"]','business-popup'); ?>'>
      </div>
    </div>
    <p></p>
        <!-- page by -->
    <div class="business-perticular-page">
	  <div class="business-popup-page-demo">
	  	<section class="business-popup-widget-demo">
	  		<div>
	  			<div></div><div></div><div></div>
	  		</div>
	  		<div></div>
	  	</section>
	  			<div></div><div></div><div></div>
	  </div>
	  <div class="business-perticular-page-shortcode">
      <span class="business-popup-title"><?php _e('Widget Box','business-popup') ?></span>
      <input type="text" value='<?php _e('[business-popup widget="'.$current_popup_only_id.'"]','business-popup'); ?>'>
      </div>
    </div>
      <!-- page by -->
</div>
