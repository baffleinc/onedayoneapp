<?php 

	$post_type_args   = array();
	$post_tax_args    = array();
	$metabox_fields = array();
	
	//post type arguments
	$post_type_args['iPad'] = array(
		'menu_position'		=> '',		//5-60, intervals of 5.
		'menu_icon'			=> get_bloginfo('stylesheet_directory').'/images/ipad_admin_icon.png',	 	//url to menu image
		'hierarchical'		=> '',		//for things like pages
		'taxonomies'		=> 'ipad-app-category', //tag?
		'has_archive'		=> true, 	//archive feature with post type
		'rewrite'			=> array(
			''
		), 	//for pretty permalinks
		'supports'			=> array(
			'title',
			'editor',
			'thumbnail',
			'comments',
			'author'
		),
		'description'		=> '', //description of post type
		'public'			=> true, //can the public see it?
		'show_ui'			=> true, //generate UI for custom management
		'capability_type'	=> '',
	);
	
	$post_tax_args['iPad'] = array(
		'singular_name'		=> 'iPad App Category', //e.g. Brand
		'plural_name'		=> 'iPad App Categories', //e.g. Brand
	);
	
	//post type arguments
	$post_type_args['iPhone'] = array(
		'menu_position'		=> '',		//5-60, intervals of 5.
		'menu_icon'			=> get_bloginfo('stylesheet_directory').'/images/iphone_admin_icon.png',	 	//url to menu image
		'hierarchical'		=> '',		//for things like pages
		'taxonomies'		=> 'iphone-app-category', //tag?
		'has_archive'		=> true, 	//archive feature with post type
		'rewrite'			=> true, 	//for pretty permalinks
		'supports'			=> array(
			'title',
			'editor',
			'thumbnail',
			'comments',
			'author'
		),
		'description'		=> '', //description of post type
		'public'			=> true, //can the public see it?
		'show_ui'			=> true, //generate UI for custom management
		'capability_type'	=> '',
	);
	
	$post_tax_args['iPhone'] = array(
		'singular_name'		=> 'iPhone App Category', //e.g. Brand
		'plural_name'		=> 'iPhone App Categories', //e.g. Brand
	);
	
	;
	$post_tax_args['Mac'] = array(
		'singular_name'		=> 'Mac App Category', //e.g. Brand
		'plural_name'		=> 'Mac App Categories', //e.g. Brand
	);
	
	//post type arguments
	$post_type_args['Mac'] = array(
		'menu_position'		=> '',		//5-60, intervals of 5.
		'menu_icon'			=> get_bloginfo('stylesheet_directory').'/images/mac_admin_icon.png',	 	//url to menu image
		'hierarchical'		=> '',		//for things like pages
		'taxonomies'		=> array(
								sanitize_title($post_tax_args['Mac']['boss_cats']['singular_name']),
								sanitize_title($post_tax_args['Mac']['boss_tags']['singular_name'])
							), 
		'has_archive'		=> true, 	//archive feature with post type
		'rewrite'			=> true, 	//for pretty permalinks
		'supports'			=> array(
			'title',
			'editor',
			'thumbnail',
			'comments',
			'author'
		),
		'description'		=> '', //description of post type
		'public'			=> true, //can the public see it?
		'show_ui'			=> true, //generate UI for custom management
		'capability_type'	=> '',
	);
	
	$metabox_fields['App']	= array(
		array(
			'name' => 'App Meta Info',
			'type' => 'heading'
		),
		array(
			'name' => 'Appstore Link',
			'type' => 'text'
		),
		array(
			'name' => 'App Developer',
			'type' => 'text'
		),
		array(
			'name' => 'App Developer Link',
			'type' => 'text'
		),
		array(
			'name' => 'Price of App',
			'type' => 'text'
		),
		array(
			'name' => 'Video Embed',
			'type' => 'text',
			'desc' => 'Please enter the youtube video embed code here.'
		),
		array(
			'name' => 'Insert Video After Image:',
			'type' => 'select',
			'opts' => array(1,2,3,4,5,6,7)
		),
		array(
			'name' => 'Horizontal iPad App',
			'type' => 'checkbox',
			'desc' => 'FOR iPAD APPS ONLY. Check if all screenshots are horizontal'
		)
		
	);
	
	for($i=1; $i <=7; $i++){
		$metabox_fields['App'][] = array(
			'name' => 'Screenshot #'.$i,
			'type' => 'image'
		);
	}
	
	$theme_options_args = array(
		'Main Test Area' => array(
			array(
				'name' => 'default text',
				'type' => 'text',
				'desc' => 'Here is some text bitch'
			),
			array(
				'name' => 'default text NEW',
				'type' => 'text',
				'desc' => 'SOMWE MORE TEST NIGGERSSSS'
			),
			array(
				'name' => 'Tag Selection',
				'type' => 'freeform'
			)
		)
	);
