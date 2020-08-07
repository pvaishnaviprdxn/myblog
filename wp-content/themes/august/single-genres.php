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
  $featured_posts = get_field('related_posts');
  $title = get_field('title');
  if( $featured_posts && $title ) { ?>
    <section class="realted-posts">
      <div class="wrapper">
        <h2><?php echo $title; ?></h2>
        <ul>
          <?php foreach( $featured_posts as $featured_post ) {
              $permalink = get_permalink( $featured_post->ID );
              $title = get_the_title( $featured_post->ID );
              $custom_field = get_field( 'content', $featured_post->ID );
              $excerpt = get_the_excerpt($featured_post->ID);
              ?>
              <li>
                  <h3><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
                  <?php echo $excerpt ? '<p>'.$excerpt.'</p>' : null; ?>
              </li>
          <?php } ?>
        </ul>
      </div>
    </section>
  <?php }

get_footer();
?>