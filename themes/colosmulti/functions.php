<?php

function colos_files() {
    wp_enqueue_style( 'animation', get_theme_file_uri( '/style/ladi_animation.css' ), array(), '4.1.3' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/jquery.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'view-port', get_theme_file_uri( '/js/main.js' ),null,'1.0', true);
    wp_register_style( 'colos_main_styles', get_stylesheet_uri() );
    wp_enqueue_style( 'colos_main_styles');
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:bold,regular|Open Sans:bold,regular&display=swap' );
  
}

add_action('wp_enqueue_scripts', 'colos_files');

/* carousel */

function colos_carousel() {
    wp_enqueue_style( 'carousel-file-1', get_template_directory_uri() . '/owlcarousel/assets/owl.carousel.min.css',false,'1.1','all');
    wp_enqueue_style( 'carousel-flie-2', get_template_directory_uri() . '/owlcarousel/assets/owl.theme.default.min.css',false,'1.1','all');
    wp_enqueue_script( 'carousel-file-3', get_template_directory_uri() . '/owlcarousel/owl.carousel.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'carousel-file-4', get_template_directory_uri() . '/jquery.min.js', array ( 'jquery' ), 1.1, true);
}
add_action('wp_enqueue_scripts', 'colos_carousel');




