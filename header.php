<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>  
</head>
<body>

<div id="mySidebar" class="sidebar">
  <div class="row">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <div class="container">
    <?=  get_search_form(); ?>
    </div>    
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<?php 
  $attachment_url = ABSPATH.'wp_content/uploads/2021/05/fakeLogoAdd.png';
  $attachement_id = attachment_url_to_postid($attachment_url);
  
?> 
  <img src="<?= get_site_url()?>/wp-content/uploads/2021/05/fakeLogoAdd-e1619951340157.png"  class="d-inline-block align-top" >


  <div id="main">
    <button class="openbtn" id="openNavBtn"><i class="fa fa-search" style="font-size:24px"></i></button>  
  </div>
  
  <!-- Brand and toggle button -->    
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
    <!-- End -->

</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">


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
echo do_shortcode('[smartslider3 slider="2"]');
?>

<div class="container">
    
