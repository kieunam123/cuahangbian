<?php 
if ( ! defined( 'ABSPATH' )) exit;
	$OldUser_options = ['all','home_page'];
	$check_option_prev = [];
	foreach ($OldUser_options as $options_value) {
		if ( isset($addon_option[$options_value]) && $addon_option[$options_value] ) {
			$check_option_prev[$options_value] = true;
		}
	}
// =========placement 
$popupPlaceMent = isset($addon_option['placement']) ? $addon_option['placement'] : '';
// =========device 
$device = isset( $addon_option['device'] ) ? $addon_option['device'] : 'all';
// =========page load  
$triggerV = ['class-id'=>'','minute'=>'00','second'=>'3','pageload'=>true]; 
if ( isset( $addon_option['trigger'] ) && is_array( $addon_option['trigger'] ) ) {
	foreach ($addon_option['trigger'] as $trigger_key => $trigger_value) {
			
			if ($trigger_key == 'page-load') {
				$triggerV['pageload'] = false;
				if ( $trigger_value == 'true' ) $triggerV['page-load'] = true;
			}else if( $trigger_key == 'time' && !empty($trigger_value) ){
				foreach ($trigger_value as $time_key => $Time_value) {
					if ($Time_value != '') {
						$triggerV[ $time_key ] = $Time_value; 
					}
				}
			}elseif( $trigger_key == 'click' && !empty($trigger_value) ){
				$triggerV['class-id'] = join( ',',$trigger_value );
			}else if( $trigger_key == 'page-scroll' ){
				$triggerV['page-scroll'] = $trigger_value;
			}else if( $trigger_key == 'exit' ){
				$triggerV['exit'] = true;
			}
		}	
}
$frequency = isset($addon_option['frequency']) ? [ $addon_option['frequency']=>true ] : false;
$popup_is_active = isset($popup_is_active) ? $popup_is_active : '';
?>


<section class="setting-submit-wrap wppb-title_">
	<div class="title__">
		<span>Title : </span>
		<span class="wppb-popup-title-name">Box Modal Name </span>
	</div>
	<div class="status__">
		<?php  
		echo $wp_builder_obj->checkbox("business-idd-",__("Status : ",'wppb'),'class="wppb_popup_setting_active" data-bid="'.$wppb_popup_id.'" '.$popup_is_active); 
		?>
	</div>
	<div class="save__">
		<button class="wppb-popup-setting-save business_disabled" data-bid="<?php echo $wppb_popup_id; ?>" >Save</button>
	</div>
</section>
<div class="wppb-popup-editor-divider"></div>


<!-- popup display -->
<section class="wppb-display-popup">
		<span class="popup-display-sub-heading">Popup Display Option</span>
		<span class="popup-display-sub-heading-2">Choose option to display popup at Whole Website (Includes all page, post, product etc), At Homepage only or at some selected page and post. You can also use a shortcode to display popup in the area which supports the shortcode.</span>
		<div class="wppb-popup-placement">
			<ul class="rl-clear">
				<li>
					<input id='popup--placement-all' type="radio" name="popup-placement" value="all" <?php if (isset($check_option_prev['all']) || $popupPlaceMent == "all" ) echo 'checked'; ?> >
					<label for='popup--placement-all'><span class="dashicons dashicons-admin-site-alt3"></span><span>Whole Site</span></label>
				</li>
				<li>
					<input id='popup--placement-home_page' type="radio" name="popup-placement" value="home_page" <?php if (isset($check_option_prev['home_page']) || $popupPlaceMent == "home_page" ) echo 'checked'; ?> >
					<label for='popup--placement-home_page'><span class="dashicons dashicons-admin-home"></span><span>Home Page</span></label>
				</li>
				<li>
					<input type="radio" name="popup-placement" value="pages" class="lock">
					<label><span class="dashicons dashicons-list-view"></span><span>Selected Pages</span></label>
				</li>
			</ul>
			<div class="wppb-perticular-page">
				<div class="wppb-perticular-page-shortcode">
		          <span class="wppb-popup-title"><?php _e('Shortcode','wppb') ?></span>
		          <span><?php _e('[wppb popup="'.$wppb_popup_id.'"]','wppb') ?></span>
		      </div>
		    </div>
		</div>
