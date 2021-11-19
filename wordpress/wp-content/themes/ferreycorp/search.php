<?php 

get_header(); ?>

<section class="ferreycorp__page--content ferreyros__page--search py-5">
    <div class="container">
        <div class="search__header my-5">
            <?php if ( have_posts() ) : ?>
                <h1 class="text-center mg-0">
                    <?php
                        printf( __( 'Resultados de la búsqueda de: %s', 'ferreycorp' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            <?php else : ?>
                <h1 class="text-center"><?php _e( 'No hay resultados para mostrar', 'ferreycorp' ); ?></h1>
            <?php endif; ?>
        </div>
        <?php
            if ( have_posts() ) : ?>
            <div class="search__content">
                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-12 col-md-4 py-3">
                        <div class="ferreycorp__card --mod2">
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
        <?php endif; ?> 
        <?php ferreycorp_wp_custom_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>