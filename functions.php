<?php


function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // activation des images titre sur une card
    add_theme_support('menus'); // activation de la bar de menus 
    register_nav_menu('header', 'En tête de menu');
    register_nav_menu('footer', 'Pieds de page menu');

    // support d'image pour le header des cards. Attention wordpress n'agrandit pas les images si elles sont petites
    add_image_size('post-thumbnail', 350, 215, true);
    /**
     * pour changer les dimentions d'un format d'image fournit par wordpress
     * remove_image_size('medium');
     * add_image_size('medium', 500, 500);
     */
}

function monsite_register_assets()
{
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' . date('YmdHis'), ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}


function montheme_title($title)
{
    return 'Salut ' . $title;
}

function montheme_title_separator()
{
    return '|';
}

function montheme_document_title_parts($title)
{
    $title['demo'] = 'salut';
    return $title;
}

function mon_theme_menu_class($classes)
{
    // on peut faire un var_dump dans un premier temps pour voir les différents parametre du filtre
    $classes[] = 'nav-item';
    return $classes;
}

function mon_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === NULL) {
        return;
    }
    echo '<nav arial-lavel="Pagination" class="my-4">';
    echo '<ul class="pagination"';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false; // on cherche la class wordpress <current> elle est presente quand la page est active
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page); // on remplace la classe wordpress page-numbers par la classes  bootstrap page-link 
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function montheme_init() {
	register_taxonomy(
        'sport', // n'utilisez pas les mots reservés de wordpress
        'post', [ 
		'labels' => [
			'name' => 'Sport',
			'singular_name' => 'Sport',
			'search_items' => 'Recherche des sports',
			'all_items' => 'Tous les sports',
			'edit_item' => 'Editer le sport',
			'update_item' => 'Mettre à jour le sport',
			'add_new_item' => 'Ajouter un nouveau sprot',
			'new_item_name' => 'Ajouter un nouveau sport',
			'menu_name' => 'Sport'
		],
		'show_in_rest' => true, // pour le rendre visible dans wordpress
		'hierarchical' => true,
		'show_admin_column' => true,
	]);

    // enregistrer les posts de type bien: voir la docu pour plus d'info
    register_post_type('bien', [
		'label' => 'Bien immo',
		'public' => true,
		'menu_positon' => 3,
		'menu_icon' => 'dashicons-building', // pour avoir les icons wordpress cherchez Dashicons wordpress dans google
		'supports' => ['title', 'editor', 'thumbnail'],
		'show_in_rest' => true,
		'has_archive' => true,
	]);
}

add_action('init', 'montheme_init'); // les taxonomy ne doivent pas s'enregistrer avant init
// utilisation des hooks:  add_action et add_filters (ce sont des pipe)
add_action('after_setup_theme', 'montheme_supports');
// Register style sheet and scripts: bootstrap in this case
add_action('wp_enqueue_scripts', 'monsite_register_assets');
add_filter('wp_title', 'montheme_title');
add_filter('document_title_separator', 'montheme_title_separator');
add_filter('document_title_parts', 'montheme_document_title_parts');
add_filter('nav_menu_css_class', 'mon_theme_menu_class');
add_filter('nav_menu_link_attributes', 'mon_menu_link_class');


require_once('metaboxes/sponso.php');

SponsoMetaBox::register();
?>