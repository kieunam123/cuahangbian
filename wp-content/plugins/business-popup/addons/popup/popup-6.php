<?php if ( ! defined( 'ABSPATH' ) ) exit;
	$popup_editor = new business_popup_editor();
	$close_button = array(
		'close_by'=> ['title'	=>__('Close Popup Setting','business-popup'),
					  'type'	=>'select',
					  'option'	=>['i'=>__('Click On Icon','business-popup'),'o'=>__('Click On Outside Of Popup','business-popup'),'io'=>__('Click On Icon And Outside','business-popup')],
					  'selected'=>'io',
					  'attr' 	=> 'data-select="close"'
					 ],
		'close_bcolor' => ['title'=>__("Close Icon Bg Color","business-popup"),'type'=>'background-color'], 
		'close_color'  => ['title'=>__("Close Icon Color",'business-popup'),'type'=>'color'],
		'rib_heading'=>['title'=>__("Ribbon Color","business-popup"),'type'=>'heading','divider'=>true],
		'ribbon_color'  => ['title'=>__("Ribbon Color","business-popup"),'type'=>'color'] ,
		'ribbon_bcolor'  => ['title'=>__("Ribbon Background Color","business-popup"),'type'=>'background-color'] 
	);
	$Overlay = array(
		'overlay-background' => ['title'=>__("Image Overlay Color","business-popup"),'type'=>'background-color','divider'=>true,'color-position'=>'top left'], 
		'outside-overlay' 	 => ['title'=>__("Popup Outside Bg Color","business-popup"),'type'=>'background-color','color-position'=>'top left']
	);
	$textColors = array(
		'border-color' 	 => ['title'=>__("Border Color","business-popup"),'type'=>'color','divider'=>true], 
		'txt-1' 	 => ['title'=>__("Text One Color","business-popup"),'type'=>'color','divider'=>true], 
		'txt-2' 	 => ['title'=>__("Text Two Color","business-popup"),'type'=>'color','divider'=>true], 
		'txt-3' 	 => ['title'=>__("Text Three Color","business-popup"),'type'=>'color'], 
	);

echo "<div class='business-popupeditorpage-container'>";
	echo $popup_editor->editor(['id'=>'close-button','title'=>__('Close Button Editor','business-popup')],$close_button);
	echo $popup_editor->editor(['id'=>'overlay','title'=>__('Popup Setting','business-popup'),'image'=>['id'=>'popup-6']],$Overlay);
	echo $popup_editor->editor(['id'=>'text-Colors','title'=>__('Text And Border Color','business-popup')],$textColors);
	echo $popup_editor->editor(['id'=>'link-one','title'=>__('Business Popup Link','business-popup'),'image'=>['id'=>'popup-7','img'=>true]],['link-one'=> ['title'=>__('Text link','business-popup'),'type'=>'link','text'=>false,'background-color'=>false]]);	
echo '</div>';
?>


<div class="business-popup-save-html business__edit_outside-overlay" data-bid="6">
	<div class="business-popup-saved-message">
	    <div class="business-popup-saved-message-inner">
	        <p class="business-popup-saved-message-success"><span class="checked-icon dashicons dashicons-yes"></span><?php _e('Popup Saved','business-popup') ?></p>
	    </div>
	 </div>
	<?php echo $addonName['popup6']['setting'];  ?>
</div>