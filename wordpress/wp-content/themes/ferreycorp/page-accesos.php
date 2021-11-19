<?php
/**
* Template Name: Pagina con Accesos
*/
get_header();

global $post;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): 
?>

<?php
$hero = get_field('bannerti'); 
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

<?php
$rows = get_field('banner');

$seccion_programas = get_field('seccion_programas'); 
if($seccion_programas): ?>
<section class="somos__ferreycorp-body py-5">
    <div class="container">
        <div class="accesos-directos__head pt-3 pb-5">
            <h2 class="title text-center m-0">
                <?php echo $seccion_programas['titulo_seccion']; ?>
            </h2>
            <?php if($seccion_programas['contenido']): ?>
                <p class="text"><?php echo $seccion_programas['contenido']; ?></p>
            <?php endif; ?>
        </div>
        <div class="programas__content">
        <?php $rows = $seccion_programas['accesos_directos']; ?>
            <div class="row <?php echo $post_slug = $post->post_name; ?>__list justify-content-center">
                <?php foreach( $rows as $row ): ?>
                <div class="col-lg-3 pb-5 col-sm-4 <?php echo $post_slug = $post->post_name; ?>__item">               
                    <div class="ferreycorp__card --mod4">
                        <?php if($row['tipo_accesos_directos'] == 'interno'):  
                                $page = $row['acceso_directo_interno'];
                                if(get_field('icono', $page->ID)): ?>
                                    <div class="card__image">
                                        <img class="image" src="<?php echo get_field('icono', $page->ID); ?>" alt="<?php echo get_the_title( $page->ID ); ?>">
                                    </div>
                                <?php endif; ?>
                        <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                            <div class="card__image">
                                <img class="image" src="<?php echo esc_url($row['acceso_directo_externo']['icono']['url']); ?>" alt="<?php echo esc_url($row['acceso_directo_externo']['icono']['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="card__content">
                            <?php if($row['tipo_accesos_directos'] == 'interno'):
                                    $page = $row['acceso_directo_interno']; ?>
                                <h2 class="title"> 
                                    <a class="permalink" href="<?php echo get_the_permalink( $page->ID ); ?>">
                                        <?php 
                                            if($row['titulo_acceso_directo_interno']):
                                                echo $row['titulo_acceso_directo_interno']; 
                                            else:
                                                echo get_the_title( $page->ID );
                                            endif;
                                        ?>
                                    </a>
                                </h2>
                            <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                                <h2 class="title"> <a class="permalink" href="<?php echo esc_url($row['acceso_directo_externo']['url']); ?>" target="_self"><?php echo esc_html($row['acceso_directo_externo']['titulo']); ?></a></h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

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