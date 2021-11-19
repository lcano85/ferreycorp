<?php $permisos_contenido = get_field('permisos_contenido'); ?>
<section class="ferreycorp__page--content ferreycorp__page--<?php echo $post_slug = $post->post_name; ?> py-5">
    <div class="container">
        <?php echo $permisos_contenido['mensaje'] ?>
    </div>
</section>