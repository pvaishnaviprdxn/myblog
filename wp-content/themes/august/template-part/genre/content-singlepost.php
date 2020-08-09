<?php 
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

?>