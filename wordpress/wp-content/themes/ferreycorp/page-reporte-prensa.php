<?php
/* Template Name: Pagina de Entradas Reporte de Prensa */
get_header();

global $post;

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

<?php
$hero = get_field('banner'); 
?>

<section class="ferreycorp__banner--internal2">
    <div class="container-fluid g-0">
        <div class="banner__picture">
            <?php if( !empty( $hero['imagen_de_fondo'] )){ ?>
                <img class="picture" src="<?php echo esc_url( $hero['imagen_de_fondo']['url'] ); ?>" alt="<?php echo esc_attr( $hero['imagen_de_fondo']['alt'] ); ?>">
            <?php }else{ ?>
                <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="">
            <?php } ?>
        </div>
        <div class="banner__content">
            <div class="back-to-page">
                <?php if ( $post->post_parent ) { ?>
                <a class="permalink" href="<?php echo get_permalink( $post->post_parent ); ?>"> 
                    <span class="icon">
                        <img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/fi-rr-arrow-left.png">
                    </span>Volver
                </a>
                <?php } ?>
            </div>
            
                <div class="content">
                    <?php if($hero['titulo']){ ?>
                        <h1 class="title"><?php echo esc_html( $hero['titulo'] ); ?></h1>
                    <?php } ?>
                    <?php if($hero['contenido']){ ?>
                        <p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                    <?php } ?>
                </div>
        </div>
    </div>
</section>

<section class="ferreyros__page--content py-5">
    <div class="container container-2">
        
		<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
  
    <?php
    $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'reporte-de-prensa-2',
        'posts_per_page' => 5,
        'paged' => $paged,
    );
    $arr_posts = new WP_Query( $args );
  
    if ( $arr_posts->have_posts() ) :
  
        while ( $arr_posts->have_posts() ) :
            $arr_posts->the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                if ( has_post_thumbnail() ) :
                    the_post_thumbnail();
                endif;
                ?>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>">Leer más</a>
                </div>
            </article>
            <?php
        endwhile;
        pagination_nav();
    endif;
    ?>
  
    </main><!-- .site-main -->
</div><!-- .content-area -->
		
    </div>
</section>

<section class="ferreycorp__page--content py-5">
    <div class="container container-2">
        <?php echo the_content();?>
    </div>
</section>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>