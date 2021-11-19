<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_shortcode('MPBOX', 'awl_modal_popup_box_shortcode');
function awl_modal_popup_box_shortcode($post_id) {
	ob_start();
	//print_r($post_id);
	wp_enqueue_style('mbp-bootstrap-css', MPB_PLUGIN_URL . 'assets/css/modal-popup-bootstrap.css');
	wp_enqueue_style('mbp-animate-css', MPB_PLUGIN_URL.'assets/css/animate.css' );
	wp_enqueue_style('mbp-modal-box-css', MPB_PLUGIN_URL.'assets/css/modal-box.css' );
	// modal box js and css
	wp_enqueue_style( 'mbp-component-css', MPB_PLUGIN_URL.'assets/css/component-update.css' );
	wp_enqueue_script('mbp-classie-js', MPB_PLUGIN_URL .'assets/js/modal/classie.js', array('jquery'), '' , true);
	
	//unsterilized
	$modal_popup_box_settings = unserialize(base64_decode(get_post_meta( $post_id['id'], 'awl_mpb_settings_'.$post_id['id'], true)));
	$modal_popup_box_id = $post_id['id'];
	//print_r($modal_popup_box_settings);
	
	//Main Button
	if(isset($modal_popup_box_settings['mpb_show_modal'])) $mpb_show_modal = $modal_popup_box_settings['mpb_show_modal']; else $mpb_show_modal = "onclick";
	if(isset($modal_popup_box_settings['mpb_main_button_text'])) $mpb_main_button_text = $modal_popup_box_settings['mpb_main_button_text']; else $mpb_main_button_text = "Click Me";
	if(isset($modal_popup_box_settings['mpb_main_button_size'])) $mpb_main_button_size = $modal_popup_box_settings['mpb_main_button_size']; else $mpb_main_button_size = "btn btn-lg";
	if(isset($modal_popup_box_settings['mpb_main_button_color'])) $mpb_main_button_color = $modal_popup_box_settings['mpb_main_button_color']; else $mpb_main_button_color = "#008EC2";
	if(isset($modal_popup_box_settings['mpb_main_button_text_color'])) $mpb_main_button_text_color = $modal_popup_box_settings['mpb_main_button_text_color']; else $mpb_main_button_text_color = "#ffffff";

	//Header Settings
	if(isset($modal_popup_box_settings['mpb_title'])) $mpb_title = $modal_popup_box_settings['mpb_title']; else $mpb_title = "show";
	if(isset($modal_popup_box_settings['mpb_header_font_size'])) $mpb_header_font_size = $modal_popup_box_settings['mpb_header_font_size']; else $mpb_header_font_size = 24;
	if(isset($modal_popup_box_settings['mpb_header_text_alignment'])) $mpb_header_text_alignment = $modal_popup_box_settings['mpb_header_text_alignment']; else $mpb_header_text_alignment = "text-center";
	if(isset($modal_popup_box_settings['mpb_header_font_color'])) $mpb_header_font_color = $modal_popup_box_settings['mpb_header_font_color']; else $mpb_header_font_color = "#ffffff";
	if(isset($modal_popup_box_settings['mpb_header_bg_color'])) $mpb_header_bg_color = $modal_popup_box_settings['mpb_header_bg_color']; else $mpb_header_bg_color = "";
	if(isset($modal_popup_box_settings['mpb_animation_effect_header'])) $mpb_animation_effect_header = $modal_popup_box_settings['mpb_animation_effect_header']; else $mpb_animation_effect_header = "bounce";
	
	//Content Settings
	if(isset($modal_popup_box_settings['mpb_content_font_color'])) $mpb_content_font_color = $modal_popup_box_settings['mpb_content_font_color']; else $mpb_content_font_color = "#ffffff";
	if(isset($modal_popup_box_settings['mpb_content_bg_color'])) $mpb_content_bg_color = $modal_popup_box_settings['mpb_content_bg_color']; else $mpb_content_bg_color = "#008EC2";
		
	//Buttons Settings
	if(isset($modal_popup_box_settings['mpb_buttons'])) $mpb_buttons = $modal_popup_box_settings['mpb_buttons']; else $mpb_buttons = "both";
	//Modal From Buttons Alignment
	if(isset($modal_popup_box_settings['mpb_buttons_alignment'])) $mpb_buttons_alignment = $modal_popup_box_settings['mpb_buttons_alignment']; else $mpb_buttons_alignment = "text-center";
	//Modal From Buttons Link Option
	if(isset($modal_popup_box_settings['mpb_buttons_link_option'])) $mpb_buttons_link_option = $modal_popup_box_settings['mpb_buttons_link_option']; else $mpb_buttons_link_option = "_new";	
	
	//Buttons 1
	if(isset($modal_popup_box_settings['mpb_button1_text'])) $mpb_button1_text = $modal_popup_box_settings['mpb_button1_text']; else $mpb_button1_text = "Close";
	if(isset($modal_popup_box_settings['mpb_button1_size'])) $mpb_button1_size = $modal_popup_box_settings['mpb_button1_size']; else $mpb_button1_size = "btn btn-default";
	if(isset($modal_popup_box_settings['mpb_animation_effect_btn_1'])) $mpb_animation_effect_btn_1 = $modal_popup_box_settings['mpb_animation_effect_btn_1']; else $mpb_animation_effect_btn_1 = "bounce";
	if(isset($modal_popup_box_settings['mpb_button1_color'])) $mpb_button1_color = $modal_popup_box_settings['mpb_button1_color']; else $mpb_button1_color = "#0073AA";
	if(isset($modal_popup_box_settings['mpb_button1_text_color'])) $mpb_button1_text_color = $modal_popup_box_settings['mpb_button1_text_color']; else $mpb_button1_text_color = "#ffffff";
	if(isset($modal_popup_box_settings['mpb_button1_url'])) $mpb_button1_url = $modal_popup_box_settings['mpb_button1_url']; else $mpb_button1_url = "";
	//Buttons 2
	if(isset($modal_popup_box_settings['mpb_button2_text'])) $mpb_button2_text = $modal_popup_box_settings['mpb_button2_text']; else $mpb_button2_text = "Link & URL";
	if(isset($modal_popup_box_settings['mpb_button2_size'])) $mpb_button2_size = $modal_popup_box_settings['mpb_button2_size']; else $mpb_button2_size = "btn btn-default";
	if(isset($modal_popup_box_settings['mpb_animation_effect_btn_2'])) $mpb_animation_effect_btn_2 = $modal_popup_box_settings['mpb_animation_effect_btn_2']; else $mpb_animation_effect_btn_2 = "bounce";
	if(isset($modal_popup_box_settings['mpb_button2_color'])) $mpb_button2_color = $modal_popup_box_settings['mpb_button2_color']; else $mpb_button2_color = "#0073AA";
	if(isset($modal_popup_box_settings['mpb_button2_text_color'])) $mpb_button2_text_color = $modal_popup_box_settings['mpb_button2_text_color']; else $mpb_button2_text_color = "#ffffff";
	if(isset($modal_popup_box_settings['mpb_button2_url'])) $mpb_button2_url = $modal_popup_box_settings['mpb_button2_url']; else $mpb_button2_url = "http://awplife.com";
		
	//General Settings	
	//Animation Effect
	if(isset($modal_popup_box_settings['mpb_animation_effect_open_btn'])) $mpb_animation_effect_open_btn = $modal_popup_box_settings['mpb_animation_effect_open_btn']; else $mpb_animation_effect_open_btn = "md-effect-4" ;
	//Overlay Color
	if(isset($modal_popup_box_settings['mpb_overlay_color'])) $mpb_overlay_color = $modal_popup_box_settings['mpb_overlay_color']; else $mpb_overlay_color = "";
	//Overlay Opacity Color Range Bar
	if(isset($modal_popup_box_settings['mpb_overlay_opacity'])) $mpb_overlay_opacity = $modal_popup_box_settings['mpb_overlay_opacity']; else $mpb_overlay_opacity = 0;
	//Custom CSS
	if(isset($modal_popup_box_settings['mpb_custom_css'])) $mpb_custom_css = $modal_popup_box_settings['mpb_custom_css']; else $mpb_custom_css = "";
	//Modal Box Height And Width
	if(isset($modal_popup_box_settings['mpb_width'])) $mpb_width = $modal_popup_box_settings['mpb_width']; else $mpb_width = 35;
	if(isset($modal_popup_box_settings['mpb_height'])) $mpb_height = $modal_popup_box_settings['mpb_height']; else $mpb_height = 350;
	//Modal Box Animation Effect Time Duration
	if(isset($modal_popup_box_settings['mpb_animation_time_duration'])) $mpb_animation_time_duration = $modal_popup_box_settings['mpb_animation_time_duration']; else $mpb_animation_time_duration = 3;
	?>
	<style>	
	.btn:focus,
	.btn:focus,
	.btn:hover {
		color:#FFF !important;
	}
	.mpb-shotcode-buttons{
		margin-left: 2% !important;
		margin-top:1% !important;
	}
	.mpbp-<?php echo $modal_popup_box_id; ?> .md-content .mbox-title {
		padding:20px !important;
		font-size:<?php echo $mpb_header_font_size; ?>px !important;
		color:<?php echo $mpb_header_font_color; ?> !important;
		background-color:<?php echo $mpb_header_bg_color; ?> !important;
		text-align :<?php echo $mpb_header_text_alignment; ?> !important;
		margin: 0 !important;
		opacity: 1 !important;
		font-weight: bolder !important;
		background: rgba(0,0,0,0.1); <!-- Defalt color on header-->
	}
	.mpbp-<?php echo $modal_popup_box_id; ?> .md-content {
		color:<?php echo $mpb_content_font_color; ?> !important;
		background-color:<?php echo $mpb_content_bg_color; ?> !important;
	}

	.md-overlay {
		background-color:<?php echo $mpb_overlay_color; ?> !important;
		opacity: <?php if($mpb_animation_effect_open_btn == "md-effect-12") echo 1; else echo $mpb_overlay_opacity; ?> !important;
	}

	.btn-1-<?php echo $modal_popup_box_id; ?> {
		color:<?php echo $mpb_button1_text_color; ?> !important;
		background-color:<?php echo $mpb_button1_color; ?> !important;
	}
	.btn-1-<?php echo $modal_popup_box_id; ?>:hover{
		text-decoration: none !important;
	}
	.btn-1-<?php echo $modal_popup_box_id; ?> {
		text-decoration: none !important;
	}
	.btn-2-<?php echo $modal_popup_box_id; ?> {
		color:<?php echo $mpb_button2_text_color; ?> !important;
		background-color:<?php echo $mpb_button2_color; ?> !important;
	}
	.btn-2-<?php echo $modal_popup_box_id; ?>:hover{
		text-decoration: none !important;
	}
	.btn-2-<?php echo $modal_popup_box_id; ?> {
		text-decoration: none !important;
	}
	.md-modal {
		width:<?php echo $mpb_width; ?>% !important; 
	}
	.mpbp-<?php echo $modal_popup_box_id; ?> .md-content {
		height:<?php echo $mpb_height; ?>px !important;
	}
	.mpbp-<?php echo $modal_popup_box_id; ?> .animated {
	  -webkit-animation-duration:<?php echo $mpb_animation_time_duration; ?>s !important;
	  animation-duration:<?php echo $mpb_animation_time_duration; ?>s !important;	  
	}
	.btn-bg-<?php echo $modal_popup_box_id; ?> {
		background-color:<?php echo $mpb_main_button_color; ?>;
		color:<?php echo $mpb_main_button_text_color; ?>;
	}
	.btn-default{
		cursor:pointer !important;
	}
	<?php echo $mpb_custom_css; ?>
	</style>
	<?php
	require('modal-popup-box-output.php');
	return ob_get_clean();
}
?>