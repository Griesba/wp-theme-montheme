        <a class="b-link-fade b-animate-go" href="<?php the_permalink() ?>">
          
          <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'width: 350px; height: auto;']) ?>
					<div class="b-wrapper">
              <h4 class="b-from-left b-animate b-delay03"><?= the_title() ?></h4>  
					  	<p class="b-from-right b-animate b-delay03">Read More.</p>
					</div>
				</a>
        <p><?php the_title() ?></p>
        <p class="lead"><?= get_the_excerpt() ?></p>
        <hr-d>
          <p class="time"><i class="fa fa-comment-o"></i> 3 | <i class="fa fa-calendar"></i> 14 Nov.</p>
    