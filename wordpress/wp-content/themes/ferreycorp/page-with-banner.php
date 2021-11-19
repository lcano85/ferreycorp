<?php
/* Template Name: Pagina con Banner Texto Centrado */
get_header();

global $post;

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

<?php
$hero = get_field('banner'); 
?>
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
            <div class="back-to-page">
                <?php if ( $post->post_parent ) { ?>
                <a class="permalink" href="<?php echo get_permalink( $post->post_parent ); ?>"> 
                    <span class="icon">
                            <img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/fi-rr-arrow-left.png">
                    </span>Volver
                </a>
                <?php } ?>
            </div>
            <?php  if( $hero['tipo_de_contenido'] == 'textos' ) { ?>
                <div class="content">
                    <?php if($hero['titulo']){ ?>
                        <h1 class="title"><?php echo esc_html( $hero['titulo'] ); ?></h1>
                    <?php } ?>
                    <?php if($hero['contenido']){ ?>
                        <p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                    <?php } ?>
                </div>
            <?php } else{ ?>
            <?php } ?>
        </div>
    </div>
</section>

<section class="ferreyros__page--content py-5">
    <div class="container container-2">
        <?php echo the_content();?>
		<?php comments_template(); ?>
    </div>
</section>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>