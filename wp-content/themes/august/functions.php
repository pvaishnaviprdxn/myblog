<?php 
  function addStyles() {
      wp_enqueue_style('theme-style',get_stylesheet_uri(),array(),1.0);
  }
  add_action('wp_enqueue_scripts','addStyles');
  //editor change
  add_filter('use_block_editor_for_post', '__return_false');
  //nav menus
  register_nav_menus(
    array(
    'primary' => __('Primary Menu'),
    'social' => __('Social Links Menu'),
    'footer' => __('Footer Menu')
  ));

  function custom_post_genre() {
    $labels = array (
      'name' => _x('Genres','Post Type General Name', 'august'),
      'singular_name' => _x('Genre','Post Type General Name', 'august'),
      'menu_name' => __('Genres', 'august'),
      'parent_item_colon' => __( 'Parent Genres', 'august' ),
      'all_items'           => __( 'Genres', 'august' ),
      'view_item'           => __( 'View Genre', 'august' ),
      'add_new_item'        => __( 'Add New Genre', 'august' ),
      'add_new'             => __( 'Add New Genre', 'august' ),
      'edit_item'           => __( 'Edit Genre', 'august' ),
      'update_item'         => __( 'Update Genre', 'august' ),
      'search_items'        => __( 'Search Genre', 'august' ),
      'not_found'           => __( 'Not Found', 'august' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'august' ),
    );
    $args = array (
      'label' => __('Genres', 'august'),
      'description' => __('Genre Details','august'),
      'labels' => $labels,
      // Features this CPT supports in Post Editor
      'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
      'taxonomies' => array('post_tag','category' ),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-info',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
      'show_in_rest' => true,
    );
    register_post_type( 'genres', $args );
  }
  add_action('init','custom_post_genre',0);

  function clean_custom_menus() {
    $menu_name = 'primary'; // specifing custom menu slug
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
      $menu = wp_get_nav_menu_object($locations[$menu_name]);
      $menu_items = wp_get_nav_menu_items($menu->term_id);

      $menu_list = '<nav>' ."\n";
      $menu_list .= "\t\t\t\t". '<ul>' ."\n";
      foreach ((array) $menu_items as $key => $menu_item) {
          $title = $menu_item->title;
          $url = $menu_item->url;
          $menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
      }
      $menu_list .= "\t\t\t\t". '</ul>' ."\n";
      $menu_list .= "\t\t\t". '</nav>' ."\n";
    } 
    echo $menu_list;
  }

  //option for featured images
  add_theme_support('post-thumbnails');


  function categories_script() {
    wp_enqueue_script('ajax', get_template_directory_uri().'/assets/js/script.js',array('jquery'),NULL,true); 
    wp_localize_script( 'ajax', 'wpAjax', array( 'ajaxUrl' => admin_url('admin-ajax.php')));
  }
  add_action('wp_enqueue_scripts', 'categories_script');

  //dropdown functionality
  function filterAjax() {
    $category = $_POST['category'];
    $args_post = array(
      'post_type' => 'genres',
      'posts_per_page' => '-1',
    );

    if(isset($category)) {
      $args_post['category__in'] = array($category);
    }

    $query = new WP_Query($args_post);
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post(); 
        $title= get_the_title();
        $excerpt = get_the_excerpt();
        $date = get_the_date();
        $featuredImage = get_the_post_thumbnail($page->ID, 'thumbnail', array( 'class' => 'featured-image' ) ); 
        $readbtn = get_field('read_more');
        $detailslink = get_the_permalink($post->ID);
        ?>

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
  }
  add_action('wp_ajax_nopriv_filter','filterAjax');
  add_action('wp_ajax_filter','filterAjax');
  //excerpt length
  //function custom_excerpt_length( $length ) {
	//  return 20;
  //}
  //add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  //load more

  
function more_post_ajax() {

  $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
  $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

  //header("Content-Type: text/html");

  $args = array(
      'suppress_filters' => true,
      'post_type' => 'genres',
      'posts_per_page' => $ppp,
      'paged'    => $page,
  );

  $loop = new WP_Query($args);

  if ($loop->have_posts()) {
    while ($loop->have_posts()) {
      $loop->the_post();
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
  } ?>
  <?php wp_reset_postdata();
  die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
  
?>