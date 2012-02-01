<?php
/**
 * 
 * Thematic hooks to modify parent theme.
 *
 *
 * @package onedayoneapp
 */


 
/**
 *
 * All custom Hooks
 *
 */
 

 add_action('init', 'remove_thematic_hooks');
 add_action('init', 'add_tags_to_types');
 add_action('thematic_header','add_custom_menus', 6);
 add_action('thematic_footer', 'custom_footer', 30);
 add_action('thematic_belowheader', 'add_slider_to_home', 1);
 add_action('thematic_belowheader', 'search_module', 2);
 add_action('thematic_belowheader', 'app_grid', 3);
 add_action('thematic_abovecontainer', 'singular_apps');
 add_action('wp_head', 'add_wake_up_call_header');
 add_action('thematic_belowpost', 'custom_contact_page');
 add_action('wp_head', 'handle_contact_form');
 add_action('thematic_abovecontent', 'archive_page_header');

 
 /**
 *
 * Removing things we don't want...
 *
 */
 
function remove_thematic_hooks(){
	remove_action('thematic_header', 'thematic_access', 9);
	remove_action('thematic_footer', 'thematic_siteinfo', 30);
}

/**
 *
 * Functions
 *
 */
 
function add_custom_menus(){
	echo '<div id="serious_menu">';
	wp_nav_menu(array(
		'menu' => 'content-driven'
	));
	
	include_once('includes/searchform.php');
	echo '</div>';
	
	echo '<div id="showcases">';
	wp_nav_menu(array(
		'menu' => 'showcases'
	));
	
	echo '</div>';
}

function custom_footer(){
	if(!is_singular_app() || !is_search() || !is_archive()){
		include_once('includes/footer.php');
	}
}

function add_slider_to_home(){
	if(is_app_home()) {
		include_once('includes/slider.php');
	}
}

function search_module(){
	if(is_page(4921)) {
	include('includes/search-module.php');
	}
}

function app_grid(){
	if(is_page('iPad') || is_front_page()) {
		include('includes/app-grid.php');
	}
}

function add_wake_up_call_header(){
	wake_up_call();
}

function singular_apps(){
	if(is_singular_app()){
		include_once('includes/slider.php');
	}
}

function custom_contact_page(){
	if(
		is_page(array(
			'contact-us',
			'contact',
			'Contact Us',
			'Contact',
			'submit',
			'Submit'
		))
	){
		include_once('includes/custom-contact-page.php');
	}
}

function handle_contact_form(){
		 do_the_contact_form();	
}

function add_tags_to_types(){
		add_tags_to_post_types();
}

function childtheme_override_search_loop(){
	include_once('includes/search-loop.php');
}

function archive_page_header(){
	include_once('includes/archive-header.php');
	include_once('includes/app-grid.php');
}

?>