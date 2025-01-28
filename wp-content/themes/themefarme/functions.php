<?php
	
	function farme_wp_styles(){
		wp_enqueue_style('style_css',get_stylesheet_uri());
		wp_enqueue_style('style_original_css',get_stylesheet_directory_uri().'/css/style.css');

		wp_enqueue_script('jquery_js',get_template_directory_uri().'/js/jquery.js','',true);
		wp_enqueue_script('wp_functions_js',get_template_directory_uri().'/js/functions.js','',true);
	}

	add_action('wp_enqueue_scripts','farme_wp_styles');

	add_theme_support('title-tag');
	add_theme_support( 'post-thumbnails' );

?>