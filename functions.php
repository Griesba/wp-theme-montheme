<?php 


function montheme_supports () {
    add_theme_support ('title-tag');
    add_theme_support('post-thumbnails'); // activation des images titre sur une card
    add_theme_support('menus'); // activation de la bar de menus 
    register_nav_menu('header', 'En tête de menu'); 
    register_nav_menu('footer', 'Pieds de page menu'); 
}

function monsite_register_assets() {
    wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', []); 
    wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'.date('YmdHis'), ['popper', 'jquery'], false, true);
    wp_register_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);    
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_script( 'bootstrap');
}


function montheme_title ($title) {
    return 'Salut ' . $title;
}

function montheme_title_separator() {
    return '|';
}

function montheme_document_title_parts($title) {
    $title['demo'] = 'salut';
    return $title;
}

function mon_theme_menu_class($classes) {
    // on peut faire un var_dump dans un premier temps pour voir les différents parametre du filtre
    $classes[] = 'nav-item';
    return $classes;
}

function mon_menu_link_class ($attrs) {
    $attrs['class'] = 'nav-link';
    return $attrs;
}

// utilisation des hooks:  add_action et add_filters (ce sont des pipe)
add_action('after_setup_theme', 'montheme_supports');
// Register style sheet and scripts: bootstrap in this case
add_action( 'wp_enqueue_scripts', 'monsite_register_assets' );
add_filter( 'wp_title', 'montheme_title');
add_filter( 'document_title_separator', 'montheme_title_separator');
add_filter('document_title_parts', 'montheme_document_title_parts');
add_filter('nav_menu_css_class', 'mon_theme_menu_class');
add_filter('nav_menu_link_attributes', 'mon_menu_link_class');

?>

