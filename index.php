<?php get_header() ?>
<?php
echo do_shortcode('[smartslider3 slider="2"]');
?>

<div class="container">
<h1><?= esc_html(get_queried_object()->name) ?></h1>

<p>
	<?= esc_html(get_queried_object()->description) ?>
</p>

<?php $sports = get_terms(['taxonomy' => 'sport']) ?>
<ul class="nav nav-pills my-4">
    <?php foreach($sports as $sport) :?>
    <li class="nav-item">
        <a href="<?= get_term_link($sport)?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : ''?>"><?= $sport->name; ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php if (have_posts()) : ?>
    <div class="row">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-lg-4 col-md-4 col-xs-12 desc">
                <?php get_template_part('parts/card', 'post'); ?>
            </div>
        <?php endwhile ?>
    </div>
    <?= montheme_pagination() ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>

<?php get_footer() ?>