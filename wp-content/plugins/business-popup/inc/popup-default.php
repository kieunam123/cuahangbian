<?php 

if ( ! defined( 'ABSPATH' ) ) exit; 
 // get all addons from database
        if (class_exists('Business_Popup_Db')) {
            $businessAddons = Business_Popup_Db::Popup_show_all();
            $addonName = array();
            if (!empty($businessAddons)) {
                foreach ($businessAddons as $addon_value) {
                   $addonName['popup'.$addon_value->BID] = ['BID'=>$addon_value->BID,
                                                            'setting'=>$addon_value->setting,
                                                            'option'=>$addon_value->boption,
                                                            'is_active'=>$addon_value->is_active
                                                          ];
                }
            }
          }
  // all addons default and database html

function business_popup_default_popup($addonName){
            $business_popup = business_popup_default_html();
            foreach ($business_popup as $popup_key => $popup_value) {
                    if (!isset($addonName[$popup_key]['BID'])) {
                            $addonName  =  array_merge($addonName,[$popup_key =>['setting'=>$popup_value]]);
                        }else if (isset($addonName[$popup_key]['BID']) && $addonName[$popup_key]['setting'] == '') {
                           $newMergeArray[$popup_key] = array( 'BID'     =>$addonName[$popup_key]['BID'],
                                                               'setting'    =>$popup_value,
                                                               'option'     => $addonName[$popup_key]['option'],
                                                               'is_active'  => $addonName[$popup_key]['is_active'],
                                                            );
                            unset($addonName[$popup_key]);
                            $addonName  =  array_merge($addonName,$newMergeArray);
                        }
            }
    return $addonName;
}
$addonName = business_popup_default_popup($addonName);


