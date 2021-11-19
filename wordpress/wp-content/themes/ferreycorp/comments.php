<?php

if ( post_password_required() ) {
	return;
}

$ferreyros_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area default-max-width <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?> my-4">

	<?php
	if ( have_comments() ) :
		;
		?>
		<h2 class="comments-title">
			<?php if ( '1' === $ferreyros_comment_count ) : ?>
				<?php esc_html_e( '1 comentario', 'ferreyros' ); ?>
			<?php else : ?>
				<?php
				printf(
					/* translators: %s: Comment count number. */
					esc_html( _nx( '%s comentario', '%s comentarios', $ferreyros_comment_count, 'Comments title', 'ferreyros' ) ),
					esc_html( number_format_i18n( $ferreyros_comment_count ) )
				);
				?>
			<?php endif; ?>
		</h2><!-- .comments-title -->

		<ol class="comment-list my-4">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 60,
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'before_page_number' => esc_html__( 'Page', 'ferreyros' ) . ' ',
				'mid_size'           => 0,
				'prev_text'          => __( '« Prev' ),
				'next_text'          => __( 'Next »' ),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Los comentarios están cerrados.', 'ferreyros' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
		comment_form(
			array(
				'logged_in_as'       => null,
				'title_reply'        => esc_html__( '¡Comparte con nosotr@s!', 'ferreyros' ),
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
				'comment_field' => '<p class="comment-form-comment"><label style="display: none" for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="3" aria-required="true"></textarea></p>',
				'label_submit' => __('Publica tu comentario')
			)
		);
	?>

</div><!-- #comments -->
