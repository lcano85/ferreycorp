<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <?php wp_head(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_ID_MUNDO; ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php echo GA_ID_MUNDO; ?>');
	</script>
</head>
<header class="ferreycorp__header">
    <div class="container">
        <div class="ferreyros__hamburger">
            <ul class="hamburger__list">
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
            </ul>
        </div>
        <div class="ferreycorp__brand"><a class="brand" href="<?php echo get_home_url(); ?>" title="Mundo ferreycorp"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/logo-ferreycorp.png" alt="Mundo ferreycorp"></a></div>
        <?php
            $args = array(
                'theme_location' => 'menu-principal',
                'container' => 'nav',
                'container_class' => 'menu-principal',
            );
            wp_nav_menu($args);
            get_search_form();
        ?>
    </div>
</header>
<body class="movistar--blue">