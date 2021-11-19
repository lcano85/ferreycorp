<?php

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
        <?php if (have_posts()) :
            while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php the_content(); ?>
        <?php endwhile; 
            endif; 
            ?>
    </div>
</div>    

<?php get_sidebar(); ?>
<?php get_footer(); ?>