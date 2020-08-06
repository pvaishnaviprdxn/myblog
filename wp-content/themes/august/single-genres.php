<?php 
get_header(); 
  if(have_posts()) {
    while(have_posts()) {
      the_post();
      $title = get_the_title();
      $content = get_field('content');
      $featuredImage = get_the_post_thumbnail($page->ID, 'thumbnail', array( 'class' => 'featured-image' ) );
      $date = get_the_date(); 
      ?>
      <?php if($title && $content) { ?>
        <div class="wrapper">
          <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <?php if ($date) { ?>
            <span class="date"><strong><?php echo $date; ?></strong></span> 
          <?php } ?>
          <?php echo $content; ?>
          <?php if($featuredImage) { ?>
            <figure><?php echo $featuredImage; ?></figure>
          <?php } ?>
        </div>
        <?php
      }
    }
  }
  /*$tags = wp_get_post_tags($post->ID);
  //echo "<pre>".print_r($tags)."</pre>"; 
  if ($tags) {
    echo 'Related Posts';
    $first_tag = $tags[0]->term_id;
    $args = array (
      'tag__in' => array($first_tag),
      'post__not_in' => array($post->ID),
      'posts_per_page'=>1,
      'caller_get_posts'=>1
    );
    $query = new WP_Query($args);
    if( $query->have_posts() ) {
      while ($query->have_posts()) {
        $query->the_post(); ?>
        <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
      <?php }
    } 
  }*/

get_footer();
?>