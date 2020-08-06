<?php 
/* 
Template Name:Genres
*/
get_header();

$cat_args = array(
    'exclude' => array(1),
    'option_All' => 'All',
);
$categories = get_categories($cat_args); ?>
<section class="categories-dropdown">
  <div class="wrapper">
    <select id="genre-category">
      <option class="genres" value="All">All</option>
      <?php 
        foreach($categories as $cat) { ?>
          <option class="genres" value="<?php echo $cat->term_id; ?>"><?php echo $cat->name;?></option>
        <?php }
      ?>
    </select>
  </div>
</section>

<section class="posts-filter">
<?php $args = array('post_type' => 'genres', 'posts_per_page' => '-1');
$myQuery = new WP_Query($args);
if($myQuery->have_posts()) {
  while($myQuery->have_posts()) {
    $myQuery->the_post(); 
    $title= get_the_title();
    $excerpt = get_the_excerpt();
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
}
?>
</section>
<?php get_footer(); ?>