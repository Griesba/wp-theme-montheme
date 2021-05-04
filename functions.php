<?php


require_once('walker/CommentWalker.php'); // le walker pour les commentaires
require_once('options/apparence.php'); // manipulation de l'API customize (https://developer.wordpress.org/themes/customize-api/customizer-objects/)
require_once('wp_bootstrap_navwalker.php'); // for responsive hamburger menu


function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // activation des images titre sur une card
    add_theme_support('menus'); // activation de la bar de menus 
    // add_theme_support('html5'); active le html5 si c'est supporté
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
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    if (!is_customize_preview()) {
//si je ne suis pas en train de changer d'apparence dans l'admin on charge juste le min css 
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', [], false, true);
        wp_enqueue_script('main-js', get_template_directory_uri() .'/assets/js.js', array('jquery'));      
    }
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');    
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,300;1,400&display=swap', []);
    wp_enqueue_style('ruda', 'https://fonts.googleapis.com/css?family=Ruda:400,900,700', []);
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri().'/assets/lib/font-awesome/css/font-awesome.min.css', []);
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
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
      }
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
require_once('options/agence.php');
require_once('metaboxes/sliderImgUrl.php');

SponsoMetaBox::register();
AgenceMenuPage::register();
CarouselSlidImgUrl::register();

add_filter('manage_posts_columns', function($columns){
    // var_dump($columns);
    /*return [
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'author' => $columns['author'],
        'categories' => $columns['categories'],
        'tags' => $columns['tags'],
        'taxonomy-sport' => $columns['taxonomy-sport'],
        'comments' => $columns['comments'],
        'date' => $columns['date'],
        'sponsored' => 'Sponsored'
    ]; */
    $newColumns = [];
    foreach($columns as $k => $v) {
        if($k === 'date') {
            $newColumns['sponsored'] = 'Sponsored post';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
       
});


add_filter('manage_bien_posts_columns', function($column){
    // var_dump($column); die(); pour voire les parametres
    return [
        'cb' => $column['cb'],
        'thumbnail' => 'Miniature',
        'title' => $column['title'],
        'date' => $column['date']
    ];
});


add_filter('manage_posts_custom_column', function($column, $post_id){
    if($column === 'sponsored') {
        if(!empty(get_post_meta($post_id, SponsoMetaBox::META_KEY, true))){
            $class = 'yes';
        } else {
            $class = 'no';    
        }
        echo '<div class="bullet bullet-'. $class.'" >';
    }
}, 10, 2);

add_filter('manage_bien_posts_custom_column', function($column, $postId){
    // faire var_dump(func_get_args()); die(); pour voir les params ou chercher manage_post_custom_column dans la docu
    if($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);


add_action('admin_enqueue_scripts', function(){
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});

/**
 * @param WP_Query $query
 */
function montheme_pre_get_posts ($query) {
    if(is_admin() || !is_search() || !$query->is_main_query()) {
        return; // on ne veut pas de modif quand on est dans la page d'admin, de non-recherche et de non-principale
    }
    if(get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS'
        ];
        $query->set('meta_query', $meta_query);
    }
}

function montheme_query_vars ($params) {
    
    $params[] = 'sponso'; // ici on ajoute 'sponso' dans la WP_query
    return $params;
}

add_action('pre_get_posts', 'montheme_pre_get_posts');
add_filter('query_vars', 'montheme_query_vars');

require_once 'widgets/YoutubeWidget.php';

// les fonctions de l'i8n: __, _e, _n
function montheme_register_widget() {
    register_widget(YoutubeWidget::class);
    register_sidebar([
        'id' => 'homepage',
        'name' => __('Sidebar Accueil', 'montheme'),
        'before_widget' => '<div class="p-4 %2$s" id="%1$s"',
        'after_widget' => '</div>',
        'before_title' => ' <h4 class="fst-italic">',
        'after_title' => '</h4>'
    ]);
};

add_action('widgets_init', 'montheme_register_widget');

add_filter('comment_form_default_fields', function($fields){
    $fields['email'] = <<<HTML
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" name="email" id="email" required>
    </div>
HTML;     
    return $fields;
});

add_action('after_setup_theme', function () {
    load_theme_textdomain('montheme', get_template_directory() . '/languages');
});

function showMessageToAdmin() {
    include_once(ABSPATH. 'wp-admin/includes/plugin.php');

    if(!is_plugin_active('smart-slider-3/smart-slider-3.php')){
        ?>
        <div id="alert" class="error">
            <p>This theme require you to install <a href="https://www.competethemes.com/blog/best-wordpress-slider-plugins/">smart slider 3</a> </p>
        </div>
        <?php
    }
}

// Alert message when slider plugin not intalled
add_action('admin_notices', 'showMessageToAdmin');

/*Navigation Menus*/
/* function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' ); */
/*End*/

?>