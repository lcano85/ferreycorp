<?php
/**
Plugin Name: Modal Popup Box Premium
Plugin URI: http://awplife.com/
Description: Modal popup box embed anything like images, videos, galleries, albums, slideshows, coupon, offers, plugin shortcodes, HTML content and more.
Version: 3.6
Author: A WP Life
Author URI: http://awplife.com/
Text Domain: awl-modal-popup-box
Domain Path: /languages
*/

if ( ! class_exists( 'Modal_Popup_Box' ) ) {

	class Modal_Popup_Box {
		
		protected $protected_plugin_api;
		protected $ajax_plugin_nonce;
		
		public function __construct() {
			$this->_constants();
			$this->_hooks();
		}
		
		protected function _constants() {
			//Plugin Version
			define( 'MPB_PLUGIN_VER', '3.6' );
			
			//Plugin Text Domain
			define("MPB_TXTDM","awl-modal-popup-box" );

			//Plugin Name
			define( 'MPB_PLUGIN_NAME', __( 'Modal Popup Box', 'MPB_TXTDM' ) );

			//Plugin Slug
			define( 'MPB_PLUGIN_SLUG', 'modalpopupbox' );

			//Plugin Directory Path
			define( 'MPB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

			//Plugin Directory URL
			define( 'MPB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

			/**
			 * Create a key for the .htaccess secure download link.
			 * @uses    NONCE_KEY     Defined in the WP root config.php
			 */
			define( 'MPB_SECURE_KEY', md5( NONCE_KEY ) );
			
		} // end of constructor function
		
		protected function _hooks() {
			
			//Load text domain
			//add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) );
			
			//add gallery menu item, change menu filter for multisite
			//add_action( 'admin_menu', array( $this, '_srgallery_menu' ), 101 );
			
			//Create Image Gallery Custom Post
			add_action( 'init', array( $this, 'codex_modalpopupbox_init' ));
			
			//Add meta box to custom post
			add_action( 'add_meta_boxes', array( $this, '_admin_add_meta_box' ) );
			 
			//loaded during admin init 
			add_action( 'admin_init', array( $this, '_admin_add_meta_box' ) );
			
			//save setting 
			add_action('save_post', array(&$this, '_mpb_save_settings'));

			//Shortcode Compatibility in Text Widgets
			add_filter('widget_text', 'do_shortcode');
			
			// add pfg cpt shortcode column - manage_{$post_type}_posts_columns
			add_filter( 'manage_modalpopupbox_posts_columns', array(&$this, 'set_popup_shortcode_column_name') );
			
			// add pfg cpt shortcode column data - manage_{$post_type}_posts_custom_column
			add_action( 'manage_modalpopupbox_posts_custom_column' , array(&$this, 'custom_popup_shodrcode_data'), 10, 2 );

			add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_scripts_in_header') );
		
			//clone modal ajax call back, its required localize ajax object
			add_action('wp_ajax_mpb_clone_popup', array(&$this, 'mpb_clone_popup'));
			
		}// end of hook function
		
		/**
			* Clone popup call back
		*/
		public function mpb_clone_popup() {
			if(isset($_POST['mpb_clone_post_id'])) {
				$mpb_clone_post_id = sanitize_text_field($_POST['mpb_clone_post_id']);
				// get all required data for cloning
				$post_title = get_the_title($mpb_clone_post_id)." - Duplicate";
				$content_post = get_post($mpb_clone_post_id);
				$content = $content_post->post_content;
				$content = apply_filters('the_content', $content);
				$post_content = str_replace(']]>', ']]&gt;', $content);
				$post_type = "modalpopupbox";
				$post_status = "draft";
				
				// get gallery post meta settings for cloning
				$MPB_Gallery_Settings_Key = "awl_mpb_settings_".$mpb_clone_post_id;
				$modal_popup_box_settings = get_post_meta( $mpb_clone_post_id, $MPB_Gallery_Settings_Key, true);
				
				//cloning post
				$mpb_cloning_post_array =  array(
					'post_title' => $post_title,
					'post_content' => $post_content,
					'post_type' => $post_type,
					'post_status' => $post_status,
					
				);
				
				$mpb_cloned_post_id = wp_insert_post($mpb_cloning_post_array);
				// images post meta settings cloning
				add_post_meta( $mpb_cloned_post_id, "awl_mpb_settings_".$mpb_cloned_post_id, $modal_popup_box_settings);
				
			}
		}
		
		public function enqueue_scripts_in_header() {
			wp_enqueue_script('jquery');
		}
		
		// Popup Box cpt shortcode column before date columns
		public function set_popup_shortcode_column_name($defaults) {
			$new = array();
			$shortcode = $columns['_popup_shortcode'];  // save the tags column
			unset($defaults['tags']);	// remove it from the columns list

			foreach($defaults as $key=>$value) {
				if($key=='date') {  // when we find the date column
				   $new['_popup_shortcode'] = __( 'Shortcode', MPB_TXTDM );  // put the tags column before it.
				   	$new['_modalpopupbox_duplicate'] = __( 'Duplicate', MPB_TXTDM );  // put the tags column before it
				}    
				$new[$key] = $value;
			}
			return $new;  
		}
		
		// Popup Box cpt shortcode column data
		public function custom_popup_shodrcode_data( $column, $post_id ) {
			switch ( $column ) {
				case '_popup_shortcode' :
					echo "<input type='text' class='button button-primary' id='popup-shortcode-$post_id' value='[MPBOX id=$post_id]' style='font-weight:bold; background-color:#32373C; color:#FFFFFF; text-align:center;' />";
					echo "<input type='button' class='button button-primary' onclick='return PopupShortcode$post_id();' readonly value='Copy' style='margin-left:4px;' />";
					echo "<span id='copy-msg-$post_id' class='button button-primary' style='display:none; background-color:#32CD32; color:#FFFFFF; margin-left:4px; border-radius: 4px;'>copied</span>";
					echo "<script>
						function PopupShortcode$post_id() {
							var copyText = document.getElementById('popup-shortcode-$post_id');
							copyText.select();
							document.execCommand('copy');
							
							//fade in and out copied message
							jQuery('#copy-msg-$post_id').fadeIn('1000', 'linear');
							jQuery('#copy-msg-$post_id').fadeOut(2500,'swing');
						}
						</script>
					";
				break;
				case '_modalpopupbox_duplicate' :
					echo "<input type='button' class='button button-primary' onclick='return mpb_clone_run_$post_id($post_id);' readonly value='Duplicate Modal Box' style='margin-left:4px;' />";
					echo "<script>
						function mpb_clone_run_$post_id(post_id){
							if(confirm('Do you want to duplicate this Modal?')){
								var formData = {
									'action': 'mpb_clone_popup',
									'mpb_clone_post_id': post_id,
								};
								jQuery.ajax({
									type: 'post',
									dataType: 'json',
									url: ajaxurl,
									data: formData,
									success: function(response){
										location.href = 'edit.php?post_type=modalpopupbox';
									}
								});
							}
						}
						</script>
					";
				break;
			}
		}
		
		// Modal Popup Box Custom Post Type
		function codex_modalpopupbox_init() {
			$labels = array(
				'name'               => _x( 'Modal Popup Box', 'post type general name', 'your-plugin-textdomain' ),
				'singular_name'      => _x( 'Modal Popup Box', 'post type singular name', 'your-plugin-textdomain' ),
				'menu_name'          => _x( 'Modal Popup Box', 'admin menu', 'your-plugin-textdomain' ),
				'name_admin_bar'     => _x( 'Modal Popup Box', 'add new on admin bar', 'your-plugin-textdomain' ),
				'add_new'            => _x( 'Add New', 'Modal Popup Box', 'your-plugin-textdomain' ),
				'add_new_item'       => __( 'Add New Modal Popup Box', 'your-plugin-textdomain' ),
				'new_item'           => __( 'New Modal Popup Box', 'your-plugin-textdomain' ),
				'edit_item'          => __( 'Edit Modal Popup Box', 'your-plugin-textdomain' ),
				'view_item'          => __( 'View Modal Popup Box', 'your-plugin-textdomain' ),
				'all_items'          => __( 'All Modal Popup Box', 'your-plugin-textdomain' ),
				'search_items'       => __( 'Search Modal Popup Box', 'your-plugin-textdomain' ),
				'parent_item_colon'  => __( 'Parent Modal Popup Box:', 'your-plugin-textdomain' ),
				'not_found'          => __( 'No Modal Popup Box found.', 'your-plugin-textdomain' ),
				'not_found_in_trash' => __( 'No Modal Popup Box found in Trash.', 'your-plugin-textdomain' )
				
			);

			$args = array(
				'labels'             => $labels,
				'description'        => __( 'Description.', 'your-plugin-textdomain' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'modalpopupbox' ),
				'capability_type'    => 'page',
				'menu_icon'           => 'dashicons-archive',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title','editor')
			);
			
			register_post_type( 'modalpopupbox', $args );
		}
		
		public function _admin_add_meta_box() {
			add_meta_box( '1', __('Copy Modal Popup Shortcode', MPB_TXTDM), array(&$this, '_mpb_shortcode_left_metabox'), 'modalpopupbox', 'side', 'default' );
			add_meta_box( '', __('Modal Box Settings', MPB_TXTDM), array(&$this, 'mpb_metabox_function'), 'modalpopupbox', 'normal', 'default' );
		}
		
		// Modal Popup Box copy shortcode meta box under publish button
		public function _mpb_shortcode_left_metabox($post) { ?>
			<p class="input-text-wrap">
				<input type="text" name="PopupShortcode" id="PopupShortcode" value="<?php echo "[MPBOX id=".$post->ID."]"; ?>" readonly style="height: 50px; text-align: center; width:100%;  font-size: 24px; border: 2px dashed;">
				<p id="mpb-copy-code"><?php _e('Shortcode copied to clipboard!', MPB_TXTDM); ?></p>
				<p style="margin-top: 10px"><?php _e('Copy & Embed shotcode into any Page/ Post / Text Widget to display gallery.', MPB_TXTDM); ?></p>
			</p>
			<span onclick="copyToClipboard('#PopupShortcode')" class="mpb-copy dashicons dashicons-clipboard"></span>
			<style>
				.mpb-copy {
					position: absolute;
					top: 9px;
					right: 24px;
					font-size: 26px;
					cursor: pointer;
				}
				.ui-sortable-handle > span {
					font-size: 16px !important;
				}
			</style>
			<script>
				jQuery( "#mpb-copy-code" ).hide();
				function copyToClipboard(element) {
				  var $temp = jQuery("<input>");
				  jQuery("body").append($temp);
				  $temp.val(jQuery(element).val()).select();
				  document.execCommand("copy");
				  $temp.remove();
				  jQuery( "#PopupShortcode" ).select();
				  jQuery( "#mpb-copy-code" ).fadeIn();
				}
			</script>
			<?php
		}
		
		public function mpb_metabox_function($post) { 
			wp_enqueue_style('mbp-meta-css', MPB_PLUGIN_URL.'assets/css/metabox.css' ); ?>
			<h1><?php _e('Modal Popup Box Setting', MPB_TXTDM); ?></h1>
			<hr>
			<?php
			require_once("include/modal-popup-box-settings.php");
		} // 
		
		public function _mpb_save_settings($post_id) {
			if(isset($_POST['mpb_save_nonce'])) {
				if ( !isset( $_POST['mpb_save_nonce'] ) || !wp_verify_nonce( $_POST['mpb_save_nonce'], 'mpb_save_settings' ) ) {
				   print 'Sorry, your nonce did not verify.';
				   exit;
				} else {
					$awl_modal_popup_box_shortcode_setting = "awl_mpb_settings_".$post_id;
					update_post_meta($post_id, $awl_modal_popup_box_shortcode_setting, base64_encode(serialize($_POST)));
				}
			}
		}// end save setting
	} // end of class

	$mpbox_object = new Modal_Popup_Box();
	require_once('include/modal-popup-box-shortcode.php');
} // end of class exists
?>