<?php 
$cat_args = array(
  'exclude' => array(1),
  'option_All' => 'All',
);
$categories = get_categories($cat_args); 
$term_link = get_term_link( $categories ); 
?>
<section class="categories-dropdown">
  <div class="wrapper">
    <select id="genre-category">
      <option class="genres">All</option>
      <?php 
        foreach($categories as $cat) { ?>
          <option class="genres" value="<?php echo $cat->term_id; ?>"><?php echo $cat->name;?></option>
        <?php }
      ?>
    </select>
  </div>
</section>