</div>
<footer>

<?php wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
        ]);
/*         the_widget(
                YoutubeWidget::class, 
                ['title' => 'Widget avec titre', 'youtube' => 'BZN8INa0aPY'], 
                ['before_widget' => '', 'after_widget' => '']
        );
        the_widget(
                YoutubeWidget::class, 
                ['youtube' => 'BZN8INa0aPY'], 
                ['before_widget' => '', 'after_widget' => '']
        ); */
        ?> 
    
    
</footer>
<!-- <div class="row">
        <p><?= get_option('agence_horaire') ?></p>
  </div>   -->
<?php wp_footer() ?>
</body>
</html>