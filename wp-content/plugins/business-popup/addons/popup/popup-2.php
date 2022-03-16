<?php if ( ! defined( 'ABSPATH' ) ) exit;
	$popup_editor = new business_popup_editor();
	$close_button = array(
		'close_by'=> ['title'=>__('Close Popup Option','business-popup'),
					  'type'=>'select',
					  'option'=>['i'=>__('Click On Icon','business-popup'),'o'=>__('Click On Outside Of Popup','business-popup'),'io'=>__('Click On Icon And Outside','business-popup')],
					  'selected'=>'io',
					  'attr' => 'data-select="close"'
					 ],
		'close_bcolor' => ['title'=>__("Close Icon Bg Color","business-popup"),'type'=>'background-color','divider'=>true], 
		'close_color' => ['title'=>__("Close Icon Color","business-popup"),'type'=>'color'], 

	);
	$Overlay = array(
		'overlay-background' => ['title'=>__("Image Overlay Color","business-popup"),'type'=>'background-color','divider'=>true,'color-position'=>'top left'], 
		'outside-overlay' => ['title'=>__("Popup Outside Bg Color","business-popup"),'type'=>'background-color','color-position'=>'top left']
	);
echo "<div class='business-popupeditorpage-container'>";
	echo $popup_editor->editor(['id'=>'popup-link-one','title'=>__('Link Button Editor','business-popup')],['link-one'=>['title'=>__('link','business-popup'),'type'=>'link']]);
	echo $popup_editor->editor(['id'=>'popup-link-two','title'=>__('Link Button Editor','business-popup')],['link-two'=>['title'=>__('link','business-popup'),'type'=>'link']]);
	echo $popup_editor->editor(['id'=>'close-button','title'=>__('Close Button Editor','business-popup')],$close_button);
	echo $popup_editor->editor(['id'=>'overlay','title'=>__('Popup Setting','business-popup'),'image'=>['id'=>'popup-2']],$Overlay);
echo '</div>';

?>

<div class="business-popup-save-html business__edit_outside-overlay" data-bid="2">
	<div class="business-popup-saved-message">
	    <div class="business-popup-saved-message-inner">
	        <p class="business-popup-saved-message-success"><span class="checked-icon dashicons dashicons-yes"></span><?php _e('Popup Saved','business-popup') ?></p>
	    </div>
	 </div>
			<?php echo $addonName['popup2']['setting']; ?>
</div>

