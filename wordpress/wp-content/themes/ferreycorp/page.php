<?php
/**
* Template Name: Plantilla predeterminada
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

get_header();?>


    <?php if (have_posts()) :

        while (have_posts()) : the_post();?>

            <section class="ferreycorp__page--content py-5">
                <div class="container">
                    <?php the_content();?>
                </div>
            </section>

        <?php endwhile;
    endif;?>
<?php get_footer(); ?>