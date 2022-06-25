<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

// END ENQUEUE PARENT ACTION

/***** add js and css in theme *****/
add_action('wp_enqueue_scripts', 'wp_script_fix');
function wp_script_fix()
{   

    wp_enqueue_style('bootstrap',get_stylesheet_directory_uri().'/css/bootstrap.min.css');
     wp_enqueue_style('custom',get_stylesheet_directory_uri().'/custom.css');  
    wp_enqueue_style('style', get_stylesheet_uri()); 
    wp_enqueue_style('parent-style', get_template_directory_uri().'style.css'); 

    wp_enqueue_script('bootstrap-js',get_stylesheet_directory_uri().'/js/bootstrap.min.js',array(),null,false);
    wp_enqueue_script('gtag-js','https://www.googletagmanager.com/gtag/js?id=UA-102093661-1',array(),null,true);

}