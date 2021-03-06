<section class="posts-filter">
<?php 
$postsperpage = 4;
$args = array('post_type' => 'genres', 'posts_per_page' => $postsperpage);
$myQuery = new WP_Query($args);
if($myQuery->have_posts()) {
  while($myQuery->have_posts()) {
    $myQuery->the_post(); 
    $title= get_the_title();
    $excerpt = get_the_excerpt('');
    $date = get_the_date();
    $featuredImage = get_the_post_thumbnail($page->ID, 'thumbnail', array( 'class' => 'featured-image' ) ); 
    $readbtn = get_field('read_more');
    $detailslink = get_the_permalink(); ?>
    
    <?php if ($title && $excerpt && $featuredImage) { ?>
      <div class="wrapper">
        <figure>
          <?php echo $featuredImage; ?>
        </figure>
        <h1><a href="<?php echo $detailslink; ?>"><?php echo $title; ?></a></h1>
        <span class="date"><strong><?php echo $date; ?></strong></span>
        <p><?php echo $excerpt; ?></p>
        <?php if($readbtn) { ?>
          <a href="<?php echo $detailslink; ?>"><?php echo $readbtn; ?></a>
        <?php } ?>
      </div>
    <?php } 
  }
  wp_reset_query();
}
$load = get_field('cta_buttons');
foreach ($load as $bt ) {
  $btn = $bt['button'];
  echo $btn ? '<div class="wrapper"><a href="#FIXME" class="load">'.$btn.'</a></div>' : null;

}
?>
</section>