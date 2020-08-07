<?php get_header(); ?>
<main>
<?php if(have_posts()) {
    while(have_posts()) {
      the_post(); ?>
        <div class="wrapper">
          <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <?php echo get_the_excerpt(); ?>
        </div>
        <?php
    }  
} ?>
<?php get_footer(); ?>