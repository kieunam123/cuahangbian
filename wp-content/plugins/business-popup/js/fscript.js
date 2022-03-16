(function(jQuery){
	Business_front = {
		init:function(){
			let forBlockElementor = window.location.search;
			var getFilterUrl = [];
			if (forBlockElementor) {
				forBlockElementor = forBlockElementor.replace("?",'');
				forBlockElementor = forBlockElementor.split('&');
				forBlockElementor.forEach(function(value){
						let valueSplited = value.split('=');
						if(valueSplited[0])  getFilterUrl.push(valueSplited[0]);
						if(valueSplited[0])  getFilterUrl.push(valueSplited[1]);
					});
			}
			if (!getFilterUrl.includes("elementor-preview")){
				Business_front._effect_one();
			}
			Business_front._commonScript();
			Business_front._bind();
		},
		_effect_one:function(){
			let getPopup = jQuery('.business-popup-open.popup.active')[0];			
			if (getPopup) {
				getPopup = jQuery(getPopup);
				getPopup.hide();
				 let getHTml 		 = getPopup.html();
				 let getOutSideColor = getPopup.find('.business-popup-overlay').data('outside-color');
				 let getEffect       = getPopup.find('.business-popup-overlay').data('effect');
				 let effectClass = 'business-effect-one';
				 switch (getEffect){
			 		case 2:
			 		effectClass = 'business-effect-two';
			 			break;
			 		case 3:
			 		effectClass = 'business-effect-3';
			 			break;
			 		case 4:
			 		effectClass = 'business-effect-two';
				 }
				 let renderTohtml = '<div id="businessPopupShow" class="business-popup-main-wrap '+effectClass+'"><div>';
				 renderTohtml += getHTml;
				 renderTohtml += '</div></div>';
				 var addActivePopup = ()=>{
				 	jQuery('body').append(renderTohtml);
				 	jQuery('#businessPopupShow').css('background-color',getOutSideColor);
				 	jQuery('#businessPopupShow').addClass('business_popup_active');
				 	jQuery('body').addClass('businessPopupActive');
					getPopup.removeClass('active');
				 }
				 setTimeout(addActivePopup,4000);
			}
		},
		_commonScript:function(){
				// close by out side function
				jQuery(document).mouseup(function(e){
				var businessPopupDemo = jQuery('#businessPopupShow .business-popup-wrapper');
				let getCloseParam 	  = businessPopupDemo.find('.business-popup-close').data('close');
				if (getCloseParam == 'io' || getCloseParam == 'o') {
					 if (!businessPopupDemo.is(e.target) && businessPopupDemo.has(e.target).length === 0){
						jQuery('#businessPopupShow.business_popup_active').removeClass('business_popup_active');
						jQuery('#businessPopupShow').addClass('business_popup_shut');
				 		jQuery('body').removeClass('businessPopupActive');
				 		var remove_modal = function(){
				 			jQuery('#businessPopupShow').remove();
				 			if (jQuery('.business-popup-open.active').length) {
								Business_front._effect_one();
				 			}
				 		}
				 		setTimeout(remove_modal,500);
	                 }
				}
			});
			//remove popup close button inline and widget popup 
			jQuery('.business-popup-open.inline_').find('.business-popup-close').remove();
		},
		_closeFunctionByIcon:function(e){
			e.preventDefault();
				let button = jQuery(this);
				let getCloseParam 	  = button.data('close');
				if (getCloseParam == 'io' || getCloseParam == 'i' || !getCloseParam) {
					button.closest('#businessPopupShow.business_popup_active').removeClass('business_popup_active');
					jQuery('#businessPopupShow').addClass('business_popup_shut');
				 	jQuery('body').removeClass('businessPopupActive');
				 	var remove_modal = function(){
				 			jQuery('#businessPopupShow').remove();
				 			if (jQuery('.business-popup-open.active').length) {
								Business_front._effect_one();
				 			}
				 		}
				 		setTimeout(remove_modal,500);
				}
		},
		_bind:function(){
			jQuery(document).on('click', '.business-popup-close', Business_front._closeFunctionByIcon);
		}
	}
	Business_front.init();
})(jQuery);