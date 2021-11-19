<?Php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// modal box js and css
wp_enqueue_style( 'mbp-component-css', MPB_PLUGIN_URL.'assets/css/component.css' );
wp_enqueue_script('mbp-modernizr-custom-js', MPB_PLUGIN_URL .'assets/js/modal/modernizr.custom.js', array('jquery'), '', false);	// before body load
wp_enqueue_script('mbp-classie-js', MPB_PLUGIN_URL .'assets/js/modal/classie.js', array('jquery'), '' , true);
wp_enqueue_script('mbp-modalEffects-js', MPB_PLUGIN_URL .'assets/js/modal/modalEffects.js', array('jquery'), '' , true);
wp_enqueue_script('mbp-cssParser-js', MPB_PLUGIN_URL .'assets/js/modal/cssParser.js', array('jquery'), '' , true);
			
//css
wp_enqueue_style('mbp-bootstrap-css', MPB_PLUGIN_URL . 'assets/css/backend-bootstrap.css');
wp_enqueue_style('mbp-animate-css', MPB_PLUGIN_URL.'assets/css/animate.css' );			
wp_enqueue_style('mbp-styles-css', MPB_PLUGIN_URL.'assets/css/styles.css' );			

//js
wp_enqueue_style('wp-color-picker' );
wp_enqueue_script('mbp-bootstrap-js', MPB_PLUGIN_URL .'assets/js/bootstrap.min.js', array('jquery'), '' , true);
wp_enqueue_script('mbp-color-picker-js', MPB_PLUGIN_URL .'assets/js/mb-color-picker.js', array( 'wp-color-picker' ), false, true );
wp_enqueue_style('mbp-toogle-button-css', MPB_PLUGIN_URL . 'assets/css/toogle-button.css');

