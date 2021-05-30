<a class="b-link-fade b-animate-go" href="<?php the_permalink() ?>">

  <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'width: 350px; height: auto;']) ?>
  <div class="b-wrapper">
    <h4 class="b-from-left b-animate b-delay03" style="margin-top: 79px;"><?= the_title() ?></h4>
    <p class="b-from-right b-animate b-delay03">Read More.</p>
  </div>
</a>
<p><?php the_title() ?></p>
<div class="lead">
  <?php the_excerpt(); ?>
  
</div>
<span class="news__action"><a href="<?php the_permalink() ?>">Read more <?= montheme_icon('arrow') ?></a></span>
<hr-d>
  <div class="time"><i class="fa fa-comment-o"></i> 3 | <i class="fa fa-calendar"></i> 14 Nov.</div>
</hr-d>