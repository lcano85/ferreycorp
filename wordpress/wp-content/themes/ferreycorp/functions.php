<?php

/* Desactivar wptexturize */
add_filter( 'run_wptexturize', '__return_false' );

//Funcion para la pagina archivos, taxonomias(categorias, etiquetas, autor, etc)
function pagination_nav() 
{
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) 
	{ 
?>
	<nav class="pagination" role="navigation">
		<div class="nav-previous"><?php next_posts_link( 'Siguiente >' ); ?></div>
		<div class="nav-next"><?php previous_posts_link( '< Anterior' ); ?></div>
		</nav>
<?php 
	}	
}

function ferreycorp_cptui_add_post_types_to_archives( $query ) {	
	if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}
	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$cptui_post_types = cptui_get_post_type_slugs();
		$query->set(
			'post_type',
			array_merge(
                array( 'post' ),
				$cptui_post_types
            )
        );
        $query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
		$query->set( 'posts_per_page', '8' );
	}
}
add_filter( 'pre_get_posts', 'ferreycorp_cptui_add_post_types_to_archives' );

//Personalizar paginacion
function ferreycorp_wp_custom_pagination( \WP_Query $wp_query = null, $echo = true, $params = [] ) {
    if ( null === $wp_query ) {
        global $wp_query;
    }
    $add_args = [];
    $pages = paginate_links( array_merge( [
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'format'       => '?paged=%#%',
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => __( '« Prev' ),
            'next_text'    => __( 'Next »' ),
            'add_args'     => $add_args,
            'add_fragment' => ''
        ], $params )
    );
    if ( is_array( $pages ) ) {
        $pagination = '<div class="pagination"><ul class="pagination">';
        foreach ( $pages as $page ) {
            $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
        }
        $pagination .= '</ul></div>';
        if ( $echo ) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }
    return null;
}

//Personalizar tags
add_filter( 'term_links-post_tag', function( array $links ) {
    return preg_replace_callback(
    '|href="[^"]*/([^"]+?)/?"|',
    function( array $matches ) {
        list( $href, $slug ) = $matches;
        return "class=\"noticia-etiqueta tag-{$slug}\" {$href}";
    },
    $links
    );
});


//Limitar con la funcion get_the_excerpt
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...(leer más)';
    } else {
    $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

//Limitar con la funcion get_the_content
  function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...(leer más)';
    } else {
    $content = implode(" ",$content);
    }
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}

//Cuando el tema esta activo
function ferreycorp_setup() {
	//Habilitar imagenes destacadas
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'ferreycorp_setup');

//Menu de navegacion
function ferreycorp_menus() {
    register_nav_menus(array(
        'menu-principal' => __( 'Menu Principal', 'ferreycorp' ),
        'menu-footer' => __( 'Menu Footer', 'ferreyros' )
    ));
}
add_action('init', 'ferreycorp_menus');

