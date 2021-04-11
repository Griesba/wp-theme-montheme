</div>
<footer>

<?php wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
        ])?> 
    
</footer>
<div class="row">
        <p><?= get_option('agence_horaire') ?></p>
  </div>  
<?php wp_footer() ?>
</body>
</html>