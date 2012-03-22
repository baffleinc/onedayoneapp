<?php

//let's be a fucking boss
require_once('hooks.php');
require_once('filters.php');
require_once('boss/boss.php');

add_theme_support( 'post-thumbnails' );
add_image_size( 'square_thumb', 300, 300, false );
set_post_thumbnail_size( 200, 200 );

wp_register_script(
	'jquery.tools',
	get_bloginfo('stylesheet_directory').'/js/jquery.tools.min.js',
	array('jquery'),
	'1.2.6',
	true
);

wp_register_script(
	'jquery.easing',
	get_bloginfo('stylesheet_directory').'/js/jquery.easing.js',
	array('jquery'),
	'0.1',
	true
);

wp_register_script(
	'jquery.validate',
	'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js',
	array('jQuery'),
	'1.9',
	true
);

wp_register_script(
	'jquery.placeholder',
	get_bloginfo('stylesheet_directory').'/js/jquery.placeholder.1.2.min.js',
	array('jquery'),
	'0.1',
	true
);

wp_register_script(
	'jquery.waitforimages',
	get_bloginfo('stylesheet_directory').'/js/jquery.waitforimages.js',
	array('jquery'),
	'0.1',
	true
);

wp_register_script(
	'jquery.onedayoneapp',
	get_bloginfo('stylesheet_directory').'/js/jquery.onedayoneapp.js',
	array('jquery', 'jquery.tools'),
	'0.1',
	true
);

wp_enqueue_script('jquery.tools');
wp_enqueue_script('jquery.easing');
wp_enqueue_script('jquery.validate');
wp_enqueue_script('jquery.placeholder');
wp_enqueue_script('jquery.waitforimages');
wp_enqueue_script('jquery.onedayoneapp');

function pr($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function array_empty($mixed) {
	if (is_array($mixed)) {
		foreach ($mixed as $value) {
			if (!array_empty($value)) {
				return false;
			}
		}
	}
	elseif (!empty($mixed)) {
		return false;
	}
	return true;
}

add_action('admin_print_styles', 'style_like_a_boss');

function style_like_a_boss(){
	echo '<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory').'/boss/admin.css" type="text/css" media="screen">';
}

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

register_nav_menus(array('Serious Menu'));

function wake_up_call(){
	if($_REQUEST['wake_up']['email']){
		$name = $_REQUEST['wake_up']['name'];
		$headers = "From: ".$_REQUEST['wake_up']['email'];
		$message = "
Hey, ".$name." has sent you a wakeup message from the depths of onedayoneapp.com. Reply to this email to get back to them.

".$_REQUEST['wake_up']['message']."			
			
		";
	
		$sent = mail(
			'narang.rohan@gmail.com',
			'New message from '.$name,
			$message,
			$headers
		);
	
		if($sent){
			boss_popup_message('Thanks for sending your message! We\'ll get back to you soon.');
		}
	}
}

function do_the_contact_form(){
	//pr($_REQUEST);
		$contact_type = $_REQUEST['contact_type'];
		
		
		//$fields = explode(', ', $fields);
		if($contact_type == 'app'){
			echo $_REQUEST['contact_vars']['category'];
			$post = array(
				'post_author' => 3, //The user ID number of the author.
				'post_content' => '<h2>App Category: '.$_REQUEST['contact_vars']['category'].'<h2>'.$_REQUEST['contact_vars']['contact_message'],
				'post_name' => sanitize_title($_REQUEST['contact_vars']['app_name']), // The name (slug) for your post
				'post_status' => 'pending', //Set the status of the new post. 
				'post_title' => $_REQUEST['contact_vars']['app_name'], //The title of your post.
				'post_type' => $_REQUEST['contact_vars']['app_type'],
			); 
			$type = $_REQUEST['contact_vars']['category'];
			wp_set_post_terms($post, $_REQUEST['contact_vars']['category'], $_REQUEST['contact_vars']['app_type'].'-app-category',false);
			 
			$success = wp_insert_post($post);
			$admin_email = 'narang.rohan@gmail.com';
			
			if($success){
				add_post_meta($success, 'price-of-app', $_REQUEST['contact_vars']['price']);
				add_post_meta($success, 'app-developer', $_REQUEST['contact_vars']['developer_name']);
				add_post_meta($success, 'app-developer-link', $_REQUEST['contact_vars']['developer_link']);
				add_post_meta($success, 'appstore-link', $_REQUEST['contact_vars']['app_store_link']);
				
				
				
		$message = 	'
Hey Dude!

'.$_REQUEST['contact_vars']['your_name'].' has submitted an iPad app to the website, so you should go check it out. It\'s currently in pending mode, so awaiting your confirmation and upload of screenshots. You should get to it.
'.get_edit_post_link($success).'
Here\'s a lowdown though:

Name: '.$_REQUEST['contact_vars']['app_name'].'
Developer: '.$_REQUEST['contact_vars']['developer_name'].
$_REQUEST['contact_vars']['developer_link'].'
Description: '.$_REQUEST['contact_vars']['contact_message'];
				
				$headers = "From: ".$_REQUEST['contact_vars']['your_email'];
				
				$mail_sent = mail(
					$admin_email,
					"There has been a new ipad app submission at onedayoneapp.com",
					$message,
					$headers
				);
				
				if($mail_sent){
					boss_popup_message('Thanks for the App! We will review it, and let you know the outcome!');
				}
			}
			
		} elseif($contact_type == 'message') {
			
		$message = '
Reply to this email to reply to their message.

'.$_REQUEST['contact_vars']['contact_message'];
				
			$headers = "From: ".$_REQUEST['contact_vars']['your_email'];
			$mail_sent = mail(
			    $admin_email,
			    $_REQUEST['contact_vars']['your_name']." has sent you a message from onedayoneapp.com",
			    $message,
			    $headers
			);
			if($mail_sent){
				boss_popup_message('Thanks for enquiring. We\'ll get back to you soon.');
			}
		}
}

