<?php get_header() ?>


<form>
  <div class="form-row align-items-center">
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInput"></label>
      <input type="search" class="form-control mb-2" name="s" id="inlineFormInput" value="<?= get_search_query() ?>" placeholder="Votre recherche">
    </div>

    <div class="col-auto">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="autoSizingCheck" value="1" name="sponso" <?= checked('1', get_query_var('sponso')) ?>>
        <label class="form-check-label" for="autoSizingCheck">
          Sponsored posts
        </label>
      </div>
    </div> 
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Search</button>
    </div>
  </div>
</form>

<h1 class="mb-4"><?= sprintf(apply_filters('montheme_search_filter', "Résultat de vos recherche \"%s\""), get_search_query()) ?> </h1>

<?php if (have_posts()) : ?>
    <div class="row">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <?php get_template_part('parts/card', 'post'); ?>
            </div>
        <?php endwhile ?>
    </div>
    <?= montheme_pagination() ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>

<?php get_footer() ?>