</section>
<div class="wppb-popup-editor-divider"></div>
<!-- popup display device -->
<section class="wppb-display-device">
<span class="popup-display-sub-heading">Choose Popup Display Device</span>
		<span class="popup-display-sub-heading-2">Here you can choose the device at which you want to display popup. Choose "All devices" to display popup at PC, Laptop and all small devices. And choose "Desktop" If you don't want to display popup at small mobile devices.</span>
		<div class="wppb-popup-placement">
			<ul class="rl-clear">
				<li>
					<input id='popup--device-all' type="radio" name="popup-device" value="all" <?php if( $device == "all" )echo "checked"; ?> >
					<label for='popup--device-all'><span class="dashicons dashicons-desktop"></span><span>All Device</span></label>
				</li>
				<li>
					<input  classtype="radio" name="popup-device" value="desktop" class="lock">
					<label ><span class="dashicons dashicons-desktop"></span><span>Desktop</span></label>
				</li>
				<li>
					<input type="radio" name="popup-device" value="mobile" class="lock">
					<label ><span class="dashicons dashicons-smartphone"></span><span>Mobile</span></label>
				</li>
			</ul>
		</div>
</section>
<!-- popup trigger -->
<div class="wppb-popup-editor-divider"></div>

<section class="wppb-display-trigger">
		<span class="popup-display-sub-heading">Popup Trigger</span>
		<span class="popup-display-sub-heading-2">This option allows you to choose when you want to trigger popup.</span>
		<div class="wppb-popup-placement">
			<ul class="rl-clear">
				<li>
					<input id='popup--trigger-page-load' type="checkbox" name="popup-trigger" value="page-load" <?php if( isset($triggerV['page-load']) || $triggerV['pageload'] ) echo 'checked'; ?> >
					<label for='popup--trigger-page-load'><span class="dashicons dashicons-update-alt"></span><span>Page Load</span></label>
				</li>
				<li>
					<input class="lock" type="checkbox" name="popup-trigger" value="click">
					<label><span class="dashicons dashicons-external"></span><span>On Click</span></label>
				</li>
				<li>
					<input class="lock" type="checkbox" name="popup-trigger" value="page-scroll">
					<label><span class="dashicons dashicons-arrow-up-alt"></span><span>Page Scroll</span></label>
				</li>
				<li>
					<input class="lock" type="checkbox" name="popup-trigger" value="exit">
					<label><span class="dashicons dashicons-dismiss"></span><span>Exit Window</span></label>
				</li>
			</ul>
		</div>
		<div class="trigger-time <?php if( !(isset($triggerV['page-load']) || $triggerV['pageload']) ) echo 'rl-display-none'; ?>">
		<div class="wppb-popup-editor-divider"></div>
			<div class="description_">
				<span>Page Load : Set Popup Trigger Time.</span>
				<span>Select "Page Load" to trigger popup at each time page load. You can also set a popup trigger delay.
				</span>
			</div>
			<div class="field_">
				<span class="popup-display-sub-heading-2">Time Spent After Appear Popup In Second </span>
				<input type="number" max="60" name="second" value="<?php echo $triggerV['second']; ?>">
			</div>
		</div>

</section>
<div class="wppb-popup-editor-divider"></div>
<section class="wppb-popup-frequency">
		<span class="popup-display-sub-heading">Frequency</span>
		<div class="wrap-frequency">
			<div>
				<input <?php if(isset($frequency['every-page']) ) echo 'checked'; ?> id="checkbox--frequency-every-page" type="radio" name="frequency" value="every-page">
				<label for="checkbox--frequency-every-page"><span class="dashicons dashicons-yes-alt"></span>Every Time Site Reload.</label>
			</div>

			<div>
				<input <?php if(isset($frequency['one-time']) ) echo 'checked'; ?> id="checkbox--frequency-show-time" type="radio" name="frequency" value="one-time">
				<label for="checkbox--frequency-show-time"><span class="dashicons dashicons-yes-alt"></span>One Time Show On Visit Page.</label>
			</div>
			<div class="frequency-day-hour">
				<input type="radio" name="frequency" value="after-time">
				<label><span class="dashicons dashicons-lock"></span>How Much Time After Show Popup. </label>
			</div>

		</div>
</section>

<div class="wppb-popup-editor-divider"></div>
<section class="setting-submit-wrap">
	<button class="wppb-popup-setting-save business_disabled" data-bid="<?php echo $wppb_popup_id; ?>" >Save</button>
</section>