function boss_popup_message($message){
	?>
	<div class="popup-wrapper">
		<style type="text/css">
			.popup-message{
			}
		</style>
		<script type="text/javascript">
			jQuery(function(){
				var w1   	= jQuery(window).width();
				var w2   	= jQuery('.popup-message').width();
				var h1   	= jQuery(window).height();
				var h2		= jQuery('.popup-message').height();
				var mathL	= w1 / 2 - w2 / 2 - 30;
				var mathT	= h1 / 2 - h2 / 2 - 30;
				jQuery('.popup-message').css({top: mathT, left: mathL, display: 'block'})
					.hide()
					.delay(1000)
					.fadeIn(500)
					.delay(4000)
					.fadeOut(500);
			});
		</script>
		<div class="popup-message">
			<p><?php echo $message; ?></p>
		</div>
	</div>
	<?php
}

$post_types = array('ipad-app', 'iphone-app', 'mac-app');
$registered_images = array(
	'Screenshot #1',
	'Screenshot #2',	
	'Screenshot #3',	
	'Screenshot #4',	
	'Screenshot #5',	
	'Screenshot #6',	
	'Screenshot #7',	
);

if(class_exists('MultiPostThumbnails')){
	foreach($registered_images as $name) :
		
	    foreach($post_types as $type) :
	    	new MultiPostThumbnails(
	    	    array(
	    	    	'label' => $name,
	    	    	'id' => sanitize_title($name),
	    	    	'post_type' => $type
	    	    )
	    	);
	    endforeach;
	endforeach;
}

function add_tags_to_post_types(){
	$post_types = array('ipad-app', 'iphone-app', 'mac-app');
	
	foreach($post_types as $type){
	
		$args = array(
			'label' => ucwords(str_replace('-', ' ', $type)).' Tags',
			'show_tagcloud' => true,
			'rewrite' => 'slug',			
		);
		register_taxonomy($type.'-tags', $type, $args);
	}
}

function is_singular_app(){
	if(is_singular('ipad-app') || is_singular('iphone-app') || is_singular('mac-app')){
		return true;
	} else {
		return false;
	}
}

function is_app_home(){
	if(is_page(array('ipad-apps', 'iphone-apps', 'mac-apps', 'iPad', 'iPhone', 'Mac'))){
		return true;
	} else {
		return false;
	}
}

function them_archives(){
	$obj = get_queried_object();
	//pr($obj);
	
	$tax = $obj->taxonomy;
	$device = explode('-', $tax);
	$device = $device[0];
	echo '<div id="header-archives-inner">';
	
	global $wpdb;
	$year_prev = null;
	$months = $wpdb->get_results(	"SELECT DISTINCT MONTH( post_date ) AS month ,
									YEAR( post_date ) AS year,
									COUNT( id ) as post_count FROM $wpdb->posts
									WHERE post_status = 'publish' and post_date <= now( )
									and post_type = '$device-app'
									GROUP BY month , year
									ORDER BY post_date DESC");
	foreach($months as $month) :
		$year_current = $month->year;
		if ($year_current != $year_prev){
			if ($year_prev != null){?>
			</ul>
			</div>
			<?php } ?>
		<div class="yor">
		<h3><?php echo $month->year; ?></h3>
		<ul class="archive-list">
		<?php } ?>
		<li>
			<?php //pr($month); ?>
			<a href="<?php bloginfo('url') ?>/<?php echo $device; ?>-app/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
				<span class="archive-month"><?php echo date("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span>
				<span class="archive-count"></span>
			</a>
		</li>
	<?php $year_prev = $year_current;
	endforeach; ?>
	</div>
<?php }