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
      $myQuery->the_post(); ?>
      <div class="wrapper">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php echo get_the_excerpt(); ?>
      </div>
  <?php }
}
?>
</section>
<?php get_footer(); ?>