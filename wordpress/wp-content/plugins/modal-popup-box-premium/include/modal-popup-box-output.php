<?php
// get post details
$modal_popup_box_id = $post_id['id'];
$all_modal_popup_box = array(  'p' => $modal_popup_box_id, 'post_type' => 'modalpopupbox', 'orderby' => 'ASC');
$loop = new WP_Query( $all_modal_popup_box );
while ( $loop->have_posts() ) : $loop->the_post();
?>
<div class="mpbp-<?php echo $modal_popup_box_id; ?> md-modal <?php if($mpb_show_modal == "onload") echo "md-show"; ?> <?php echo $mpb_animation_effect_open_btn; ?>" id="modal-<?php echo $modal_popup_box_id; ?>" <?php if($mpb_show_modal == "onclick") { ; ?> style="display:none;" <?php } ?> >
	<div class="md-content">
		<?php 
		if($mpb_title == "show") { ?>
			<h3 class="mbox-title <?php echo $mpb_animation_effect_header; ?> animated <?php echo $mpb_header_text_alignment; ?>"><?php if($modal_title = get_the_title()) echo $modal_title; else echo "Modal Title Here"; ?></h3>
			<?php 
		} ?>
		<div>
			<?php
			$modal_content = get_the_content(); 
			if(empty($modal_content)) {
				echo " <p style='font-weight: bold;' >Modal content is empty. This is sample content. You can change it anytime. Simply update your shortcode content part to display here.</p>
					<ul>
					<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
					<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
					<li><strong>Close:</strong> click on the button below to close the modal.</li>
					</ul>";
			} else {
				//echo $modal_content;
				echo do_shortcode( $modal_content );
			}
			?>
		</div>
		<div class="mpb-buttons <?php echo $mpb_buttons_alignment ?>">
			<?php
			if($mpb_buttons == "one") {
				if($mpb_button1_url)
					echo  "<a href='$mpb_button1_url' target='$mpb_buttons_link_option' class='btn-1-$modal_popup_box_id $mpb_button1_size animated $mpb_animation_effect_btn_1'>$mpb_button1_text</a>";
				else 
					echo  "<div class='btn-1-$modal_popup_box_id $mpb_button1_size md-close animated $mpb_animation_effect_btn_1'>$mpb_button1_text</div>";
			}
			if($mpb_buttons == "two") {
				if($mpb_button2_url)
					echo  "<a href='$mpb_button2_url' target='$mpb_buttons_link_option' class='btn-2-$modal_popup_box_id $mpb_button2_size animated $mpb_animation_effect_btn_2'>$mpb_button2_text</a>";
				else 
					echo  "<div class='btn-2-$modal_popup_box_id $mpb_button2_size md-close animated $mpb_animation_effect_btn_2'>$mpb_button2_text</div>";
			}
			if($mpb_buttons == "both") {
				if($mpb_button1_url)
					echo  "<a href='$mpb_button1_url' target='$mpb_buttons_link_option' class='btn-1-$modal_popup_box_id $mpb_button1_size animated $mpb_animation_effect_btn_1'>$mpb_button1_text</a>&nbsp";
				else 
					echo  "<div class='btn-1-$modal_popup_box_id $mpb_button1_size md-close animated $mpb_animation_effect_btn_1'>$mpb_button1_text</div>&nbsp";
				
				if($mpb_button2_url)
					echo  "<a href='$mpb_button2_url' target='$mpb_buttons_link_option' class='btn-2-$modal_popup_box_id $mpb_button2_size animated $mpb_animation_effect_btn_2'>$mpb_button2_text</a>";
				else 
					echo  "<div class='btn-2-$modal_popup_box_id $mpb_button2_size md-close animated $mpb_animation_effect_btn_2'>$mpb_button2_text</div>";
			}
			?>
		</div>
	</div>
</div>

<!--shortcode button-->
<?php if($mpb_show_modal == "onclick") { ?>
<div  class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mpb-shotcode-buttons">	
	<div class="md-trigger md-setperspective btn-bg-<?php echo $modal_popup_box_id; ?> <?php echo $mpb_main_button_size; ?> text-center" style="width:200px;"  data-modal="modal-<?php echo $modal_popup_box_id; ?>"><?php echo $mpb_main_button_text; ?></div><br>
</div>
<?php } ?>

<!-- the overlay element -->
<div class="md-overlay"></div>
<?php
endwhile;
wp_reset_query();
?>
<script>
/**
 * modalEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
jQuery(document).ready(function () {
 
	var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.md-overlay' );
		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {

			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
			close = modal.querySelector( '.md-close' );

			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );
				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				// pause YouTube video on modal close by outer click
				jQuery('.youtube-video-<?php echo $modal_popup_box_id; ?>')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
				classie.add( modal, 'md-show' );
				overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				// pause YouTube video on modal close by button inside
				jQuery('.youtube-video-<?php echo $modal_popup_box_id; ?>')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
				ev.stopPropagation();
				removeModalHandler();
			});
		} );
	}
	init();
	})();

	// on page load modal close script
	// on page load last 3 effect set perspective condition
	<?php if($mpb_show_modal == "onload" && ($mpb_animation_effect_open_btn == "md-effect-17" || $mpb_animation_effect_open_btn == "md-effect-18" || $mpb_animation_effect_open_btn == "md-effect-19")) { ?>
		jQuery("html").addClass("md-perspective");
	<?php } ?>

	// close modal when click on overlay
	jQuery(".md-overlay").click(function() {
		jQuery(".md-modal").removeClass("md-show");
		jQuery("html").removeClass("md-perspective");
	});

	// close modal when click on modal close button
	jQuery(".md-close").click(function() {
		jQuery(".md-modal").removeClass("md-show");
		jQuery("html").removeClass("md-perspective");
	});
	// close modal when click on modal close button
});

jQuery(".md-trigger").click(function() {
	jQuery(".md-modal").show();
});
</script>