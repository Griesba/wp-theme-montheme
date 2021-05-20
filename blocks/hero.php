<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package montheme
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function hero_block_init()
{
    // Skip block registration if Gutenberg is not enabled/merged.
    if (!function_exists('register_block_type')) {
        return;
    }
    $dir = get_stylesheet_directory() . '/blocks';

    $index_js = 'hero/index.js';
    wp_register_script(
        'hero-block-editor',
        get_stylesheet_directory_uri() . "/blocks/$index_js",
        [
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-components',
            'wp-editor'
        ],
        filemtime("$dir/$index_js")
    );

    $editor_css = 'hero/editor.css';
    wp_register_style(
        'hero-block-editor',
        get_stylesheet_directory_uri() . "/blocks/$editor_css",
        [],
        filemtime("$dir/$editor_css")
    );

    $style_css = 'hero/style.css';
    wp_register_style(
        'hero-block',
        get_stylesheet_directory_uri() . "/blocks/$style_css",
        [],
        filemtime("$dir/$style_css")
    );

    register_block_type('montheme/hero', [
        'editor_script'   => 'hero-block-editor',
        'editor_style'    => 'hero-block-editor',
        'style'           => 'hero-block',
        'attributes'      => [
            'content'  => ['type' => 'string'],
            'title'    => ['type' => 'string'],
            'color'    => ['type' => 'string', 'default' => '#000'],
            'mediaID'  => ['type' => 'string'],
            'mediaURL' => ['type' => 'string'],
        ],
        'render_callback' => 'hero_block_render'
    ]);
}

function hero_block_render(array $attributes)
{
    return <<<HTML
    <div class="wp-block-montheme-hero" style="color:{$attributes['color']}; background-image:url({$attributes['mediaURL']})">
    <div class="container">
    
    <h2>{$attributes['title']}</h2>
    {$attributes['content']}
</div>
</div>
HTML;

}

add_action('init', 'hero_block_init');
