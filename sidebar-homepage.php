
<?php if(!dynamic_sidebar('homepage')):      /** si dynamic_sidebar() est vide c'est le code suivant qui sera executé */ ?>
    
    <div class="p-4">
        <h4 class="fst-italic">Search</h4>
            <?php get_search_form(); ?>
      </div>

    <div class="p-4">
        <h4 class="fst-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
            <?php wp_get_archives(['type' => 'monthly']); ?>
        </ol>
      </div>

<?php endif; ?>
