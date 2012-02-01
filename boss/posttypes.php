<?php class postTypeLAB{

	private $singular_name;
	private $custom_args;
	private $args;
	private $tax_args;
	private $slug;
	private $taxonomies;

	function __construct($singular_name, $plural_name, $args = null, $taxonomy = null){
		$this->args 		= array(); //for use later on
		$this->singular_name= $singular_name;
		$this->slug			= sanitize_title($singular_name);
		
		$this->taxonomies = array();
		
		if (count($taxonomy) == count($taxonomy, COUNT_RECURSIVE)){
			$this->taxonomies[sanitize_title($taxonomy['singular_name'])] = $taxonomy;
		} elseif(is_array($taxonomy)) {
			$this->taxonomies = $taxonomy;
		}
		
		$this->custom_args  = array(
			'singular_name' => $singular_name,
			'plural_name'   => $plural_name,
			'args'			=> $args,
			'tax_name'		=> $this->taxonomies
		);
		
		
		$this->process_post_type_args($this->custom_args);
		
		if(!array_empty($this->taxonomies)) : $this->process_tax_args(); endif;
		
		add_action('init', array($this, 'boss_custom_types_init'), 0);
	}
	
	function boss_custom_types_init(){
    	register_post_type($this->slug, $this->args);
    	
    	add_post_type_support( $this->slug, $this->args['supports'] );
    	if($this->taxonomies) :
    		foreach($this->taxonomies as $taxonomy)
    			register_taxonomy(sanitize_title($taxonomy['singular_name']), array($this->slug), $taxonomy['args']);
    		endif;
	}
	
	private function process_post_type_args($type){
	
		$s = $type['singular_name']; $p = $type['plural_name'];	

		$labels = array(
			'name' 				=> $p, 							//e.g. Posts
			'singular_name' 	=> $s, 							//e.g. post
			'add_new' 			=> 'Add New '.$s, 				//e.g. add new post
			'all_items' 		=> $p, 							//e.g. Posts (default name label)
			'add_new_item'		=> 'Add New '.$s, 				//e.g. add new post
			'edit_item'			=> 'Edit '.$s, 					//e.g. edit post
			'new_item'			=> 'New '.$s, 					//e.g. new post
			'view_item'			=> 'View '.$s, 					//e.g. view post
			'search_items'		=> 'Search '.$p, 				//e.g. search posts
			'not_found'			=> 'No '.$p.' found', 			//e.g. No posts found
			'not_found_in_trash'=> 'No '.$p.' found in trash', 	//e.g. No posts found in trash
			'parent_item_colon' => 'Parent '.$s.': ',			//e.g. parent page (not used in non-heirarchical)
			'menu_name' 		=> $p  							//e.g. Posts (defualt name label)
		);
		
		$tax_names = array();
		
		foreach($type['tax_name'] as $tax){$tax_names[] = sanitize_title($tax['singular_name']);}
	
		$args = array(  
			'labels'			=> $labels,
    		'label' 			=> __($type['plural_name']),  
    		'singular_label' 	=> __($type['singular_name']),  
			'menu_icon'			=> $type['args']['menu_icon'],
			'hierarchical'		=> $type['args']['hierarchical'],
			'has_archive'		=> $type['args']['has_archive'],
			'rewrite'			=> $type['args']['rewrite'],
			'description'		=> $type['args']['description'],
			'supports'			=> $type['args']['supports'],
			'public'			=> $type['args']['public'],
			'show_ui'			=> $type['args']['show_ui'],
    		'capability_type' 	=> 'post', 
    		'taxonomies' 		=> $tax_names
		);
       
       
       $this->args = $args;
	}
	
	private function process_tax_args(){
    	foreach($this->taxonomies as $key => $taxonomy) :
    	    $st = $taxonomy['singular_name'];
    	    $pt = $taxonomy['plural_name'];
    	
    	    $labels = array(
    	    	'name' 				=> $pt,
    	    	'singular_name' 	=> $st,
		    	'search_items'		=> 'Search '.$pt, 		//e.g. Search tags
		    	'popular_items'		=> 'Popular '.$pt, 		//e.g. Popular tags
		    	'all_items' 		=> 'All '.$st,			//e.g. All tags
		    	'parent_item'		=> 'Parent '.$st,		//e.g. Parent category
		    	'parent_item_colon' => 'Parent '.$st.': ',	//e.g. parent category: (not used in non-heirarchical)
		    	'edit_item'			=> 'Edit '.$st, 		//e.g. edit tag
    	    	'update_item'		=> 'Update '.$st,		//e.g. update tag
    	    	'add_new_item'		=> 'Add New '.$st,		//e.g. add new tag
    	    	'add_new_item_name'	=> 'New '.$st.' Name',	//e.g. new tag name
    	    	'separate_items_with_commas' => 'Separate '.$pt.' with commas',
    	    	'add_or_remove_items'=>'Add or Remove '.$pt,
    	    	'choose_from_most_used'=> 'Choose from the most used '.$pt,
    	    	'menu_name'			=> $pt
    	    );
    	
    	    $this->taxonomies[$key]['args'] = array(
    	    	"hierarchical" => true,
    	    	"labels" => $labels,
    	    	"rewrite" => true
    	    );
    	endforeach;
	}
}