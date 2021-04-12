<?php get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>

        <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1') : ?>
            <div class='alert alert-info'>
                Cet article est sponsorisé
            </div>
        <?php endif ?>

        <p>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: auto">
        </p>
        <?php the_content() ?>

<?php 
    if(comments_open() || get_comments_number()) {
        comments_template();
    }
?>

        <h2>Articles relatifs</h2>
        <div class="row">
            <?php
            $sports = array_map(function ($term) { // tous les articles avec la toxonomy sport
                return $term->term_id;
            }, get_the_terms(get_post(), 'sport'));

            $query = new WP_Query([
                'post_not_in' => [get_the_ID()], // on ne veux pas l'ID de l'article courant
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'rand', // random order
                'tax_query' => [
                    [
                        'taxonomy' => 'sport',
                        'terms' => $sports
                    ]
                ],
                'meta_query' => [
                    [
                        'key' => SponsoMetaBox::META_KEY,
                        'compare' => 'EXISTS' // les article qui ont la clé SponsoMetaBox::META_KEY (sponsorisé)
                    ]
                ]

            ]);
            while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-sm-4">
                    <?php get_template_part('parts/card', 'post'); ?>
                </div>
            <?php endwhile;
            // important pour reinitialiser la variable global post 
            // pour éviter le problème de conflit de donnée avec les boucles imbréquées
            wp_reset_postdata();
            ?>
        </div>

<?php endwhile;
endif; ?>


<?php get_footer() ?>