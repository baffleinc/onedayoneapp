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
 add_action('thematic_belowheader', 'app_grid', 3);
 add_action('thematic_abovecontainer', 'singular_apps');
 add_action('wp_head', 'add_wake_up_call_header');
 add_action('thematic_belowpost', 'custom_contact_page');
 add_action('wp_head', 'handle_contact_form');
 add_action('thematic_abovecontent', 'archive_page_header');
 add_action('wp_head', 'ie7js');
 add_action('thematic_belowheader', 'search_thing');
 add_action('thematic_belowcontainer', 'jobs_sidebar');
 add_action('thematic_belowheader', 'jobs_header');
 add_action('thematic_abovecontent', 'jobs_content_header');

 
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

function app_grid(){
	if(is_app_home()) {
		include('includes/search-module.php');
		include('includes/home-grid.php');
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
	$taxes = array();
	$types = array('iphone-app', 'ipad-app', 'mac-app');
	foreach($types as $type){
		$taxes[] = $type.'-category';
		$taxes[] = $type.'-tags';
	}
	if(is_post_type_archive($types) || is_tax()){
		include_once('includes/archive-header.php');
		include_once('includes/app-grid.php');
	}
}

function ie7js(){
	echo '<!--[if lt IE 9]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->';
}

function search_thing(){
	if(is_search()){
		include_once('includes/search-head.php');
	}
}

function jobs_sidebar(){
	if(is_page(5461)){ ?>
		<aside id="jobs-bar" class="sidebar">
			<ul>
				<?php dynamic_sidebar('jobsbar'); ?>
			</ul>
		</aside>
	<?php }
}

function jobs_header(){
	if(is_page(5461)){
		include_once('includes/jobs-header.php'); 
	}
}

function jobs_content_header(){
	if(is_page(5461)){
		include_once('includes/jobs-content-header.php'); 
	}
}

 ?>