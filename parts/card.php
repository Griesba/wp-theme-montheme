<div class="card" style="width: 18rem;">
    <!-- on change de format d'imamge de medium à post-thumbnails, les taille changent -->
    <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']) ?>
    <div class="card-body">
        <h5 class="card-title"><?php the_title() ?></h5>        
        
        <p class="card-text">
            <?php the_excerpt() ?>
        </p>
        
        <a href="<?php the_permalink() ?>">Voir plus</a>
        <hr-d>
        <div class="time-block">
        <span class="time" style="margin-left: 15px;"><i class="fa fa-comment-o"></i> 3 | <i class="fa fa-calendar"></i> 14 Nov.</span>    
        <span class="card-subtitle mb-2 text-muted category" style="margin: 0px;" ><?php the_category() ?></span>            
        </div>       
    </div>
</div>