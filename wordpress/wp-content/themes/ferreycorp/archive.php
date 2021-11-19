<?php get_header(); ?>
<section class="ferreyorp__page--content ferreyros__page--archive py-5">
    <div class="container">
		<?php if ( have_posts() ) : ?>
		<div class="archive__header my-5">
			<h1 class="text-center m-0">
				<?php
					if ( is_category() ) {
						single_cat_title();
					} elseif ( is_tag() ) {
						single_tag_title();
					} elseif ( is_author() ) {
						the_post();
						echo 'Author Archives: ' . get_the_author();
						rewind_posts();
					} elseif ( is_day() ) {
						echo 'Daily Archives: ' . get_the_date();
					} elseif ( is_month() ) {
						echo 'Monthly Archives: ' . get_the_date( 'F Y' );
					} elseif ( is_year() ) {
						echo 'Yearly Archives: ' . get_the_date( 'Y' );
					} else {
						echo 'Archives: ';
					}
				?>
			</h1>
		</div>
		<div class="search__content">
			<div class="row">
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-sm-12 col-md-4 py-3">
					<div class="ferreyros__card --mod2">
						<div class="card__image">
							<?php if ( has_post_thumbnail() ) : 
								the_post_thumbnail('medium', ['class' => 'image']);
							else: ?>
							<img class="image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/card-image.jpg" alt="">
							<?php endif; ?>
						</div>
						<div class="card__content">
						<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) : ?>
							<div class="category"> <small><?php echo esc_html( $categories[0]->name ); ?></small></div>
						<?php endif; ?>
							<h2 class="title"> <a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="author"> <small><?php echo get_the_author(); ?></small></div>
						</div>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
		<?php else : ?>
		<div class="archive__content my-5">
			<h1 class="text-center m-0">¡No hay publicaciones!</h1>
		</div>
		<?php endif; ?>
		<?php ferreycorp_wp_custom_pagination(); ?>
	</div>
</section>

<?php get_footer(); ?>