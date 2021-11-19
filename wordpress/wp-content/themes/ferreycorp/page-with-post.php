<?php

/* Template Name: Pagina con Entradas */

//Funcion paginador
if ( ! function_exists( 'pagination' ) ) :
    function pagination( $paged = '', $max_page = '' )
    {
        $echo = true;
        $big = 999999999; // need an unlikely integer
        if( ! $paged )
            $paged = get_query_var('paged');
        if( ! $max_page )
            $max_page = $wp_query->max_num_pages;

        $add_args = [];
        $pages = paginate_links( array_merge( [
            'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link( $big ))),
            'format'     => '?paged=%#%',
            'current'    => max( 1, $paged ),
            'total'      => $max_page,
            'type'         => 'array',
            'show_all'     => false,
            'mid_size'     => 2,
            'end_size'     => 0,
            'prev_next'    => true,
            'prev_text'    => __( '<' ),
            'next_text'    => __( '>' ),
            'add_args'     => $add_args,
            'add_fragment' => ''
            ] ) 
        );
        if ( is_array( $pages ) ) {
            $count = 1;
            $pagination = '<div class="pagination justify-content-center mt-5"><ul class="pagination m-0">';
            foreach ( $pages as $page ) {
                $count++;
                $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
            }
            $pagination .= '</ul></div>';
            if ( $echo ) {
                echo $pagination;
            } else {
                echo $pagination;
            }
        }
        return null;
    }
endif;

get_header(); 

global $post; 

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

    <?php $hero = get_field('bannerti'); ?>
    <section class="ferreycorp__banner--internal">
        <div class="container-fluid g-0">
            <div class="banner__picture">
                <?php if( !empty( $hero['imagen_de_fondo'] )){ ?>
                    <img class="picture" src="<?php echo esc_url( $hero['imagen_de_fondo']['url'] ); ?>" alt="<?php echo esc_attr( $hero['imagen_de_fondo']['alt'] ); ?>">
                <?php }else{ ?>
                    <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="">
                <?php } ?>
            </div>
            <div class="banner__content">
                <?php if ( $post->post_parent ) { ?>
                    <div class="back-to-page">
                        <a class="permalink" href="<?php echo get_permalink( $post->post_parent ); ?>"> 
                            <span class="icon">
                                <img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/fi-rr-arrow-left.png">
                            </span>
                            Volver
                        </a>
                    </div>
                <?php } ?>
                <?php  if( $hero['tipo_contenido'] == 'textos' ) { ?>
                    <div class="content">
                        <?php if($hero['titulo']){ ?>
                            <h1 class="title"><?php echo esc_html( $hero['titulo'] ); ?></h1>
                        <?php } ?>
                        <?php if($hero['contenido']){ ?>
                            <p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                        <?php } ?>
                    </div>
                <?php } elseif( $hero['tipo_contenido'] == 'icono' ){ ?>
                    <div class="content">
                        <?php if( !empty( $hero['icono'] )){ ?>
                            <img class="picture" src="<?php echo esc_url( $hero['icono']['url'] ); ?>" alt="<?php echo esc_attr( $hero['icono']['alt'] ); ?>">
                        <?php } ?>
                    </div>
                <?php } ?>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php if(function_exists('bcn_display'))
                            {
                                bcn_display();
                            }
                        ?>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <?php                             

    $post_type = get_field( 'tipo_de_entrada' );
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;                                               
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' =>  12,
        'order'          => 'DESC',
        'order_by'       => 'date',
        'post_status'    => 'publish',
        'paged'          => $paged,
    );                    
    $loop = new WP_Query( $args );
    $numberPages = $loop->max_num_pages;
    if ( $loop->have_posts() ) : ?>
    <section class="ferreycorp__page--content fred__page--<?php echo $post_slug = $post->post_name; ?> py-5">
        <div class="container">
            <div class="row">
                <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4 py-4">
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
                                if ( ! empty( $categories ) ) : 
                            ?>
                            <div class="category"> <small><?php echo esc_html( $categories[0]->name ); ?></small></div>
                            <?php endif; ?>
                            <h2 class="title"> <a class="permalink" title="<?php echo the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></a></h2>
                            <div class="action text-center mt-3">
                                <a class="ferreycorp__btn" href="<?php the_permalink(); ?>" target="_self" >Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    endwhile; wp_reset_postdata(); 
                    pagination( $paged, $loop->max_num_pages);
                ?>  
            </div>
        </div>
    </section>
    <?php else: ?>
        <div class="ferreycorp__page--content fred__page--noe-ssma py-5">
            <p class="text-center"> ¡No hay publicaciones! </p>
        </div>
    <?php endif; ?>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>