function business_popup_default_html($default=''){
    $return['popup1'] = '<div class="business-popup-wrapper business-popup-wrap-1">
                    <div class="popup-1-img popup-overlay-img" style="background-image: url('.esc_url(BUSINESS_POPUP_URL."img/popup1.png").')"></div>
                    <div class="business-popup-overlay business__edit_overlay-background" data-outside-color="#000000bd" data-effect="1" style="background-color:#ad76113d;"></div>
                    <div class="business-popup-content">
                        <div class="business-editor-attach" data-attach-for="close-button"></div>
                        <a href="#" data-close="io" class="business-popup-close business__edit_close_by business__edit_close_bcolor business__edit_close_color dashicons dashicons-no" style="color:#eb0000;"></a>
                        <div class="business-popup-row business-popup_clear">
                            <div class="business-popup-column-two">
                            <div class="business-editor-attach" data-attach-for="overlay"></div>                    
                                <div><span>'.__("&nbsp","business-popup").'</span></div>
                            </div>
                            <div class="business-popup-column-two">
                                <div class="business-popup-one-content">
                                    <span class="business-popup-text-1 contenteditable">'.__("Black Friday Sale!","business-popup").'</span>
                                    <span class="business-popup-text-2 contenteditable">'.__('TAKE AN ADDITIONAL','business-popup').'</span>
                                    <span class="business-popup-text-3 contenteditable">'.__("15% OFF","business-popup").'</span>
                                    <span class="business-popup-text-4 contenteditable">'.__("ON ALL PRODUCTS","business-popup").'</span>
                                    <div class="business-editor-attach" data-attach-for="popup-link-one"></div>
                                    <a class="business-popup-one-link business__edit_link-one" style="background-color:#1fb5a3;color:#ffffff;" href="#">'.__("Buy Now","business-popup").'</a>
                                    <span class="business-popup-text-5 contenteditable">'.__("Hurry, offer ends soon!","business-popup").'</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    $return["popup2"] = '<div class="business-popup-wrapper business-popup-wrap-2">
                                    <div class="popup-2-img popup-overlay-img" style="background-image: url('.esc_url(BUSINESS_POPUP_URL."img/popup2.png").')"></div>
                                    <div class="business-popup-overlay business__edit_overlay-background" data-outside-color="#000000c9" data-effect="1" style="background-color:#1d248fcc;"></div>
                                    <div class="business-popup-content">
                                        <div class="business-editor-attach" data-attach-for="overlay"></div>
                                        <div class="business-editor-attach" data-attach-for="close-button"></div>
                                        <a href="#" data-close="io" class="business-popup-close business__edit_close_by business__edit_close_bcolor business__edit_close_color dashicons dashicons-no" style="color: #f54747;"></a>
                                        <div class="content_wrap">
                                            <div class="business-editor-attach" data-attach-for="popup-link-two"></div>
                                            <a class="business-popup-title business__edit_link-two" href="#" style="color:#f0f0f0;background-color:#d6c11e;">'.__("Promo Code DISCOUNT30","business-popup").'</a>

                                            <p class="business-popup-heading contenteditable">'.__("SUPER SUMMER SALE","business-popup").'</p>
                                            <p class="business-popup-heading-2 contenteditable">'.__("UPTo 50% OFF","business-popup").'</p>
                                            <p class="business-popup-title-2 contenteditable">'.__("All Premium Themes & Plugins.","business-popup").'</p>
                                            <div class="business-editor-attach" data-attach-for="popup-link-one"></div>
                                            <a class="business-popup-two-link business__edit_link-one" href="#" style="color:#ffffff;background-color:#11151f9c;">'.__("Shop Now","business-popup").'</a>
                                            <p class="business-popup-title-3 contenteditable">'.__("Limited Period Offer!","business-popup").'</p>
                                        </div>
                                    </div>
                                </div>';

    $return["popup3"] = '<div class="business-popup-wrapper business-popup-wrap-3">
                    <div class="business-editor-attach" data-attach-for="background-color"></div>
                    <div class="business-popup-background-two-column business__edit_background_two" style="background-color:#f0f0f0;">
                    <div class="business__edit_background_one" style="background-color:#05053b;"></div>
                  </div>
                  <div class="business-popup-overlay"  data-outside-color="#1a33a3d9" data-effect="1"></div>
                  <div class="business-popup-content">
                  <div class="business-editor-attach" data-attach-for="close-button"></div>
                  <a href="#" data-close="io" class="business-popup-close business__edit_close_by business__edit_close_bcolor business__edit_close_color dashicons dashicons-no" style="color: #122ae3c4;background-color: #ffffff00;"></a>
                    <div class="business-popup-row business-popup_clear">
                        <div class="business-popup-content-wrap">
                            <span class="text-1 contenteditable">'.__("Get Rs 500 off","business-popup").'</span>
                            <span class="text-2 contenteditable">'.__("Buy New Mobiles Online","business-popup").'</span>
                            
                        <div class="business-editor-attach" data-attach-for="popup-link-one"></div>
                            <a class="business-popup-three-link business__edit_link-one" href="#" style="background-color: #e0ac1b;color:#ffffff;">'.__("SHOP NOW","business-popup").'</a>
                            <span class="text-3 contenteditable">'.__("Delhi and Mumbai","business-popup").'</span>
                        </div>
                        <div class="business-popup-img">
                            <div class="business-editor-attach" data-attach-for="overlay"></div>
                            <img class="popup-3-img" src="'.esc_url(BUSINESS_POPUP_URL."img/popup3.png").'">
                        </div>
                    </div>
                  </div>
            </div>';
    $return["popup4"] = '<div class="business-popup-wrapper business-popup-wrap-4">
                  <div class="business-popup-overlay business__edit_overlay-background"  data-outside-color="#1a1919d9" data-effect="1" style="background-color: #ffffff;"></div>
                  <div class="business-popup-content">
                     <div class="business-editor-attach" data-attach-for="close-button"></div>
                    <a href="#" data-close="io" class="business-popup-close dashicons dashicons-no business__edit_close_by business__edit_close_bcolor business__edit_close_color" style="color: #10b531;background-color: #ffffff;"></a>
                    <div class="business-popup-row business-popup_clear">
                        <div class="business-popup-content-wrap">
                           <div class="business-editor-attach" data-attach-for="popup-heading"></div>
                            <span class="text-1 contenteditable business__edit_heading"  style="color:#12a30d;">'.__("Marketing Books","business-popup").'</span>
                            <span class="text-2 contenteditable business__edit_sub-heading" style="color: #6b6b6b;">'.__("Download this free eBook and learn:","business-popup").'</span>
                            <div class="contentbox-1 business__edit_wrap-back business__edit_wrap-clr" style="background-color:#1f1f1f;color:#dadada;">
                                    <div class="business-editor-attach" data-attach-for="popup-container"></div>
                                    <span class="__af contenteditable">'.__("1. How to add powerful call to action","business-popup").'</span>
                                    <span class="__af contenteditable">'.__("2. Secrets of industry experts","business-popup").'</span>
                                    <span class="__af contenteditable">'.__("3. How to add powerful call to action","business-popup").'</span>
                            </div> 
                            <div class="business-editor-attach" data-attach-for="popup-link-one"></div>
                            <a class="business_popup_link-4 business__edit_link-one" href="#" style="background-color:#5ad422;color:#ffffff;">'.__("Download Your Free","business-popup").'</a>
                        </div>
                        <div class="business-popup-img">
                            <div class="business-editor-attach" data-attach-for="overlay"></div>
                            <img class="popup-4-img" src="'.esc_url(BUSINESS_POPUP_URL."img/popup4.png").'">
                        </div>
                    </div>
                  </div>
            </div>';

            $return["popup5"] = '<div class="business-popup-wrapper business-popup-wrap-5">
                  <div class="business-editor-attach" data-attach-for="overlay"></div>
                  <div class="business-editor-attach" data-attach-for="popup-link-one"></div>
                  <div class="business-editor-attach" data-attach-for="close-button"></div>

                  <a href="#" class="business-popup-overlay business__edit_link-one business__edit_overlay-background"  data-outside-color="#1a1919d9" data-effect="1"></a>

                  <a href="#" data-close="io" class="business-popup-close business__edit_close_by business__edit_close_bcolor business__edit_close_color dashicons dashicons-no"></a>
                  <div class="business-popup-content">
                            <img class="popup-5-img" src="'.esc_url(BUSINESS_POPUP_URL."img/popup5.jpg").'">
                  </div>
            </div>';

            $return["popup6"] = '<div class="business-popup-wrapper business-popup-wrap-6">
                  <div class="popup-6-img popup-overlay-img" style="background-image: url('.esc_url(BUSINESS_POPUP_URL."img/popup6.png").')"></div>

                  <div class="business-popup-overlay business__edit_overlay-background"  data-outside-color="#b8b8b8" style="background-color:#24222180;" data-effect="1"></div>

                    <a href="#" data-close="io" class="business-popup-close business__edit_close_by business__edit_close_bcolor business__edit_close_color dashicons dashicons-no" style="color:#ffffff;"></a>
                  <div class="business-editor-attach" data-attach-for="close-button"></div>
                  <div class="business-editor-attach" data-attach-for="text-Colors"></div>
                  <div class="business-popup-content">
                    <span class="business-popup-ribbon business__edit_ribbon_color business__edit_ribbon_bcolor"><span class="contenteditable">'.__("Best Offer","business-popup").'</span></span>
                    <span class="business-popup-heading-text contenteditable">'.__("Business PoPuP Best Offer","business-popup").'</span>
                         <div class="business-popup-text-content business__edit_border-color" style="color: #ee5a36;"> 
                            <span class="business__edit_txt-1 contenteditable">'.__("40","business-popup").'</span>
                            <div>
                                <span class="business__edit_txt-2 contenteditable">'.__("%Off","business-popup").'</span>
                                <span class="business__edit_txt-3 contenteditable">'.__("BLACK FRIDAY","business-popup").'</span>
                            </div>
                         </div>
                    <a class="business-popup-link-6 business__edit_link-one" href="#"><img class="popup-7-img" src="'.esc_url(BUSINESS_POPUP_URL."img/popup6logo.png").'"><span class="contenteditable">'.__("Business Popup","business-popup").'<span></a>
                  </div>
                   <div class="business-editor-attach" data-attach-for="link-one"></div>
                   <div class="business-editor-attach" data-attach-for="overlay"></div>
            </div>';

            if (!$default) {
                return $return;
              }else{
                return isset($return[$default])?$return[$default]:false;
              }     
}


















