<?php 
get_header(); 
  if(have_posts()) {
    while(have_posts()) {
      the_post();
      get_template_part('template-part/genre/content','singlepost');
    }
  }
  get_template_part('template-part/genre/content','related'); 
get_footer();
?>