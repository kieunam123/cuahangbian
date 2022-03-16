<?php if ( ! defined( 'ABSPATH' ) ) exit; 
class business_popup_editor{

	public function image_position($id){
		$html = '<div class="business-image-overlay-background-setting">';
		$html .= $this->drop_down($id,'Background Size',['auto'=>'Auto','cover'=>'Cover','contain'=>'Contain','initial'=>'Initial'],'cover','data-select=overlay-background-size');
		$html .= "<p>".__("Background Image Position",'business-popup')."</p>";
		$html .= '<div class="background-setting-radio-container">';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-1" type="radio" data-image-position="1" name="'.$id.'" value="left top">
					<label for="bz-i-p'.$id.'-1"><span class="dashicons dashicons-arrow-up-alt rotat-45"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-2" type="radio" data-image-position="1" name="'.$id.'" value="center top">
					<label for="bz-i-p'.$id.'-2"><span class="dashicons dashicons-arrow-up-alt"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-3" type="radio" data-image-position="1" name="'.$id.'" value="right top">
					<label for="bz-i-p'.$id.'-3"><span class="dashicons dashicons-arrow-up-alt rotat45"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-4" type="radio" data-image-position="1" name="'.$id.'" value="left center">
					<label for="bz-i-p'.$id.'-4"><span class="dashicons dashicons-arrow-left-alt"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-5" type="radio" data-image-position="1" name="'.$id.'" value="center center">
					<label for="bz-i-p'.$id.'-5"><span class="dashicons dashicons-move"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-6" type="radio" data-image-position="1" name="'.$id.'" value="right center">
					<label for="bz-i-p'.$id.'-6"><span class="dashicons dashicons-arrow-right-alt"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-7" type="radio" data-image-position="1" name="'.$id.'" value="left bottom">
					<label for="bz-i-p'.$id.'-7"><span class="dashicons dashicons-arrow-down-alt rotat45"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-8" type="radio" data-image-position="1" name="'.$id.'" value="center bottom">
					<label for="bz-i-p'.$id.'-8"><span class="dashicons dashicons-arrow-down-alt"></span></label>
				</div>';
		$html .= '<div class="bz-radio_">
					<input id="bz-i-p'.$id.'-9" type="radio" data-image-position="1" name="'.$id.'" value="right bottom">
					<label for="bz-i-p'.$id.'-9"><span class="dashicons dashicons-arrow-down-alt rotat-45"></span></label>
				</div>';
		$html .= '</div>';

		$html .= '</div>';
		return $html;
	}
	public function editor($editor,$input){
		$html = '<div class="business_popup_all_editor business_popup_all_editor-'.$editor["id"].'" data-editorfor="'.$editor["id"].'">';

			if (isset($editor['image'])) {
				$image = isset($editor['image']['img'])?true:false;
				$html .= $this->image_upload($editor['image']['id'],$image);
			}

			$html .=	'<span class="dashicons dashicons-edit btn_editor_open_cmn business_popup_all_editor_open"></span>';
			$html .= "<div class='editor_wrap_cmn business_popup_all_editor_wrap'>";//wrap and container
			//header
			$html .=	'<div class="business_editor_header"><div><p>'.__($editor["title"],"business-popup").'</p></div>';
			$html .=	'<div><p class="dashicons dashicons-no-alt btnClose_cmn"></p></div></div>';
			//header				
			//content
			$html .= '<div class="business_popup_editor_content">';
				if (isset($editor['image']) && !isset($editor['image']['img'])) {
					$html .= $this->image_position($editor['image']['id']);
				}
				foreach ($input as $input_key => $input_value) {
					if ($input_value['type'] == 'background-color') {

						if (isset($input_value['color-position'])) {
							$html .= $this->bcolor_editor($input_key,$input_value['title'],$input_value['color-position']);
						}else{
							$html .= $this->bcolor_editor($input_key,$input_value['title']);
						}

					}else if ($input_value['type'] == 'color') {
						if (isset($input_value['color-position'])) {
							$html .= $this->color_editor($input_key,$input_value['title'],$input_value['color-position']);
						}else{
							$html .= $this->color_editor($input_key,$input_value['title']);
						}
					}else if ($input_value['type'] == 'link') {

					$link_text 	= isset($input_value['text']) && !$input_value['text']?false:true;
					$link_color = isset($input_value['color']) && !$input_value['color']?false:true;
					$link_bcolor = isset($input_value['background-color']) && !$input_value['background-color']?false:true;
					$html .= $this->link_editor($input_key,$input_value['title'],$link_text,$link_color,$link_bcolor);

					}else if($input_value['type'] == 'select' && isset($input_value['option'])){
						$selected = isset($input_value['selected'])?$input_value['selected']:'';
						$attr_ = isset($input_value['attr'])?$input_value['attr']:'';
						$html .= $this->drop_down($input_key,$input_value['title'],$input_value['option'],$selected,$attr_);

					}else if ($input_value['type'] == 'heading') {
						$html .= "<div class='business_editor_heading business_editor_heading_".$input_key."'><p>".__($input_value['title'],'business-popup')."</p></div>"; 
					}
					$html .= isset($input_value['divider'])?'<div class="business-popup-editor-divider"></div>':'';
				}
			$html .= '</div>';
			//content
		$html .= '</div></div>';//wrap and container
		return $html;
	}
	public function image_upload($id,$image=false){
		$noBackground = $image?'data-image="1"':'';
		return '<div class="business-popup-image-upload-'.$id.'"><a id="'.$id.'-img" '.$noBackground.' class="dashicons dashicons-format-image business_popup_mdeia_upload"></a></div>';
	}
	public function drop_down($id,$title,$option,$selected,$attr){	
		$title = $title?$title:__('Close Popup Setting',"business-popup");
		$html = '<div class="business-dropdown business-dropdown-'.$id.'"><p>'.$title.'</p><div>';
			$html .= '<select '.$attr.' name="'.$id.'">';
			foreach ($option as $key => $value) {
				if ($selected === $key) {
					$html .= '<option selected="selected" value="'.$key.'">'.__($value,"business-popup").'</option>';
				} else {
					$html .= '<option value="'.$key.'">'.__($value,"business-popup").'</option>';
				}
			}
			$html .= '</select>';
		$html .= '</div></div>';
		return $html;
	}
	public function link_editor($id,$title='Link',$link_text,$link_color,$link_bcolor){
		$html =  $link_text?$this->text_editor($id):'';
		$html .= $this->text_editor($id,$title,'link');
		$html .= '<div class="business-popup-editor-divider"></div>';
		$html .= '<div class="radio">
					<div>
						<input data-target="1" type="radio" name="'.$id.'" value="1">
						<label>'.__("New Tab","business-popup").'</label>
					</div>
					<div>
						<input data-target="1" type="radio" name="'.$id.'" value="0">
						<label>'.__("Same tab","business-popup").'</label>
					</div>
				</div>';
		$html .= '<div class="business-popup-editor-divider"></div>';
		$html .= $link_bcolor?$this->bcolor_editor($id,'Background Color'):'';
		$html .= $link_bcolor?'<div class="business-popup-editor-divider"></div>':'';
		$html .= $link_color?$this->color_editor($id,'Text Color'):'';
		return $html;
	}
	public function color_editor($id,$title='Color',$position='bottom left'){
		$html = '<div class="business-popup-color-editor business-popup-color-editor-'.$id.'"><p>'.__($title,'business-popup').'</p>';
				$html .= '<div class="colorPickr_"><label></label><input type="text" data-b_color="1" name="'.$id.'" value="">';
				$html .= '</div></div>';
		return $html;
	}
	public function bcolor_editor($id,$title='Background Color',$position='bottom left'){
		$html = '<div class="business-popup-color-editor business-popup-color-editor-'.$id.'"><p>'.__($title,'business-popup').'</p>';
				$html .= '<div class="colorPickr_"><label></label><input type="text" data-background_color="1" name="'.$id.'" value="">';
				$html .= '</div></div>';
		return $html;
	}
	public function text_editor($id,$title='Text',$attr=''){
			$attr_p = $attr=='link'?'data-href="1"':'data-text="1"';
		return '<div class="business-popup-text-editor business-popup-text-'.$id.'">
					<label>'.__($title,'business-popup').'</label>
					<input type="text" '.$attr_p.' value="" name="'.$id.'">
				</div>';
	}

	

	// class end
}

?>

