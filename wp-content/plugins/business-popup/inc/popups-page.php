<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
	// popup setting
	$havePopup = [1,2,3,4,5,6];

	$popup_html_all_section = '';
	foreach ($havePopup as $popupKey => $popupValue) {
			$business_id 	   = isset($addonName['popup'.$popupValue]['BID'])?$addonName['popup'.$popupValue]['BID']:"";
			$business_isActive = $business_id && $addonName['popup'.$popupValue]['is_active']?"checked='checked'":"";
			$business_disable  = !$business_isActive?'business_disabled':"";
			$business_addon_setting = $addonName["popup".$popupValue]["setting"];
			if ($popupKey == 0) {
				$popup_html_all_section .= '<div class="business-popup-row business-popup_clear">';
			}
			$popup_html_all_section .= '<div class="business-popup-column-three">
										<div class="business-popup-demo-'.$popupValue.'">
												<div class="business-popup-save-html business-popup-'.$popupValue.'" data-bid="'.$popupValue.'">
													'.__($business_addon_setting,"business-popup").'
												</div>
											<div class="business-popup-demo-settings">
												<div class="business-popup-setting-btns">
													<a class="business-popup-view" href="#" data-popup="'.$popupValue.'">'.__("DEMO","business-popup").'</a>
													<div class="business-popup-checkbox">
														<input id="business_popup-'.$popupValue.'" type="checkbox" class="business_popup_setting_active" data-bidd="'.$popupValue.'" data-bid="'.$business_id.'" '.$business_isActive.'>
														<label for="business_popup-'.$popupValue.'"></label>
													</div>
													<a class="business-popup-setting can_disable '.$business_disable.'" href="'.esc_url(BUSINESS_POPUP_PAGE_URL.'&popup=popup-'.$popupValue).'">'.__("SETTINGS","business-popup").'</a>
												</div>
											</div>
										</div>
						</div>';
			if(count($havePopup) == ($popupKey+1)){
				$popup_html_all_section .= '</div>';
			}elseif(($popupKey+1) % 3 === 0){
				$popup_html_all_section .= '</div><div class="business-popup-row business-popup_clear">';
			}			
	}
?>

<div id="business-popup-demos-container">
	<section id="business-popup-section">
			<?php echo $popup_html_all_section; ?>
	</section>
</div>