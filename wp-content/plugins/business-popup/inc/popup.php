<?php if ( ! defined( 'ABSPATH' ) ) exit;
	if (isset($_GET['popup'])) {
		$getPopup = sanitize_text_field($_GET['popup']);
		if (!file_exists(BUSINESS_POPUP_PAGE_PATH.'popup/'.$getPopup.".php"))exit;
	}else{
		exit;
	}
?>
<div class="business-popup-cmn-container">	
	<div class="business-popup-cmn-nav">
		<div class="business-popup-cmn-nav-item">
				<a class="business_icon_button" href="<?php echo esc_url(BUSINESS_POPUP_PAGE_URL); ?>"><span class="dashicons dashicons-arrow-left-alt"></span><span><?php _e('Back','business-popup'); ?></span></a>
				<a class="business_icon_button business-popup-tab active" data-tab='setting' href="#"><span class="dashicons dashicons-edit"></span><span><?php _e('Edit Popup','business-popup') ?></span></a>
				<a class="business_icon_button business-popup-tab" data-tab='option' href="#"><span><?php _e('[ / ]','business-popup') ?></span><span><?php _e('Popup Shortcode','business-popup') ?></span></a>
		</div>	
	</div>
	<section class="business-popup-demo business-popup-tab-container active">
			<div class="BusinessAddonClone"></div>

			<div class="resetConfirmPopup">
				<div class="reserConfirm_inner">
					<div class="resetWrapper">
						<div class="resetHeader">
							<span><?php _e('Confirm Reset','business-popup') ?></span>
						</div>
						<div class="resetFooter">
							<a class="businessPopup popup deny" href="#"><span class="dashicons dashicons-dismiss"></span><?php _e('No','business-popup') ?></a>
							<a class="businessPopup popup confirm" href="#"><span class="dashicons dashicons-yes-alt"></span><?php _e('Yes','business-popup') ?></a>
						</div>
					</div>
				</div>
			</div>


				<!-- popup effect  -->
					<div class="business-popup-effect-option">
						<div class="business-popup-effect-option-header">
							<span class="business-underline-header"><?php _e('Popup Effect','business-popup') ?></span>
						</div>
						<div class="radio-container">

						    <div class="option_radio">
						    	<span><?php _e('Effect 1','business-popup') ?></span>
								<input type="radio" id="radioEf1" name="effect" value="1">
								<label for="radioEf1">
							  		<div class="business-popup-screen2"><div></div></div>
								</label>
							</div>
							<div class="option_radio">
						    	<span><?php _e('Effect 2','business-popup') ?></span>
								<input type="radio" id="radioEf2" name="effect" value="2">
								<label for="radioEf2">
									<div class="business-popup-screen2"><div></div></div>
								</label>
							</div>
							<div class="option_radio">
						    	<span><?php _e('Effect 3','business-popup') ?></span>
								<input type="radio" id="radioEf3" name="effect" value="3">
								<label for="radioEf3">
									<div class="business-popup-screen2"><div></div></div>
								</label>
							</div>
						</div>
					</div>  
				<!-- popup effect  -->
			<?php include_once BUSINESS_POPUP_PAGE_PATH.'popup/'.$getPopup.".php"; ?>
			<div class="submit_reset_button">
					<button class="Business_popup_saveAddon"><?php _e('SAVE','business-popup') ?></button>
					<button class="Business_popup_resetAddon"><?php _e('RESET','business-popup') ?></button>
			</div>
	</section>

	<div class="business-popup-option business-popup-tab-container ">
		<?php include_once 'popup-shortcode-tab.php' ?>
    </div> 
</div>
