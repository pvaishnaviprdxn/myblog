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
?>