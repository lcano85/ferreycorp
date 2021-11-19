<?php
  
get_header();

global $wp;

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>
	
	<?php $hero = get_field('bannerti'); ?>
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
                    <?php 
                        $domain = $_SERVER['SERVER_NAME'];
                        $str_uri = $domain.$_SERVER['REQUEST_URI'];

                        $uris = explode('/', $str_uri, -2);                   

                        $comboClass = array();
                        foreach($uris as $uri) {
                            $comboClass[] = $uri;
                        }
                        $url_parent = 'https://'.implode('/',$comboClass);
                    
                    ?>
                    <a class="permalink" href="<?php echo $url_parent; ?>"> 
                        <span class="icon">
							<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/fi-rr-arrow-left.png">
                        </span>
                        Volver
                    </a>
                </div>
                <?php if( empty($hero['tipo_contenido']) ){ ?>
                    <div class="content">
                        <h1 class="title"><?php the_title(); ?></h1>
						<p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                    </div>
                <?php }elseif( $hero['tipo_contenido'] == 'textos' ) { ?>
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
	
	<section class="ferreyros__page--content py-5">
		<div class="container container-2">  
            <?php

                while ( have_posts() ) : the_post(); ?>
            
                <!-- <div class="single__header my-4">
                    <?php //the_title( '<h1 class="text-center m-0">', '</h1>' ); ?>
                </div> -->

                <div class="single__content my-4">
				<div style="width: 100%; text-align: center">
				Publicado a la‎(s)‎ <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?> <?php echo get_the_time(); ?></time> por <?php echo get_the_author(); ?> 
				<?php
				if (get_the_modified_date() > get_the_date()) 
				{
					echo " ";
				} 
				else 
				{
					echo " <b>[ actualizado el ";
					echo " ".get_the_modified_date(); 
					echo " ".get_the_modified_time();
					echo " ]</b>";
				}
				?>
                    <br><br>
					<?php the_content(); ?>
                </div>
				</div>

                <?php
                    wp_link_pages(
                        array(
                            'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'ferreryros' ) . '">',
                            'after'    => '</nav>',
                            /* translators: %: Page number. */
                            'pagelink' => esc_html__( 'Page %', 'ferreryros' ),
                        )
                    );
                ?>
                
            <?php   if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
    
                ferreycorp_wp_custom_pagination();
    
            endwhile;
            
            ?>            
        </div>
	</section>
  

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>
  
<?php get_footer(); ?>