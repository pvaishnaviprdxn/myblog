<?php 
get_header(); 
if(have_posts()) {
    while(have_posts()) {
      the_post(); ?>
        <div class="wrapper">
          <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <?php the_content(); ?>
        </div>
        <?php
    }  
}
get_footer();
?>