//load settings
$modal_popup_box_settings = unserialize(base64_decode(get_post_meta( $post->ID, 'awl_mpb_settings_'.$post->ID, true)));
$modal_popup_box_id = $post->ID;
?>
<div class="row">
	<div class="col-lg-12 bhoechie-tab-container">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
			<div class="list-group">
				<a href="#" class="list-group-item active text-center">
					<span class="dashicons dashicons-archive"></span><br/><?php _e('Modal Popup Setting', MPB_TXTDM); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-admin-generic"></span><br/><?php _e('Config', MPB_TXTDM); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-editor-contract"></span><br/><?php _e('Content Settings', MPB_TXTDM); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-admin-tools"></span><br/><?php _e('Modal Footer Button Settings', MPB_TXTDM); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-admin-generic"></span><br/><?php _e('General Settings', MPB_TXTDM); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-cart"></span><br/><?php _e('Custom CSS', MPB_TXTDM); ?>
				</a>
			</div>
		</div>
	
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 bhoechie-tab">
			<div class="bhoechie-tab-content active">
				<h1><?php _e('Modal Form', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Show Modal Form', MPB_TXTDM); ?></h5>
							<p><?php _e('Display modal form on page load OR on button click', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">
							<?php if(isset($modal_popup_box_settings['mpb_show_modal'])) $mpb_show_modal = $modal_popup_box_settings['mpb_show_modal']; else $mpb_show_modal = "onclick"; ?>	
							<input type="radio" class="form-control" id="mpb_show_modal1" name="mpb_show_modal" value="onload" <?php if($mpb_show_modal == "onload") echo "checked=checked";?>>
							<label for="mpb_show_modal1"><?php _e('On Page Load ', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_show_modal2" name="mpb_show_modal" value="onclick" <?php if($mpb_show_modal == "onclick") echo "checked=checked";?>> 
							<label for="mpb_show_modal2"><?php _e('On Button Click', MPB_TXTDM); ?></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Button Text', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any text which will appear on button like Click Me', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_main_button_text'])) $mpb_main_button_text = $modal_popup_box_settings['mpb_main_button_text']; else $mpb_main_button_text = "Click Me"; ?>	
							<input type="text" class="selectbox_settings" id="mpb_main_button_text" name="mpb_main_button_text" value="<?php echo $mpb_main_button_text; ?>" placeholder="Type Button Text">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Button Size', MPB_TXTDM); ?></h5>
							<p><?php _e('You can set any button size', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_main_button_size'])) $mpb_main_button_size = $modal_popup_box_settings['mpb_main_button_size']; else $mpb_main_button_size = "btn btn-lg"; ?>	
							<select class="selectbox_settings" id="mpb_main_button_size" name="mpb_main_button_size"  >
								<option value="btn btn-xs"<?php if($mpb_main_button_size == "btn btn-xs") echo "selected=selected"; ?>>Small button</option>
								<option value="btn btn-sm"<?php if($mpb_main_button_size == "btn btn-sm") echo "selected=selected"; ?>>Medium button</option>
								<option value="btn btn-lg"<?php if($mpb_main_button_size == "btn btn-lg") echo "selected=selected"; ?>>Large button</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Button Color', MPB_TXTDM); ?></h5>
							<p><?php _e('You can set any button background color', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_main_button_color'])) $mpb_main_button_color = $modal_popup_box_settings['mpb_main_button_color']; else $mpb_main_button_color = "#008EC2"; ?>	
							<input type="text" class="form-control" id="mpb_main_button_color" name="mpb_main_button_color" value="<?php echo $mpb_main_button_color; ?>" default-color="<?php echo $mpb_main_button_color; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Button Text Color', MPB_TXTDM); ?></h5>
							<p><?php _e('You can set any button text color', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_main_button_text_color'])) $mpb_main_button_text_color = $modal_popup_box_settings['mpb_main_button_text_color']; else $mpb_main_button_text_color = "#ffffff"; ?>	
							<input type="text" class="form-control" id="mpb_main_button_text_color" name="mpb_main_button_text_color" value="<?php echo $mpb_main_button_text_color; ?>" default-color="<?php echo $mpb_main_button_text_color; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1><?php _e('Modal Heading / Title Settings', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal Title', MPB_TXTDM); ?></h5>
							<p><?php _e('You can hid or show tile of the modal box', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">
							<?php if(isset($modal_popup_box_settings['mpb_title'])) $mpb_title = $modal_popup_box_settings['mpb_title']; else $mpb_title = "show"; ?>	
							<input type="radio" class="form-control" id="mpb_title1" name="mpb_title" value="hide" <?php if($mpb_title == "hide") echo "checked=checked";?>>
							<label for="mpb_title1"><?php _e('Hide', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_title2" name="mpb_title" value="show" <?php if($mpb_title == "show") echo "checked=checked";?>>
							<label for="mpb_title2"><?php _e('Show', MPB_TXTDM); ?></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Font Size', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any font size for modal form heading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_header_font_size'])) $mpb_header_font_size = $modal_popup_box_settings['mpb_header_font_size']; else $mpb_header_font_size = 24; ?>	
							<select class="selectbox_settings" id="mpb_header_font_size" name="mpb_header_font_size" value="<?php $mpb_header_font_size; ?>" >
								<option value="12"<?php if($mpb_header_font_size == 12) echo "selected=selected"; ?>>12px</option>
								<option value="14"<?php if($mpb_header_font_size == 14) echo "selected=selected"; ?>>14px</option>
								<option value="16"<?php if($mpb_header_font_size == 16) echo "selected=selected"; ?>>16px</option>
								<option value="18"<?php if($mpb_header_font_size == 18) echo "selected=selected"; ?>>18px</option>
								<option value="20"<?php if($mpb_header_font_size == 20) echo "selected=selected"; ?>>20px</option>
								<option value="22"<?php if($mpb_header_font_size == 22) echo "selected=selected"; ?>>22px</option>
								<option value="24"<?php if($mpb_header_font_size == 24) echo "selected=selected"; ?>>24px</option>
								<option value="26"<?php if($mpb_header_font_size == 26) echo "selected=selected"; ?>>26px</option>
								<option value="28"<?php if($mpb_header_font_size == 28) echo "selected=selected"; ?>>28px</option>
								<option value="30"<?php if($mpb_header_font_size == 30) echo "selected=selected"; ?>>30px</option>
								<option value="32"<?php if($mpb_header_font_size == 32) echo "selected=selected"; ?>>32px</option>
								<option value="34"<?php if($mpb_header_font_size == 34) echo "selected=selected"; ?>>34px</option>
								<option value="36"<?php if($mpb_header_font_size == 36) echo "selected=selected"; ?>>36px</option>
								<option value="38"<?php if($mpb_header_font_size == 38) echo "selected=selected"; ?>>38px</option>
								<option value="40"<?php if($mpb_header_font_size == 40) echo "selected=selected"; ?>>40px</option>
								<option value="42"<?php if($mpb_header_font_size == 42) echo "selected=selected"; ?>>42px</option>
								<option value="44"<?php if($mpb_header_font_size == 44) echo "selected=selected"; ?>>44px</option>
								<option value="46"<?php if($mpb_header_font_size == 46) echo "selected=selected"; ?>>46px</option>
								<option value="48"<?php if($mpb_header_font_size == 48) echo "selected=selected"; ?>>48px</option>
							</select>
						</div>
					</div>	
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Text Alignment', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any text alignment for modal form heading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">	
							<?php if(isset($modal_popup_box_settings['mpb_header_text_alignment'])) $mpb_header_text_alignment = $modal_popup_box_settings['mpb_header_text_alignment']; else $mpb_header_text_alignment = "text-center"; ?>	
							<input type="radio" class="form-control" id="mpb_header_text_alignment1" name="mpb_header_text_alignment" value="text-left" <?php if($mpb_header_text_alignment == "text-left") echo "checked=checked";?>>
							<label for="mpb_header_text_alignment1"><?php _e('Left', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_header_text_alignment2" name="mpb_header_text_alignment" value="text-center" <?php if($mpb_header_text_alignment == "text-center") echo "checked=checked";?>>
							<label for="mpb_header_text_alignment2"><?php _e('Center', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_header_text_alignment3" name="mpb_header_text_alignment" value="text-right" <?php if($mpb_header_text_alignment == "text-right") echo "checked=checked";?>>
							<label for="mpb_header_text_alignment3"><?php _e('Right', MPB_TXTDM); ?></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Font Color', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any font color for modal form heading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">	
							<?php if(isset($modal_popup_box_settings['mpb_header_font_color'])) $mpb_header_font_color = $modal_popup_box_settings['mpb_header_font_color']; else $mpb_header_font_color = "#ffffff"; ?>	
							<input type="text" class="form-control" id="mpb_header_font_color" name="mpb_header_font_color" value="<?php echo $mpb_header_font_color; ?>" default-color="<?php echo $mpb_header_font_color; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Background Color', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any background color for modal form heading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">	
							<?php if(isset($modal_popup_box_settings['mpb_header_bg_color'])) $mpb_header_bg_color = $modal_popup_box_settings['mpb_header_bg_color']; else $mpb_header_bg_color = "#000000"; ?>	
							<input type="text" class="form-control" id="mpb_header_bg_color" name="mpb_header_bg_color" value="<?php echo $mpb_header_bg_color; ?>" default-color="<?php echo $mpb_header_bg_color; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Loading Animation Effect', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any loading animation effect for modal form heading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">	
							<?php if(isset($modal_popup_box_settings['mpb_animation_effect_header'])) $mpb_animation_effect_header = $modal_popup_box_settings['mpb_animation_effect_header']; else $mpb_animation_effect_header = "bounce"; ?>	
							<select id="mpb_animation_effect_header" name="mpb_animation_effect_header" onchange="return RunEffect('psa_button_header', this.value);">
								<optgroup label="Select Animation Effect">
								<option value="0" <?php if($mpb_animation_effect_header == 0) echo "selected=selected"; ?>>None</option>
								<option value="bounce"<?php if($mpb_animation_effect_header == "bounce") echo "selected=selected"; ?>>bounce</option>
								<option value="flash"<?php if($mpb_animation_effect_header == "flash") echo "selected=selected"; ?>>flash</option>
								<option value="pulse"<?php if($mpb_animation_effect_header == "pulse") echo "selected=selected"; ?>>pulse</option>
								<option value="rubberBand"<?php if($mpb_animation_effect_header == "rubberBand") echo "selected=selected"; ?>>rubberBand</option>
								<option value="shake"<?php if($mpb_animation_effect_header == "shake") echo "selected=selected"; ?>>shake</option>
								<option value="swing"<?php if($mpb_animation_effect_header == "swing") echo "selected=selected"; ?>>swing</option>
								<option value="tada"<?php if($mpb_animation_effect_header == "tada") echo "selected=selected"; ?>>tada</option>
								<option value="wobble"<?php if($mpb_animation_effect_header == "wobble") echo "selected=selected"; ?>>wobble</option>
								<option value="jello"<?php if($mpb_animation_effect_header == "jello") echo "selected=selected"; ?>>jello</option>					
								<option value="flip"<?php if($mpb_animation_effect_header == "flip") echo "selected=selected"; ?>>flip</option>					
								</optgroup>
							</select>		
						</div>
					</div>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1><?php _e('Content Settings', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Font Color', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any font color for modal form content', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_content_font_color'])) $mpb_content_font_color = $modal_popup_box_settings['mpb_content_font_color']; else $mpb_content_font_color = "#ffffff"; ?>	
							<input type="text" class="form-control" id="mpb_content_font_color" name="mpb_content_font_color" value="<?php echo $mpb_content_font_color; ?>" default-color="<?php echo $mpb_content_font_color; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Background Color', MPB_TXTDM); ?></h5>
							<p><?php _e('Set any background color for modal form content', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_content_bg_color'])) $mpb_content_bg_color = $modal_popup_box_settings['mpb_content_bg_color']; else $mpb_content_bg_color = "#008EC2"; ?>	
							<input type="text" class="form-control" id="mpb_content_bg_color" name="mpb_content_bg_color" value="<?php echo $mpb_content_bg_color; ?>" default-color="<?php echo $mpb_content_bg_color; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1><?php _e('Modal Form Footer Button Settings', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Select Button', MPB_TXTDM); ?></h5>
							<p><?php _e('You can set hide and show footer buttons', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">
							<?php if(isset($modal_popup_box_settings['mpb_buttons'])) $mpb_buttons = $modal_popup_box_settings['mpb_buttons']; else $mpb_buttons = "both"; ?>	
							<input type="radio" class="form-control" id="mpb_buttons1" name="mpb_buttons" value="one" <?php if($mpb_buttons == "one") echo "checked=checked";?>>
							<label for="mpb_buttons1"><?php _e('Button 1', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons2" name="mpb_buttons" value="two" <?php if($mpb_buttons == "two") echo "checked=checked";?>>
							<label for="mpb_buttons2"><?php _e('Button 2 ', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons3" name="mpb_buttons" value="both" <?php if($mpb_buttons == "both") echo "checked=checked";?>>
							<label for="mpb_buttons3"><?php _e('Both', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons4" name="mpb_buttons" value="none" <?php if($mpb_buttons == "none") echo "checked=checked";?>>
							<label for="mpb_buttons4"><?php _e('None', MPB_TXTDM); ?></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal From Buttons Alignment', MPB_TXTDM); ?></h5>
							<p><?php _e('Set modal form footer button alignment', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">
							<?php if(isset($modal_popup_box_settings['mpb_buttons_alignment'])) $mpb_buttons_alignment = $modal_popup_box_settings['mpb_buttons_alignment']; else $mpb_buttons_alignment = "text-center"; ?>	
							<input type="radio" class="form-control" id="mpb_buttons_alignment1" name="mpb_buttons_alignment" value="text-left" <?php if($mpb_buttons_alignment == "text-left") echo "checked=checked";?>>
							<label for="mpb_buttons_alignment1"><?php _e('Left', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons_alignment2" name="mpb_buttons_alignment" value="text-center" <?php if($mpb_buttons_alignment == "text-center") echo "checked=checked";?>>
							<label for="mpb_buttons_alignment2"><?php _e('Center', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons_alignment3" name="mpb_buttons_alignment" value="text-right" <?php if($mpb_buttons_alignment == "text-right") echo "checked=checked";?>>
							<label for="mpb_buttons_alignment3"><?php _e('Right', MPB_TXTDM); ?></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal From Buttons Link Option', MPB_TXTDM); ?></h5>
							<p><?php _e('Set modal form link buttons option for opening link into new tab or same tab', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 switch-field em_size_field">
							<?php if(isset($modal_popup_box_settings['mpb_buttons_link_option'])) $mpb_buttons_link_option = $modal_popup_box_settings['mpb_buttons_link_option']; else $mpb_buttons_link_option = "_new"; ?>	
							<input type="radio" class="form-control" id="mpb_buttons_link_option1" name="mpb_buttons_link_option" value="_self" <?php if($mpb_buttons_link_option == "_self") echo "checked=checked";?>>
							<label for="mpb_buttons_link_option1"><?php _e('Open Link In Same Tab', MPB_TXTDM); ?></label>
							<input type="radio" class="form-control" id="mpb_buttons_link_option2" name="mpb_buttons_link_option" value="_new" <?php if($mpb_buttons_link_option == "_new") echo "checked=checked";?>>
							<label for="mpb_buttons_link_option2"><?php _e('Open Link In New Tab', MPB_TXTDM); ?></label>
						</div>
					</div>
				</div>
				<!-- Button 1 -->
				<div class="row">
					<div class="col-md-6" >
						<h3 style="text-align:center; background-color: #000; color: #fff">Button 1 Settings</h3>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Text', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button text for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button1_text'])) $mpb_button1_text = $modal_popup_box_settings['mpb_button1_text']; else $mpb_button1_text = "Close"; ?>	
								<input type="text" class="selectbox_settings" id="mpb_button1_text" name="mpb_button1_text" value="<?php echo $mpb_button1_text; ?>" placeholder="Type Button text">
							</div>
						</div>
						<div class="col-md-8">
							<div class="ma_field_discription">
								<h5><?php _e('Button Size', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button size for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button1_size'])) $mpb_button1_size = $modal_popup_box_settings['mpb_button1_size']; else $mpb_button1_size = "btn btn-default"; ?>	
								<select id="mpb_button1_size" name="mpb_button1_size"  >
									<option value="btn btn-xs"<?php if($mpb_button1_size == "btn btn-xs") echo "selected=selected"; ?>>Extra small button</option>
									<option value="btn btn-sm"<?php if($mpb_button1_size == "btn btn-sm") echo "selected=selected"; ?>>Small button</option>
									<option value="btn btn-default"<?php if($mpb_button1_size == "btn btn-default") echo "selected=selected"; ?>>Medium button</option>
									<option value="btn btn-lg"<?php if($mpb_button1_size == "btn btn-lg") echo "selected=selected"; ?>>Large button</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="ma_field_discription">
								<h5><?php _e('Button Effect', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any loading animation effect for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_animation_effect_btn_1'])) $mpb_animation_effect_btn_1 = $modal_popup_box_settings['mpb_animation_effect_btn_1']; else $mpb_animation_effect_btn_1 = "bounce"; ?>	
								<select id="mpb_animation_effect_btn_1" name="mpb_animation_effect_btn_1" onchange="return RunEffect('psa_button_1', this.value);">
									<optgroup label="Select Animation Effect">
									<option value="0" <?php if($mpb_animation_effect_btn_1 == 0) echo "selected=selected"; ?>>None</option>
									<option value="bounce"<?php if($mpb_animation_effect_btn_1 == "bounce") echo "selected=selected"; ?>>bounce</option>
									<option value="flash"<?php if($mpb_animation_effect_btn_1 == "flash") echo "selected=selected"; ?>>flash</option>
									<option value="pulse"<?php if($mpb_animation_effect_btn_1 == "pulse") echo "selected=selected"; ?>>pulse</option>
									<option value="rubberBand"<?php if($mpb_animation_effect_btn_1 == "rubberBand") echo "selected=selected"; ?>>rubberBand</option>
									<option value="shake"<?php if($mpb_animation_effect_btn_1 == "shake") echo "selected=selected"; ?>>shake</option>
									<option value="swing"<?php if($mpb_animation_effect_btn_1 == "swing") echo "selected=selected"; ?>>swing</option>
									<option value="tada"<?php if($mpb_animation_effect_btn_1 == "tada") echo "selected=selected"; ?>>tada</option>
									<option value="wobble"<?php if($mpb_animation_effect_btn_1 == "wobble") echo "selected=selected"; ?>>wobble</option>
									<option value="jello"<?php if($mpb_animation_effect_btn_1 == "jello") echo "selected=selected"; ?>>jello</option>					
									<option value="flip"<?php if($mpb_animation_effect_btn_1 == "flip") echo "selected=selected"; ?>>flip</option>					
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Color', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button color for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4" style="margin-bottom: 10px;">
								<?php if(isset($modal_popup_box_settings['mpb_button1_color'])) $mpb_button1_color = $modal_popup_box_settings['mpb_button1_color']; else $mpb_button1_color = "#0073AA"; ?>	
								<input type="text" class="form-control" id="mpb_button1_color" name="mpb_button1_color" value="<?php echo $mpb_button1_color; ?>" default-color="<?php echo $mpb_button1_color; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Text Color', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button text color for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4" style="margin-bottom: 10px;">
								<?php if(isset($modal_popup_box_settings['mpb_button1_text_color'])) $mpb_button1_text_color = $modal_popup_box_settings['mpb_button1_text_color']; else $mpb_button1_text_color = "#ffffff"; ?>	
								<input type="text" class="form-control" id="mpb_button1_text_color" name="mpb_button1_text_color" value="<?php echo $mpb_button1_text_color; ?>" default-color="<?php echo $mpb_button1_text_color; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button URL', MPB_TXTDM); ?></h5>
								<p><?php _e('Set link or URL for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button1_url'])) $mpb_button1_url = $modal_popup_box_settings['mpb_button1_url']; else $mpb_button1_url = ""; ?>	
								<input type="text" class="selectbox_settings" id="mpb_button1_url" name="mpb_button1_url" value="<?php echo $mpb_button1_url; ?>" placeholder="Paste a Link URL">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<h3 style="text-align:center; background-color: #000; color: #fff">Button 2 Settings</h3>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Text', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button text for modal form footer button 1', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button2_text'])) $mpb_button2_text = $modal_popup_box_settings['mpb_button2_text']; else $mpb_button2_text = "Link & URL"; ?>	
								<input type="text" class="selectbox_settings" id="mpb_button2_text" name="mpb_button2_text" value="<?php echo $mpb_button2_text; ?>" placeholder="Type Button Text">
							</div>
						</div>
						<div class="col-md-8">
							<div class="ma_field_discription">
								<h5><?php _e('Button Size', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button size for modal form footer button 2', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button2_size'])) $mpb_button2_size = $modal_popup_box_settings['mpb_button2_size']; else $mpb_button2_size = "btn btn-default"; ?>	
								<select id="mpb_button2_size" name="mpb_button2_size"  >		
									<option value="btn btn-xs"<?php if($mpb_button2_size == "btn btn-xs") echo "selected=selected"; ?>>Extra small button</option>
									<option value="btn btn-sm"<?php if($mpb_button2_size == "btn btn-sm") echo "selected=selected"; ?>>Small button</option>
									<option value="btn btn-default"<?php if($mpb_button2_size == "btn btn-default") echo "selected=selected"; ?>>Medium button</option>
									<option value="btn btn-lg"<?php if($mpb_button2_size == "btn btn-lg") echo "selected=selected"; ?>>Large button</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="ma_field_discription">
								<h5><?php _e('Button Effect', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button animation effect for modal form footer button 2', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_animation_effect_btn_2'])) $mpb_animation_effect_btn_2 = $modal_popup_box_settings['mpb_animation_effect_btn_2']; else $mpb_animation_effect_btn_2 = "bounce"; ?>	
								<select id="mpb_animation_effect_btn_2" name="mpb_animation_effect_btn_2" onchange="return RunEffect('psa_button_2', this.value);">
									<optgroup label="Select Animation Effect">
									<option value="0" <?php if($mpb_animation_effect_btn_2 == 0) echo "selected=selected"; ?>>None</option>
									<option value="bounce"<?php if($mpb_animation_effect_btn_2 == "bounce") echo "selected=selected"; ?>>bounce</option>
									<option value="flash"<?php if($mpb_animation_effect_btn_2 == "flash") echo "selected=selected"; ?>>flash</option>
									<option value="pulse"<?php if($mpb_animation_effect_btn_2 == "pulse") echo "selected=selected"; ?>>pulse</option>
									<option value="rubberBand"<?php if($mpb_animation_effect_btn_2 == "rubberBand") echo "selected=selected"; ?>>rubberBand</option>
									<option value="shake"<?php if($mpb_animation_effect_btn_2 == "shake") echo "selected=selected"; ?>>shake</option>
									<option value="swing"<?php if($mpb_animation_effect_btn_2 == "swing") echo "selected=selected"; ?>>swing</option>
									<option value="tada"<?php if($mpb_animation_effect_btn_2 == "tada") echo "selected=selected"; ?>>tada</option>
									<option value="wobble"<?php if($mpb_animation_effect_btn_2 == "wobble") echo "selected=selected"; ?>>wobble</option>
									<option value="jello"<?php if($mpb_animation_effect_btn_2 == "jello") echo "selected=selected"; ?>>jello</option>					
									<option value="flip"<?php if($mpb_animation_effect_btn_2 == "flip") echo "selected=selected"; ?>>flip</option>					
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Color', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button color for modal form footer button 2', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4" style="margin-bottom: 10px;">
								<?php if(isset($modal_popup_box_settings['mpb_button2_color'])) $mpb_button2_color = $modal_popup_box_settings['mpb_button2_color']; else $mpb_button2_color = "#0073AA"; ?>	
								<input type="text" class="form-control" id="mpb_button2_color" name="mpb_button2_color" value="<?php echo $mpb_button2_color; ?>" default-color="<?php echo $mpb_button2_color; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button Text Color', MPB_TXTDM); ?></h5>
								<p><?php _e('Set any button text color for modal form footer button 2', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4" style="margin-bottom: 10px;">
								<?php if(isset($modal_popup_box_settings['mpb_button2_text_color'])) $mpb_button2_text_color = $modal_popup_box_settings['mpb_button2_text_color']; else $mpb_button2_text_color = "#ffffff"; ?>	
								<input type="text" class="form-control" id="mpb_button2_text_color" name="mpb_button2_text_color" value="<?php echo $mpb_button2_text_color; ?>" default-color="<?php echo $mpb_button2_text_color; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field_discription">
								<h5><?php _e('Button URL', MPB_TXTDM); ?></h5>
								<p><?php _e('Set link or URL for modal form footer button 2', MPB_TXTDM); ?></p> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="ma_field p-4">
								<?php if(isset($modal_popup_box_settings['mpb_button2_url'])) $mpb_button2_url = $modal_popup_box_settings['mpb_button2_url']; else $mpb_button2_url = "http://awplife.com"; ?>	
								<input type="text" class="selectbox_settings" id="mpb_button2_url" name="mpb_button2_url" value="<?php echo $mpb_button2_url; ?>" placeholder="Paste a Link URL">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1><?php _e('General Settings', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Open Animation Effect', MPB_TXTDM); ?></h5>
							<p><?php _e('Set animation effect on modal form loading', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_animation_effect_open_btn'])) $mpb_animation_effect_open_btn = $modal_popup_box_settings['mpb_animation_effect_open_btn']; else $mpb_animation_effect_open_btn = "md-effect-4"; ?>	
							<select id="mpb_animation_effect_open_btn" name="mpb_animation_effect_open_btn">
								<optgroup label="Select Animation Effect">
									<option value="md-effect-1"<?php if($mpb_animation_effect_open_btn == "md-effect-1") echo "selected=selected"; ?>>Fade in &amp; Scale</option>
									<option value="md-effect-2"<?php if($mpb_animation_effect_open_btn == "md-effect-2") echo "selected=selected"; ?>>Slide in (right)</option>
									<option value="md-effect-3"<?php if($mpb_animation_effect_open_btn == "md-effect-3") echo "selected=selected"; ?>>Slide in (bottom)</option>
									<option value="md-effect-4"<?php if($mpb_animation_effect_open_btn == "md-effect-4") echo "selected=selected"; ?>>Newspaper</option>
									<option value="md-effect-5"<?php if($mpb_animation_effect_open_btn == "md-effect-5") echo "selected=selected"; ?>>Fall</option>
									<option value="md-effect-6"<?php if($mpb_animation_effect_open_btn == "md-effect-6") echo "selected=selected"; ?>>Side Fall</option>
									<option value="md-effect-7"<?php if($mpb_animation_effect_open_btn == "md-effect-7") echo "selected=selected"; ?>>Sticky Up</option>
									<option value="md-effect-8"<?php if($mpb_animation_effect_open_btn == "md-effect-8") echo "selected=selected"; ?>>3D Flip (horizontal)</option>
									<option value="md-effect-9"<?php if($mpb_animation_effect_open_btn == "md-effect-9") echo "selected=selected"; ?>>3D Flip (vertical)</option>	
									<option value="md-effect-10"<?php if($mpb_animation_effect_open_btn == "md-effect-10") echo "selected=selected"; ?>>3D Sign</option>
									<option value="md-effect-11"<?php if($mpb_animation_effect_open_btn == "md-effect-11") echo "selected=selected"; ?>>Super Scaled</option>
									<option value="md-effect-12"<?php if($mpb_animation_effect_open_btn == "md-effect-12") echo "selected=selected"; ?>>Just Me</option>
									<option value="md-effect-13"<?php if($mpb_animation_effect_open_btn == "md-effect-13") echo "selected=selected"; ?>>3D Slit</option>
									<option value="md-effect-14"<?php if($mpb_animation_effect_open_btn == "md-effect-14") echo "selected=selected"; ?>>3D Rotate Bottom</option>
									<option value="md-effect-15"<?php if($mpb_animation_effect_open_btn == "md-effect-15") echo "selected=selected"; ?>>3D Rotate In Left</option>
									<option value="md-effect-16"<?php if($mpb_animation_effect_open_btn == "md-effect-16") echo "selected=selected"; ?>>Blur</option>
									<option value="md-effect-17"<?php if($mpb_animation_effect_open_btn == "md-effect-17") echo "selected=selected"; ?>>Let me in</option>
									<option value="md-effect-18"<?php if($mpb_animation_effect_open_btn == "md-effect-18") echo "selected=selected"; ?>>Make way!</option>
									<option value="md-effect-19"<?php if($mpb_animation_effect_open_btn == "md-effect-19") echo "selected=selected"; ?>>Slip from top</option>					
								</optgroup>			
							</select>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal Box Animation Effect Time Duration', MPB_TXTDM); ?></h5>
							<p><?php _e('Set animation effect time duration of modal box', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 range-slider">
							<?php if(isset($modal_popup_box_settings['mpb_animation_time_duration'])) $mpb_animation_time_duration = $modal_popup_box_settings['mpb_animation_time_duration']; else $mpb_animation_time_duration = 3; ?>	
							<input id="mpb_animation_time_duration" name="mpb_animation_time_duration" class="range-slider__range" type="range" value="<?php echo $mpb_animation_time_duration; ?>" min="1" max="5" step="0.5" style="width: 300px !important; margin-left: 10px;" default-color="<?php echo $mpb_animation_time_duration; ?>">
							<span class="range-slider__value">0</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Overlay Color', MPB_TXTDM); ?></h5>
							<p><?php _e('Note: if you use multipal shotcode on same page or post then last shortcode overlay color setting will apply on all shortcodes.', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_overlay_color'])) $mpb_overlay_color = $modal_popup_box_settings['mpb_overlay_color']; else $mpb_overlay_color = "#dd3333"; ?>	
							<input type="text" class="form-control" id="mpb_overlay_color" name="mpb_overlay_color" value="<?php echo $mpb_overlay_color; ?>" default-color="<?php echo $mpb_overlay_color; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Overlay Opacity', MPB_TXTDM); ?></h5>
							<p><?php _e('Set opacity/transparancy for modal background overlay', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 range-slider">
							<?php if(isset($modal_popup_box_settings['mpb_overlay_opacity'])) $mpb_overlay_opacity = $modal_popup_box_settings['mpb_overlay_opacity']; else $mpb_overlay_opacity = 0.2; ?>	
							<input id="mpb_overlay_opacity" name="mpb_overlay_opacity" class="range-slider__range" type="range" value="<?php echo $mpb_overlay_opacity; ?>" min="0" max="1" step="0.1" style="width: 300px !important; margin-left: 10px;" default-color="<?php echo $mpb_overlay_opacity; ?>">
							<span class="range-slider__value">0</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal Box Width', MPB_TXTDM); ?></h5>
							<p><?php _e('Set width of modal box', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 range-slider">
							<?php if(isset($modal_popup_box_settings['mpb_width'])) $mpb_width = $modal_popup_box_settings['mpb_width']; else $mpb_width = 35; ?>	
							<input id="mpb_width" name="mpb_width" class="range-slider__range" type="range" value="<?php echo $mpb_width; ?>" min="15" max="100" step="5" style="width: 300px !important; margin-left: 10px;" default-color="<?php echo $mpb_width; ?>">
							<span class="range-slider__value">0</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Modal Box Height', MPB_TXTDM); ?></h5>
							<p><?php _e('Set height of modal box', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4 range-slider">
							<?php if(isset($modal_popup_box_settings['mpb_height'])) $mpb_height = $modal_popup_box_settings['mpb_height']; else $mpb_height = 350; ?>	
							<input id="mpb_height" name="mpb_height" class="range-slider__range" type="range" value="<?php echo $mpb_height; ?>" min="200" max="700" step="25" style="width: 300px !important; margin-left: 10px;" default-color="<?php echo $mpb_height; ?>">
							<span class="range-slider__value">0</span>
						</div>
					</div>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1><?php _e('Custom CSS', MPB_TXTDM); ?></h1>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="ma_field_discription">
							<h5><?php _e('Custom CSS', MPB_TXTDM); ?></h5>
							<p><?php _e('Apply own css on video gallery and dont use style tag', MPB_TXTDM); ?></p> 
						</div>
					</div>
					<div class="col-md-8">
						<div class="ma_field p-4">
							<?php if(isset($modal_popup_box_settings['mpb_custom_css'])) $mpb_custom_css = $modal_popup_box_settings['mpb_custom_css']; else $mpb_custom_css = ""; ?>
							<textarea name="mpb_custom_css" id="mpb_custom_css" style="width: 100%; height: 120px;" placeholder="Type direct CSS code here. Don't use <style>...</style> tag."><?php echo $mpb_custom_css; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<?php 
// syntax: wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' );
wp_nonce_field( 'mpb_save_settings', 'mpb_save_nonce' );
?>
<style>
.range-slider {
    width: 100% !important;
}
.selectbox_settings {
	width: 200px;
} 
#edit-slug-box {
	display: none;
}
.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
float: left;
}
</style>

<script>
	//color-picker
	(function( jQuery ) {
		jQuery(function() {
			// Add Color Picker to all inputs that have 'color-field' class
			//Main Button Color
			
			jQuery('#mpb_main_button_color').wpColorPicker();
			jQuery('#mpb_main_button_text_color').wpColorPicker();
			//Header
			jQuery('#mpb_header_font_color').wpColorPicker();
			jQuery('#mpb_header_bg_color').wpColorPicker();	
			
			//Content
			jQuery('#mpb_content_font_color').wpColorPicker();
			jQuery('#mpb_content_bg_color').wpColorPicker();				
			
			//button 1
			jQuery('#mpb_button1_color').wpColorPicker();
			jQuery('#mpb_button1_text_color').wpColorPicker();		
			//button 2
			jQuery('#mpb_button2_color').wpColorPicker();
			jQuery('#mpb_button2_text_color').wpColorPicker();			
			//Overlay Color
			jQuery('#mpb_overlay_color').wpColorPicker();
				

		});
	})( jQuery );
	
	jQuery(document).ajaxComplete(function() {
		jQuery('#mpb_main_button_color,#mpb_main_button_text_color,#mpb_header_font_color,#mpb_header_bg_color,#mpb_content_font_color,#mpb_content_bg_color,#mpb_button1_color,#mpb_button1_text_color,#mpb_button2_color,#mpb_button2_text_color,#mpb_overlay_color').wpColorPicker();
	});
	
	//animation effect
	function RunEffect(id, effectclass) {
		//alert(id + effectclass); 
		jQuery("#" + id).removeAttr('class');
		jQuery( "#" + id ).addClass( "animated " + effectclass );
	}	
	
	//range slider
	var rangeSlider = function(){
	  var slider = jQuery('.range-slider'),
		  range = jQuery('.range-slider__range'),
		  value = jQuery('.range-slider__value');
		
	  slider.each(function(){

		value.each(function(){
		  var value = jQuery(this).prev().attr('value');
		  jQuery(this).html(value);
		});

		range.on('input', function(){
		  jQuery(this).next(value).html(this.value);
		});
	  });
	};
	rangeSlider();	
	
	//dropdown toggle on change effect
	jQuery(document).ready(function() {
	//accordion icon
	jQuery(function() {
		function toggleSign(e) {
			jQuery(e.target)
			.prev('.panel-heading')
			.find('i')
			.toggleClass('fa fa-chevron-down fa fa-chevron-up');
		}
		jQuery('#accordion').on('hidden.bs.collapse', toggleSign);
		jQuery('#accordion').on('shown.bs.collapse', toggleSign);

		});
	});
	// tab
	jQuery("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
		e.preventDefault();
		jQuery(this).siblings('a.active').removeClass("active");
		jQuery(this).addClass("active");
		var index = jQuery(this).index();
		jQuery("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
		jQuery("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	});
</script>
