<?php

/**
 * Template Name: Page avec banniere
 * Template Post Type: page, post
 */
?>

<?php get_header() ?>

<?php
echo do_shortcode('[smartslider3 slider="2"]');
?>

<div class="container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1><?php the_title() ?></h1>
    <?php the_content() ?>
<?php endwhile;
endif; ?>
<?php get_footer() ?>