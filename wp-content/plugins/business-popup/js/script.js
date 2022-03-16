(function(jQuery){
var Business_popup = {
	init:function(){
		Business_popup._bind();
		Business_popup._businessPopupCustom();
	},
	_saveBusinessAddon:function(){
			let getHtml 	 = jQuery('.business-popup-save-html');
	        let htmlBusiness = getHtml.html();
	       	let popup_id 	 = getHtml.data('bid');
	        let cloneHtml 	 = jQuery('.BusinessAddonClone');
	        cloneHtml.html(htmlBusiness);
	        // remove content during save data biz_animation	  
		       	cloneHtml.find('[contenteditable]').removeAttr('contenteditable');
		       	cloneHtml.find('.business-editor-attach').empty();
		       	cloneHtml.find('.__afContentEditableRemove,.business-popup-saved-message').remove();
		       	cloneHtml.find('.biz_animation').removeAttr('anim').removeClass('biz_animation');
	        // remove content during save data biz_animation	  
	       	let saveHtmlData = cloneHtml.html();
	    	let this_button = jQuery(this);
	    	this_button.addClass('business_disabled');
			jQuery.ajax({
				method:'post',
		        url: business_popup_ajax_backend.business_popup_ajax_url,
		        data:{action:'popup_update_html',htmldata:saveHtmlData,popup_id:popup_id},
		        success:function(response){
		        	if (response != '' && response) {
		        		jQuery('.business-popup-saved-message').fadeIn('slow');
		        		setTimeout(function(){
		        			this_button.removeClass('business_disabled');
		        			jQuery('.business-popup-saved-message').fadeOut('slow');
		        	},3000);
		        	}else{
		        		this_button.removeClass('business_disabled');
		        	}
		        },
	        error:function(xhr){
	        	console.log(xhr.responseText);
	        }
		});
	},
	_resetBusinessAddons:function(){
		let get_html = jQuery(".business-popup-save-html[data-bid]");
		let popup_id = get_html.data('bid');
		jQuery('.resetConfirmPopup').addClass('active');
		jQuery('.businessPopup.deny').unbind().click(function(e){
			e.preventDefault();
			jQuery('.resetConfirmPopup').addClass('deactive');
			setTimeout(()=>jQuery('.resetConfirmPopup').removeClass('active deactive'),500);
		});
		jQuery('.businessPopup.confirm').unbind().click(function(e){
			e.preventDefault();
			jQuery.ajax({
					method:'post',
			        url: business_popup_ajax_backend.business_popup_ajax_url,
			        data:{action:'popup_update_html',popup_id:popup_id,reset:true},
			        success:function(response){
			        	if (response != '' && response) {
								location.reload();
			        	}
			        },
		        error:function(xhr){
		        	console.log(xhr.responseText);
		        }
			});
		});
	},
	_savePopupActiveDeactive:function(){
	    	let this_button = jQuery(this);

	       	let popup_name_id = this_button.data('bidd');
	       	let popup_id_db  	= this_button.data('bid');
	    	let isActive 	= this_button.prop('checked') == true?1:0;
	       	let saveHtml 	= isActive == 1?jQuery('.business-popup-save-html[data-bid="'+popup_name_id+'"]').html():'';
	       	// for if html dont want update from active and deactive
	       	// let saveHtml 	= popup_id == '' && isActive == 1?jQuery('.business-popup-save-html[data-popup_name="'+popup_name+'"]').html():'';

	this_button.addClass('business_disabled');
	jQuery.ajax({
		method:'post',
        url: business_popup_ajax_backend.business_popup_ajax_url,
        data:{action:'popup_insert',htmldata:saveHtml,popup_id:popup_name_id,is_active:isActive},
        success:function(response){ 
        	if (response != '' && response) {
        			setTimeout(function(){this_button.removeClass('business_disabled')},1500);
        			let getClosestSetting = this_button.closest('.business-popup-demo-settings');
					let getShortCode = getClosestSetting.find('.business-popup-shortcut');
        		if (isActive == 0) {
        				getClosestSetting.find('.can_disable').addClass('business_disabled');
        		}else if (isActive == 1) {
        			getClosestSetting.find('.can_disable').removeClass('business_disabled');
    				if (popup_id_db == '') { 
    					this_button.attr('data-bid',response);    					
    				}
        		}
        	}
	      },
	    error:function(xhr){
	    	console.log(xhr.responseText);
	    }
	  });

	},
	_businessPopupOpen:function(e){
		e.preventDefault();
		if(jQuery('#businessPopupShow').length)jQuery('#businessPopupShow').remove();
		let this_button 	= jQuery(this);
		let popupBusiness 	= this_button.data('popup');
		let popupContainer  = jQuery('.business-popup-save-html[data-bid="'+popupBusiness+'"]');
		 let getHTml 		 = popupContainer.html();
		 let getOutSideColor = popupContainer.find('.business-popup-overlay').data('outside-color');
		 let getEffect       = popupContainer.find('.business-popup-overlay').data('effect');
		 let effectClass = 'business-effect-one';
		 switch (getEffect){
	 		case 2:
	 		effectClass = 'business-effect-two';
	 			break;
	 		case 3:
	 		effectClass = 'business-effect-3';
	 			break;
	 		case 4:
	 		effectClass = 'business-effect-two example44';
		 }
		 let renderTohtml = '<div id="businessPopupShow" class="business-popup-main-wrap '+effectClass+'"><div>';
		 renderTohtml += getHTml;
		 renderTohtml += '</div></div>';
		 var addPreActivePopup = ()=>{
		 	jQuery('body').append(renderTohtml);
		 	jQuery('#businessPopupShow').css('background-color',getOutSideColor);
		 }
		 setTimeout(addPreActivePopup,50);
		 var addActivePopup = ()=>{
		 	jQuery('#businessPopupShow').addClass('business_popup_active');
		 	jQuery('body').addClass('businessPopupActive');
		 }
		 setTimeout(addActivePopup,100);
	},
	_popupOpenEffect:function(e){
		let this_button 	= jQuery(this);
		let effectValue = this_button.val();
		// set value
		jQuery('.business-popup-save-html .business-popup-overlay[data-effect]').attr('data-effect',effectValue);
		// set value
		jQuery('.business-popup-wrapper').removeAttr('anim').removeClass('biz_animation');
		setTimeout(()=>{jQuery('.business-popup-wrapper').addClass('biz_animation').attr('anim',effectValue)},100);
		setTimeout(()=>{
			jQuery('.business-popup-wrapper.biz_animation').removeAttr('anim').removeClass('biz_animation')
		},1000);
	},
	_businessPopupClose:function(e){
		e.preventDefault();
		let this_button = jQuery(this);
		let get_container = this_button.closest('#businessPopupShow');
		get_container.removeClass('business_popup_active').addClass('business_popup_shut');
		setTimeout(()=>{jQuery('#businessPopupShow').remove()},500);
	},
	_businessPopupCustom:function(){
				jQuery(document).mouseup(function(e){
					if (jQuery('#businessPopupShow').length) {
						var businessPopupDemo = jQuery('#businessPopupShow .business-popup-wrapper');
		                if (!businessPopupDemo.is(e.target) && businessPopupDemo.has(e.target).length === 0){
							jQuery('#businessPopupShow').removeClass('business_popup_active').addClass('business_popup_shut');
							setTimeout(()=>{jQuery('#businessPopupShow').remove()},500);
		                 }
					}
					// setTimeout(()=>{jQuery('#businessPopupShow').remove()},500);
			    });

		// checked radio box effect		    
		var getEffect = jQuery('.business-popup-demo .business-popup-overlay[data-effect]').attr('data-effect');
		jQuery('.business-popup-effect-option input[name="effect"][value="'+getEffect+'"]').prop('checked',true);
	},
	_businessTabSetting:function(e){
				e.preventDefault();
				let tabActive = 'active';
				let currentLink = jQuery(this);
				currentLink.siblings().removeClass(tabActive);
				currentLink.addClass(tabActive);
				// for tab change
				let getTabActive = currentLink.data('tab');
				jQuery('.business-popup-tab-container').removeClass(tabActive);
				if (getTabActive == 'setting') {
					jQuery('.business-popup-demo.business-popup-tab-container').addClass(tabActive);
				}else if(getTabActive == 'option'){
					jQuery('.business-popup-option.business-popup-tab-container').addClass(tabActive);
				}
	},
	_businessOptionUpdate:function(e){
		var thisCheckBox = jQuery(this);
		var bid = jQuery('.business-popup-save-html').data('bid');
		var option_key = thisCheckBox.data('name');
		var option_value = 0;
		if (thisCheckBox.prop('checked') == true) {
			option_value = 1;
		}
		// disable all on enable all pages and post
		var checkBoxDisable = thisCheckBox.closest('.business-popup-checkbox');
			checkBoxDisable.addClass('business_disabled');
		jQuery.ajax({
				method:'post',
		        url: business_popup_ajax_backend.business_popup_ajax_url,
		        data:{action:'popup_update',popup_id:bid,option_key:option_key,option_value:option_value},
		        success:function(response){
		        	if (response) {
		        		jQuery('.business-popup-optSaved-msg').fadeIn('slow');
		        		if (response == 22){
		        			var optMsg;
		        			if(option_key == 'home_page'){
		        				optMsg = 'Home Page';
		        			}else if(option_key == 'pages'){
		        				optMsg = 'Pages';
		        			}else if(option_key == 'post'){
		        				optMsg = 'Post';
		        			}
		        			jQuery('.business-popup-optPopup-msg').fadeIn().children('.opt_name').html(optMsg+" Popup Is Already On.");
		        			jQuery('.optClose').unbind().click(function(){
		        				jQuery(this).closest('.business-popup-optPopup-msg').fadeOut();	
		        			});
		        		}
		        	}
		        	setTimeout(function(){
		        		checkBoxDisable.removeClass('business_disabled');
		        		jQuery('.business-popup-optSaved-msg').fadeOut(1000);
		        	},1000);
		        },
	        error:function(xhr){
	        	console.log(xhr.responseText);
	        }
		});

	},
	_bind(){
		jQuery(document).on('click', '.Business_popup_saveAddon', Business_popup._saveBusinessAddon);
		jQuery(document).on('click', '.Business_popup_resetAddon', Business_popup._resetBusinessAddons);
		jQuery(document).on('change','.business_popup_setting_active', Business_popup._savePopupActiveDeactive);
		jQuery(document).on('click', '.business-popup-view', Business_popup._businessPopupOpen);
		jQuery(document).on('click', '.business-popup-effect-option input[name="effect"]', Business_popup._popupOpenEffect);
		jQuery(document).on('click', '.business-popup-close', Business_popup._businessPopupClose);
		jQuery(document).on('click', '.business-popup-cmn-nav-item > a.business-popup-tab', Business_popup._businessTabSetting);

		jQuery(document).on('change', '.business-popup-option input[type="checkbox"]', Business_popup._businessOptionUpdate);
	}
}
Business_popup.init();

// business popup editor functionlity
var Business_popup_editor = {
	init:function(){
		Business_popup_editor._businessPopupImageUploader('.business_popup_mdeia_upload');
		Business_popup_editor._popupEditorInit();
		Business_popup_editor._bind();
	},
	_editOpenAll:function(){
			let openIconThis   = jQuery(this);
			let openIconParent = openIconThis.closest('.business_popup_all_editor');
			let allInput 	   = openIconParent.find('input, select');
			let allInputLoop_ = (input_index, index_value)=>{
				let currentInput = jQuery(index_value);
				// set default value input which is in outside
				let getInitElement = jQuery('.business-popup-demo .business__edit_'+currentInput.attr('name'));
				// for color initilization
				let getColorInit 	 = currentInput.data('b_color');
				let getBackColorInit = currentInput.data('background_color');
				if (getColorInit || getBackColorInit) {
					let getElemStyle = getInitElement.attr('style');
					let setDefaultClr = false;
					if (getElemStyle) {
						let saparateStyle = Business_popup_editor._inlineCssSeparate(getElemStyle);
						// set
						if ('background-color' in saparateStyle && getBackColorInit) {
							setDefaultClr = saparateStyle['background-color'];
						}else if ('color' in saparateStyle && getColorInit) {
							setDefaultClr = saparateStyle['color'];
						}
					}
					let initColor = currentInput.siblings('label');
					Business_popup_editor._colorPickr(initColor,setDefaultClr);
				}else if(currentInput.data('image-position')){
					let targetBackImg = currentInput.attr('name');
					let getElemStyle = jQuery('.business-popup-demo .popup-overlay-img.'+targetBackImg+'-img').attr('style');
					if (getElemStyle) {
						let saparateStyle = Business_popup_editor._inlineCssSeparate(getElemStyle);
					if ('background-position' in saparateStyle && currentInput.val() == saparateStyle['background-position']) {
							currentInput.prop('checked',true);
						}
					}
				}else if(currentInput.data('select') == 'overlay-background-size'){
					let targetBackImg = currentInput.attr('name');
					let getElemStyle = jQuery('.business-popup-demo .popup-overlay-img.'+targetBackImg+'-img').attr('style');
					if (getElemStyle) {
						let saparateStyle = Business_popup_editor._inlineCssSeparate(getElemStyle);
					if ('background-size' in saparateStyle) {
							currentInput.val(saparateStyle['background-size']);
						}
					}
				}
				//text,href,target blank or not
				if (currentInput.data('text') && getInitElement.html()){
					currentInput.val(getInitElement.html().trim());
				}else if (currentInput.data('href') && getInitElement.attr('href')){
					currentInput.val(getInitElement.attr('href').trim());
				}else if (currentInput.data('target') && currentInput.val() == 1 && getInitElement.attr('target')=='_blank'){
					currentInput.prop('checked',true);
				}else if(currentInput.data('target') && currentInput.val() == 0){
					currentInput.prop('checked',true);
				}else if(currentInput.data('select')){
					if (currentInput.data('select') == 'close' && getInitElement.data('close')) {
						currentInput.val(getInitElement.data('close'));
					var getTTColor = currentInput.closest('.business_popup_editor_content').find('.business-popup-color-editor');
						if (getInitElement.data('close') == 'i' || getInitElement.data('close') == 'io') {
							jQuery(getTTColor[0]).slideDown('fast');
							jQuery(getTTColor[1]).slideDown('fast');
						} else {
							jQuery(getTTColor[0]).slideUp('fast');
							jQuery(getTTColor[1]).slideUp('fast');
						}

					}else if (currentInput.data('select') == 'effect') {
						let getEffect = jQuery('.business-popup-overlay[data-effect]').data('effect');
						currentInput.val(getEffect);
					}
				}
			}
			jQuery.each(allInput, allInputLoop_);
			// restoring and open edit box
			var currentOpenToggle = openIconParent.find('.business_popup_all_editor_wrap');
			jQuery('.business_popup_all_editor').not(openIconParent).removeClass('editor_active');
			jQuery('.business_popup_all_editor .business_popup_all_editor_wrap').not(currentOpenToggle).slideUp('fast');
			currentOpenToggle.slideToggle('fast');
			openIconParent.toggleClass('editor_active');
	},
	_editSetAll:function(){
			let element 	  	 = jQuery(this);
			let element_value 	 = element.val();
			let input_name 		 = element.attr('name');
			let target_element_perform = jQuery('.business-popup-demo .business__edit_'+input_name);
			// for color and background color
			if (element.data('background_color')) {
				Business_popup_editor._setStyleColor(target_element_perform,element_value,'background-color');
				if (input_name == 'outside-overlay')jQuery('.business-popup-demo .business-popup-overlay[data-outside-color]').attr('data-outside-color',element_value);
			}else if (element.data('b_color')) {
					Business_popup_editor._setStyleColor(target_element_perform,element_value,'color');
			}else if(element.data('text')){
				target_element_perform.html(element_value);
			}else if(element.data('href')){
				target_element_perform.attr('href',element_value);
			}else if(element.data('target')){
				if (element_value==1) {
					target_element_perform.attr('target','_blank');
				}else{
					target_element_perform.removeAttr('target');
				}
			}else if(element.data('select')){
				if (element.data('select') == 'close') {
					target_element_perform.attr('data-close',element_value);
				var getTTColor = element.closest('.business_popup_editor_content').find('.business-popup-color-editor');
					if (element_value == 'i' || element_value == 'io') {
						jQuery(getTTColor[0]).slideDown('fast');
						jQuery(getTTColor[1]).slideDown('fast');
						target_element_perform.css('display','block');
					} else {
						jQuery(getTTColor[0]).slideUp('fast');
						jQuery(getTTColor[1]).slideUp('fast');
						target_element_perform.css('display','none');
					}
				}else if (element.data('select') == 'effect') {
					jQuery('.business-popup-demo .business-popup-overlay[data-effect]').attr('data-effect',element_value);
				}else if (element.data('select') == 'overlay-background-size') {
					jQuery('.business-popup-demo .popup-overlay-img.'+input_name+'-img').css('background-size',element_value);
				}
			}else if(element.data('image-position') == 1){
					jQuery('.business-popup-demo .popup-overlay-img.'+input_name+'-img').css('background-position',element_value);
			}
	},
	_contetntEditAdd:function(e){
			if (e.keyCode == 13) {
				e.preventDefault();
				let currentElement = jQuery(this);
				let currentElhtml = currentElement[0].outerHTML;
				currentElement.after(currentElhtml);
				let currentEleNxt = jQuery(currentElement.next());
				let htmlRemoBtn = '<div class="__afContentEditableRemove"><span class="dashicons dashicons-minus"></span></div>';	
				currentEleNxt.focus().html('write something').before(htmlRemoBtn);
			}
	},
	_popupEditorInit:function(){
		// all content editable add attr contenteditable
		let contetntEditable = jQuery('.business-popup-demo .contenteditable');
		if (contetntEditable.length){
			contetntEditable.attr('contenteditable','true');
		}
		// contetnt editable remove init
		let getEditableRm = jQuery('.business-popup-demo .__af.contenteditable');
		if (getEditableRm.length) {
			let htmlRemoBtn = '<div class="__afContentEditableRemove"><span class="dashicons dashicons-minus"></span></div>';	
			getEditableRm.before(htmlRemoBtn);
		}
		// popup background color set
		let getOutBAckgroundColor = jQuery('.business-popup-demo .business-popup-overlay').data('outside-color');
		if (getOutBAckgroundColor) {
			jQuery('.business-popup-demo .business-popup-save-html').css('background-color',getOutBAckgroundColor);
		}
		// new all editor 
			//common editor init 
		let hasAllEditor = jQuery('div.business_popup_all_editor[data-editorfor]');
		// console.log(hasAllEditor);
		if (hasAllEditor.length) {
			jQuery.each(hasAllEditor, function(index, value){
				let getElementInitFor = jQuery(value).data('editorfor');
				let getWherePut 	  = jQuery('.business-popup-demo .business-editor-attach[data-attach-for="'+getElementInitFor+'"]');
				let whatNeedPut 	  = jQuery('div.business_popup_all_editor[data-editorfor="'+getElementInitFor+'"]');
				whatNeedPut.detach().appendTo(getWherePut);
			});
		}
		// all anchor clickable make false in demo section
		jQuery('.business-popup-wrapper a').click(function(e){
			e.preventDefault();
		});
		Business_popup_editor._closeTabOutAndCloseBtn('.btnClose_cmn','.business_popup_all_editor_wrap','editor_active','.business_popup_all_editor_open');
	},
	_removeContentEditable:function(e){
				var this_af = jQuery(this);
				var getContetntNxt = this_af.next('.__af.contenteditable');
				getContetntNxt.fadeOut('slow',_remove);
				
				function _remove(){
					getContetntNxt.remove();
					this_af.remove();	
				}
	},
	_bind:function(){
		jQuery(document).on('click', '.business_popup_all_editor_open',Business_popup_editor._editOpenAll);
		jQuery(document).on('keyup change', '.business_popup_all_editor input,.business_popup_all_editor select',Business_popup_editor._editSetAll);
		jQuery(document).on('keypress', '.business-popup-demo .__af[contenteditable]',Business_popup_editor._contetntEditAdd);
		jQuery(document).on('click', '.business-popup-demo .__afContentEditableRemove',Business_popup_editor._removeContentEditable)
	},
	_colorPickr:function(select_element,defaultClr){
		defaultClr = defaultClr?defaultClr:'#ffffff';
		Business_popup_editor._setStyleColor(select_element,defaultClr,'background-color');
		const inputElement = select_element[0];
		const pickr = new Pickr({
		  el:inputElement,
		  useAsButton: true,
		  default: defaultClr,
		  theme: 'nano',
		  swatches: ['#f44336','#e91e63f2','#9c27b0e6','#673ab7d9','#3f51b5cc','#2196f3bf','#ffc107'],
		  components: {preview: true,opacity: true,hue: true,
		    interaction: {
		      input: true,
		    }
		  }
		}).on('change',(color,instance)=>{
		  let color_ = color.toHEXA().toString(0);
		  Business_popup_editor._setStyleColor(select_element,color_,'background-color');
		  select_element.siblings('input').val(color_);
		  select_element.siblings('input').change();
		});
	},
	_inlineCssSeparate:function(inline_css){
				let saparateStyle = [];
				inline_css.split(';').forEach((value_, index_)=>{
					if(value_.search(':') > -1){
				      let getCss = value_.split(':');
				     	saparateStyle[getCss[0].trim()] = getCss[1].trim();  
				    }
				});
				return saparateStyle;
	},
	_setStyleColor:function(target_element_perform,element_value,styleProperty){
				let getElemStyle =  target_element_perform.attr('style');
				if (getElemStyle) {
						let saparateStyle = Business_popup_editor._inlineCssSeparate(getElemStyle);
						if (styleProperty in saparateStyle) delete saparateStyle[styleProperty];
						saparateStyle[styleProperty] = element_value;
						let newStyle = '';
						for (let key in saparateStyle) {newStyle += key+':'+saparateStyle[key]+";";}
						target_element_perform.attr('style',newStyle);
				}else{
						target_element_perform.attr('style',styleProperty+':'+element_value);
				}
	},
	_closeTabOutAndCloseBtn:function(close_button,close_item,rmClass,opener){
		jQuery(document).on('click', close_button,function(e){
			jQuery(close_item).slideUp('fast');
			jQuery(close_item).closest('.'+rmClass).removeClass(rmClass);
		});
		// editor click outside of div popup will desappear
		opener = jQuery(opener); 
		// console.log(opener);
		if (close_item.length) {				
			let close_target = jQuery(close_item);
			jQuery(document).mouseup(function(e){
				let container_ = !close_target.is(e.target) && close_target.has(e.target).length === 0?true:false;
				let buttone_opener_ = !opener.is(e.target) && opener.has(e.target).length === 0?true:false;

				// if click target not on color pickr then close
				let checkColoPckr = jQuery('.pcr-app.visible');
					checkColoPckr = !checkColoPckr.is(e.target) && checkColoPckr.has(e.target).length === 0?true:false;

				// both container_ and buttone_opener_ should be true 
				//if click on open item this function will not work because buttone_opener_ will false
                // if (container_ && buttone_opener_ && activeParent){
                if (container_ && buttone_opener_ && jQuery(close_item).closest('.'+rmClass).length && checkColoPckr){
					jQuery(close_item).slideUp('fast');
					jQuery(close_item).closest('.'+rmClass).removeClass(rmClass);
                 }
		    });
		}
	},
	_businessPopupImageUploader:function(buttonUpload){
		jQuery(document).on('click', buttonUpload, function(e){
					e.preventDefault();
		    		var this_button = jQuery(this);
		    		custom_uploader = wp.media({
					title: 'Business Popup Image Uploader',
					library : {
						type : 'image'
					},
					button: {
						text: 'Choose This Image'
					},
					multiple: false 
				}).on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					// change background image on select 
					var changeImageUrl 	 = attachment.url;
					var changeImageClass = this_button.attr('id');
					var getImageOrBackgroundImg = this_button.data('image');
					// change
					if (this_button.data('image')) {
						jQuery('.business-popup-demo .'+changeImageClass).attr('src',changeImageUrl);
					}else{
						jQuery('.business-popup-demo .'+changeImageClass).css({'background-image':'url('+changeImageUrl+')'});
					}

				}).open();
			});
	}
}
	Business_popup_editor.init();

})(jQuery);
