<?php 
add_action('wp_enqueue_scripts', function(){
    // wp_deregister_style('bootstrap'); ça c'est pour desactiver bootstrap
    wp_enqueue_style('montheme_style', get_stylesheet_uri());
}, 11); 

add_action('after_setup_theme', function () {
    load_child_theme_textdomain('montheme-enfant', get_stylesheet_directory() . '/languages');
});

add_filter('montheme_search_filter', function() {
    return 'Recherche: %s';
});