<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>  
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand and toggle button -->
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- End -->
    <!-- Your website Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
             wp_nav_menu( array(
             'menu'              => 'primary',
             'theme_location'    => 'header',
             'depth'             => 2,
             'container'         => 'div',
             'container_class'   => 'col-md-6 ml-auto',
             'container_id'      => '',
             'menu_class'        => 'navbar-nav mr-auto my-navbar-nav',
             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
             'walker'            => new wp_bootstrap_navwalker())
             );
        ?>
    </div>
    <!-- End -->
</nav>

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <a class="navbar-brand" href="#"><?php bloginfo('name') ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <?php wp_nav_menu([
        'theme_location' => 'header', // header c'est le nom qu'on a donné a notre menu dans register_nav_menu 
        'menu'              => 'primary',
        'depth'             => 2,
        'container'         => false,
        'container_class'   => '',
        'container_id'      => '',
        'menu_class'        => 'navbar-nav mr-auto',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker()
        ])?>  -->
    
    <!--<ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <?=  get_search_form(); ?>
 -->
    
  </div>
</nav>


<?php 
if(is_home() || is_front_page()) {
  echo do_shortcode('[metaslider id="164"]');
}
 ?>

<div class="container">
    
