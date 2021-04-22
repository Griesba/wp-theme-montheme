<?php
add_action('customize_register', function (WP_Customize_Manager $manager) {

    $manager->add_section('montheme_apparence', [
        'title' => 'Personnalisation de l\'apparence',
    ]);

    $manager->add_setting('header_background', [
        'default' => '#FF0000',
        'transport' => 'postMessage', // la fonction qui nous permet de passer le msg au JS pour faire le LIVE preview et isoler le changement de config sans rafraichir toute la page.
        'sanitize_callback' => 'sanitize_hex_color' 
    ]);

    $manager->add_control(new WP_Customize_Color_Control($manager, 'header_background', [
        'section' => 'montheme_apparence',
        'label' => 'Couleur de l\'en tête'
    ]));

});

add_action('customize_preview_init', function () {
    wp_enqueue_script('montheme_apparence', get_template_directory_uri() . '/assets/apparence.js', ['jquery', 'customize-preview'], '', true);
});