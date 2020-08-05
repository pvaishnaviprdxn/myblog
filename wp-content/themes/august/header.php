<!doctype html>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="container">
      <header>
        <div class="wrapper">
          <h1><?php echo bloginfo('name'); ?></h1>
          <?php 
            $args = array('theme_location' => 'primary');
          ?>
          <?php clean_custom_menus(); ?>
        </div>
      </header>