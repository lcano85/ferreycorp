<?php
/* Template Name: Pagina con Banner */
get_header();?>

<?php
$hero = get_field('banner');

echo '<pre>';
var_dump($hero);
echo '</pre>';

if( $hero ): ?>
<section class="ferreyros__banner--internal">
    <div class="container-fluid g-0">
        <div class="banner__picture">
            <?php if( !empty( $hero['imagen'] )){ ?>
                <img class="picture" src="<?php echo esc_url( $hero['imagen']['url'] ); ?>" alt="<?php echo esc_attr( $hero['imagen']['alt'] ); ?>">
            <?php }else{ ?>
                <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="">
            <?php } ?>
        </div>
        <div class="banner__content">
            <div class="back-to-page"> 
                <a class="permalink" href="javascript:history.go(-1)"> 
                    <span class="icon">
                        <svg>
                            <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-arrow-left"></use>
                        </svg>
                    </span>Volver
                </a>
            </div>
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
        </div>
    </div>
</section>
<?php endif; ?>
<section class="ferreyros__valores py-5">
    <div class="container">
        <?php the_content();?>
    </div>
</section>


<?php get_footer(); ?>