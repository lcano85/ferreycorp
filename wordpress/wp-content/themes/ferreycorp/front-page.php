<?php
/**
* Template Name: Pagina Principal Home
*/

global $post;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

get_header();

$rows = get_field('banner');
if( $rows ) : ?>
<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/07/Refuerzos-Proposito.png" alt="Ferreycorp" style="width: 180px; position: absolute; z-index: 10;"/>
<section class="ferreycorp__banner swiper-container">
    <div class="banner__list swiper-wrapper">
        <?php foreach( $rows as $row ): ?>
        <div class="banner__item swiper-slide">
            <div class="container-fluid g-0">
                <div class="banner__content">
                    <?php if($row['contenido']['titulo'] || $row['contenido']['texto']): ?>
                        <div class="content">
                            <?php if($row['contenido']['titulo']): ?>
                                <h1 class="title">
                                    <?php echo $row['contenido']['titulo']; ?>
                                </h1>
                            <?php endif; ?>
                            <?php if($row['contenido']['texto']): ?>
                            <p class="text"><?php echo $row['contenido']['texto']; ?></p><br>
							<?php if($row['enlace']): ?>
								<a href="<?php echo $row['enlace']['url']; ?>" title="<?php echo $row['enlace']['title']; ?>" target="<?php echo $row['enlace']['target'] ? $row['enlace']['target'] : '_self'; ?>" class="ver_mas_noticias" rel="noopener">Ver más</a>
								<?php else: 
									echo "";
								endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="banner__picture">                    
                    <?php if(!empty($row['imagen_portada']['imagen'])): ?>
                        <img class="picture" src="<?php echo $row['imagen_portada']['imagen']['url']; ?>" alt="<?php echo $row['imagen_portada']['imagen']['alt']; ?>">
                    <?php else: ?>
                        <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner.jpg" alt="banner">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</section>
<?php endif; ?>

<?php $seccion_programas = get_field('seccion_programas'); 
if($seccion_programas): ?>
<section class="ferreycorp__accesos-directos py-5">
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
                <div class="accesos-directos__item col-lg-2 pb-5 <?php echo $post_slug = $post->post_name; ?>__item">               
                    <div class="ferreycorp__card --mod5">
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
                                <h2 class="title"> <a class="permalink" href="<?php echo esc_url($row['acceso_directo_externo']['url']); ?>" target="_blank"><?php echo esc_html($row['acceso_directo_externo']['titulo']); ?></a></h2>
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

<?php $seccion_noticias = get_field('seccion_noticias'); 
if($seccion_noticias): ?>
<section class="ferreycorp__noticias py-5">
    <div class="container">
        <div class="noticias__head pb-4">
            <h2 class="title text-center m-0"><?php echo $seccion_noticias['titulo_seccion']; ?></h2>
            <p class="text"><?php echo $seccion_noticias['contenido']; ?></p>
        </div>
        <div class="noticias__content swiper-container py-4">
            <?php $rows = $seccion_noticias['lista_noticias']; ?>
            <div class="noticias__list swiper-wrapper">
                <?php foreach( $rows as $row ): ?>
                <div class="noticias__item swiper-slide">
                    <?php $page = $row['acceso_directo_interno']; ?>
                    <div class="ferreycorp__card --mod2">
                        <div class="card__image">                                                                 
                            <?php if($row['tipo_accesos_directos'] == 'interno'):
                                if ( has_post_thumbnail($page->ID) ) :  
                                    echo get_the_post_thumbnail( $page->ID, 'medium', ['class' => 'image'] ); 
                                else: ?>
                                    <img class="image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/card-image.jpg" alt="">
                                <?php endif; ?>  

                            <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                                <div class="card__image">
                                    <img class="image" src="<?php echo esc_url($row['acceso_directo_externo']['imagen']['url']); ?>" alt="<?php echo esc_url($row['acceso_directo_externo']['imagen']['alt']); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__content">
                            <?php if($row['tipo_accesos_directos'] == 'interno'): ?>
                                <?php $categories = get_the_category($page->ID);
                                    if ( ! empty( $categories ) ) : ?>
                                    <div class="category"> <small><?php echo $categories[0]->name; ?></small></div>
                                <?php endif; ?>
                                <h2 class="title"> 
                                    <a class="permalink" href="<?php echo get_the_permalink( $page->ID ); ?>">
                                        <?php echo get_the_title( $page->ID ); ?>
                                    </a>
                                </h2>
                            <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                                <h2 class="title"> <a class="permalink" href="<?php echo esc_url($row['acceso_directo_externo']['url']); ?>" target="_blank"><?php echo esc_html($row['acceso_directo_externo']['titulo']); ?></a></h2>
                            <?php endif; ?>
                            <div class="action text-center mt-3">
                                <a class="ver_mas_subsidiaria" href="<?php if($row['tipo_accesos_directos'] == 'interno'): get_the_permalink( $page->ID ); elseif($row['tipo_accesos_directos'] == 'externo'): echo esc_url($row['acceso_directo_externo']['url']); endif; ?>" target="<?php if($row['tipo_accesos_directos'] == 'interno'): ?>_self<?php else: ?>_blank<?php endif; ?>" >Leer más</a>
                            </div>                                                       
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>  
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination d-none"></div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>