//Archivos js y css
function ferreycorp_scripts_styles(){

	//Estilos
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

	//Functions
	wp_enqueue_script('function', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts','ferreycorp_scripts_styles');

//Archivos css para modificar login
function login_style_ferreycorp() {        
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css' );
}
add_action('login_enqueue_scripts', 'login_style_ferreycorp');

// Definir zona de widgets
function ferreycorp_widgets(){
    register_sidebar(array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar_1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar_2',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 3',
        'id' => 'sidebar_3',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 4',
        'id' => 'sidebar_4',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'ferreycorp_widgets');

// Obtiene una identificación única.
// Esta es una implementación PHP del método uniqueId de Underscore. Una variable estática
// contiene un número entero que se incrementa con cada llamada. Este número se devuelve
// con el prefijo opcional. Como tal, el valor devuelto no es universalmente único,
// pero es único a lo largo de la vida del proceso PHP.
function ferreycorp_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/*
is_admin() && add_filter( 'script_loader_src', 'wpq_script_loader_src' );
function wpq_script_loader_src( $src ){
    $domain = $_SERVER['SERVER_NAME'];
    $old_domain = 'https://'.$domain;
    $new_domain = 'https://cdn.'.$domain;
    $src = str_ireplace( $old_domain, $new_domain , $src );
    return $src;
}
*/

/*
is_admin() && add_filter( 'style_loader_src', 'wpq_style_loader_src' );
function wpq_style_loader_src( $src ){
    $domain = $_SERVER['SERVER_NAME'];
    $old_domain = 'https://'.$domain;
    $new_domain = 'https://cdn.'.$domain;
    $src = str_ireplace( $old_domain, $new_domain , $src );
    return $src;
}
*/

function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

add_filter( 'menu_image_default_sizes', function($sizes){
    // remove the default 36x36 size
    unset($sizes['menu-36x36']);
    // add a new size
    $sizes['menu-50x50'] = array(50,50);
    // return $sizes (required)
    return $sizes;
});

function ferreycorp_breadcrumbs() 
{

    /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
    $text['page']     = 'Page %s'; // text 'Page N'
    $text['cpage']    = 'Comment Page %s'; // text 'Comment Page N'

    $wrap_before    = '<ol class="breadcrumb">'; // the opening wrapper tag
    $wrap_after     = '</ol><!-- .breadcrumbs -->'; // the closing wrapper tag
    $sep            = '<li class="breadcrumb-separator"> / </li>'; // separator between crumbs
    $before         = '<li class="breadcrumb-item active" aria-current="page"><span>'; // tag before the current crumb
    $after          = '</span></li>'; // tag after the current crumb

    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_current   = 1; // 1 - show current page title, 0 - don't show
    $show_last_sep  = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show
    /* === END OF OPTIONS === */

    global $post;
    $home_url       = home_url('/');
    $link           = '<li class="breadcrumb-item">';
    $link          .= '<a class="breadcrumb-link" href="%1$s" itemprop="item">%2$s</a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</li>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
}

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

//* Añadir un mensaje personalizado a la página de inicio de sesión de WordPress
function smallenvelop_login_message( $message ) {
    if ( empty($message) ){
        return '<h2 class="title">¡Bienvenid@ a Mundo Ferreycorp!</h2><p class="text">Ingresa a tu nueva intranet corporativa
        </p>';
    } else {
        return $message;
    }
}    
add_filter( 'login_message', 'smallenvelop_login_message' );

// elige un hook del archivo wp-login.php que mejor se adapte a nuestras necesidades. Yo elegí el filtro: wp_login_errors
add_filter( 'wp_login_errors', 'my_login_form_lock_down', 90, 2 );
/**
* Bloquear completamente el formulario de inicio de sesión de WordPress secuestrando la página 
* y sólo ejecutando el encabezado de inicio de sesión, el pie de página y las 
* etiquetas de cierre.
* 
* Proporcionar una forma secreta de mostrar el formulario de inicio de sesión como una variable url en 
* caso de emergencias.
*/
function my_login_form_lock_down( $errors, $redirect_to ){
    // acceder al formulario de inicio de sesión así:  http://example.com/wp-login.php?superadminform=true
    $secret_key = "superadminform";
    $secret_password = "true";

    if ( !isset( $_GET[ $secret_key ] ) || $_GET[ $secret_key ] != $secret_password ) {
        login_header(__('Log In'), '', $errors);
        echo "</div>";
        do_action( 'login_footer' );
        echo "</body></html>";
        exit;
    }  
    return $errors;
}

/*Rellenar acf select cuyo nombre es "seleccionar_roles" con los roles de los usuarios en ADMIN BACKEND*/
if ( !function_exists('populateUserRolesInAcfSelect') ):
 
    add_filter('acf/load_field/name=seleccionar_roles', 'populateUserRolesInAcfSelect');
    function populateUserRolesInAcfSelect( $field ){
 
        // reset choices
        $field['choices'] = array();
		$default['default_value'] = '';
         
        global $wp_roles;
        $roles = $wp_roles->get_names();
         
        foreach ($roles as $key => $role) :
            $field['choices'][ $key ] = $role;
        endforeach;

        return $field;
    }
 
endif;

//funcion permisos de contenido
function permissions_content($permisos_contenido){		
	$roles = isset($permisos_contenido['seleccionar_roles']) ? $permisos_contenido['seleccionar_roles'] : array();
	$allowed_roles = $roles;
	$user = wp_get_current_user();
	$user_actual = $user->roles;
	$permissions = 'false';
	switch ($permissions) {
		case (in_array("administrator", $user_actual) || in_array("editor", $user_actual)):
			$permissions = 'true';
			break;
		case (empty($allowed_roles)):
			$permissions = 'true';
			break;
		case (!empty($allowed_roles) && array_intersect($allowed_roles, $user_actual)):
			$permissions = 'true';
			break;
		default:
			return $permissions;
	}
	$value = $permissions;	
	return $value;
}