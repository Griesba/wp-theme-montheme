<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>

<div class="container">
    <header class="montheme-header">
      <div>
        <h1 class="montheme__title"><?php the_title(); ?></h1>
 <!--        <div class="montheme__meta">
          <div class="montheme__location"><?php montheme_city() ?></div>
          <div class="montheme__price"><?php montheme_price() ?></div>
          <div class="montheme__price"><?php montheme_training_date() ?></div>          
        </div>
        <div class="montheme__actions" id="montheme-actions">
          <button class="btn btn-filled" id="montheme-contact">Contacter l'agence</button>
          <button class="btn">Appeler</button>
        </div>

        <div class="hidden" id="montheme-form">
          <?= do_shortcode('[contact-form-7 id="101" title="" html_class="montheme__form form-2column"]'); ?>
        </div> -->

      </div>
      <div>
        <div class="montheme__photos js-slider">
          <?php foreach(get_attached_media('image', get_post()) as $image): ?>
            <a href="<?= wp_get_attachment_url($image->ID) ?>">
              <img class="montheme__photo" src="<?= wp_get_attachment_image_url($image->ID, 'property-carousel'); ?>" alt="">
            </a>
          <?php endforeach ?>
        </div>
      </div>
    </header>




    <div class="montheme-body">
      <h2 class="montheme-body__title"><?= __('Description', 'montheme'); ?></h2>
      <div class="formatted">
        <?php the_content(); ?>
      </div>
    </div>

    <section class="montheme-options">
      <div class="montheme-option">
        <img src="<?= get_template_directory_uri() ?>/assets/area.78237e19.svg" alt="">
        <?= __('Location', 'montheme') ?>: <?php montheme_city() ?>
      </div>
      <div class="montheme-option">
        <img src="<?= get_template_directory_uri() ?>/assets/rooms.b02e3d15.svg" alt="">
        <?= __('Price', 'montheme') ?>: <?php montheme_price(); ?>
      </div>
      <div class="montheme-option">
        <img src="<?= get_template_directory_uri() ?>/assets/elevator.e0bdbd67.svg" alt="">
         <?= __('Date', 'montheme') ?>: <?php montheme_training_date() ?>
      </div>
      <?php $options = get_the_terms(get_post(), 'property_option'); ?>
      <?php foreach($options as $option): ?>
      <div class="montheme-option"><img src="<?= the_field('icon', $option); ?>" alt="">
      <?= $option->name; ?>
    </div>
      <?php endforeach; ?>
    </section>

  </div>
<?php endwhile; ?>
<?php get_footer(); ?>
